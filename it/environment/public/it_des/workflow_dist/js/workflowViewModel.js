// mapping plugin options
var dataMappingOptions = {
	key: function (data) {
		return data.Id;
	}
};

// Workflow Chart view model ---------------------------------------------------
// -------------------------------------------------------------------------------------
function WorkflowViewModel() {
    var self = this;

	self.contactTypes = ko.mapping.fromJS(demoData.contactTypes, dataMappingOptions);	
	self.userTypes = ko.mapping.fromJS(demoData.userTypes, dataMappingOptions);
	self.templateTypes = ko.mapping.fromJS(demoData.templates, dataMappingOptions);

	// Create observable array for steps
    self.allWorkflows = ko.observableArray();
	self.workflows = ko.observableArray();

    // Create observable array for steps
    self.steps = ko.observableArray();
	
	// Create observable array for results
    self.results = ko.observableArray();
	
	// Create observable array for templates
	self.templates = ko.observableArray();
	self.selectedTemplate = ko.observable();
	self.tempId = ko.observable();
	
	self.counter = 0; //need this for updating jsPlumb conn_id's when loading a saved workflow.
	
	self.isDirty = ko.observable(false);

	
	/**
    * Computed KnockOut function, gets name of the selected workflow for display
    */
    self.selectedWorkflow = ko.computed(function () {
		for (var i = 0; i < self.workflows().length; i++) {
            if(self.workflows()[i].isSelected()) {
				var name = self.workflows()[i].name();
				return name;
			}
        }
    });
	
	/**
    * Computed KnockOut function, returns a class for dirty state
    */
    self.dirtyState = ko.computed(function () {
		if(self.isDirty()) {
			return "dirty";
		}
    });
	
	// Add a new step ----------------------------------------------------------------------
	// -------------------------------------------------------------------------------------
    self.addNewStep = function (contactType, top, left) {
        
		// Saves or cancels all edits
        self.saveOrCancelAllEdits();
		
		
		var id = self.getNewId(),
			isStart = (self.steps().length > 0) ? false : true;
			//StepViewModel -> parent, isStart, id, name, contactType, userType, description, template, top, left
        	newStep = new StepViewModel(self, isStart, id, 'New Step '+id, contactType, 1, '', null, top, left);

        // Add new step to the top of showing steps
		self.steps.push(newStep);
		self.isDirty(true);
		
		jsPlumb.bind("ready", function() {
			plumbing.plumbIt(id);
			$("#"+id).on( "dragstart", function(event, ui) {
				self.isDirty(true);
			});			
		});
		
    };
	
	// Add a new result via connection drag ------------------------------------------------
	// -------------------------------------------------------------------------------------
	self.addNewResult = function (info) {
        
		// Saves or cancels all edits
        self.saveOrCancelAllEdits();
		
		var id = self.getNewId(true),
        	newResult = new ResultViewModel(self, id, info.sourceId, info.targetId, info.connection.endpoints[0].anchor.type, info.connection.endpoints[1].anchor.type, 'New Result', 0, info.connection.id);

        // Add new step to the top of showing steps
		self.results.push(newResult);
		self.isDirty(true);
    };
	
	// Updates a result via connection drag ------------------------------------------------
	// -------------------------------------------------------------------------------------
	self.updateResult = function (info) {
        
		// Saves or cancels all edits
        self.saveOrCancelAllEdits();
		
		var conId = info.connection.id,
			sourceId = info.newSourceId,
			targetId = info.newTargetId,
			sourceEndpoint = info.newSourceEndpoint.anchor.type,
			targetEndpoint = info.newTargetEndpoint.anchor.type;
		
		for (var i = 0; i < self.results().length; i++) {
            if(self.results()[i].conId() === conId) {
				var result = self.results()[i];
			}
        }
		
		result.sourceId(sourceId);
		result.targetId(targetId);
		result.sourceEndpoint(sourceEndpoint);
		result.targetEndpoint(targetEndpoint);
		
		self.isDirty(true);
		
    };
	
	// Removes a result via connection drag ------------------------------------------------
	// -------------------------------------------------------------------------------------	
	self.removeResult = function (info) {
        
		// Saves or cancels all edits
        self.saveOrCancelAllEdits();
		
		var conId = info.connection.id;
		
		for (var i = 0; i < self.results().length; i++) {
            if(self.results()[i].conId() === conId) {
				var result = self.results()[i];
			}
        }		

        // Remove result from observable arrays
		self.results.remove(result);
		self.isDirty(true);
    };
	
	// Show result edit form ---------------------------------------------------------------
	// -------------------------------------------------------------------------------------
	self.showResult = function (connection) {
		// Saves or cancels all edits
        self.saveOrCancelAllEdits();
		
		var conId = connection.id,
			results = self.results();
		
		for (var i = 0; i < results.length; i++) {
            if(results[i].conId() === conId) {
				var result = results[i];
			}
        }
		
		result.isActive(true);
		
		jsPlumb.select().each(function(conn) {
			if (conn.id === conId) {
				var el = $('#'+conn.getOverlay("label").getElement().id);
				result.top(el.position().top).left(el.position().left).width(el.width());
				conn.hideOverlay("label");
			}
		});
		
		jsPlumb.setDraggable($('.step'), false);
			
    };
	
	// Show templates ----------------------------------------------------------------------
	// -------------------------------------------------------------------------------------
	self.showTemplates = function (data, event) {
		// Saves or cancels all edits
        self.saveOrCancelAllEdits();
		
		
		self.selectedTemplate(data.template());
		self.tempId(data.id());
		
		var win = $(window),
			popup = $('#templates > .poppanel');
		
		$('#templates').show();		
		popup.css({
			'margin-top': -Math.abs(popup.height()/2)+'px',
			'margin-left': -Math.abs(popup.width()/2)+'px'
		});
    };
	
	// Sets template() for particular step -------------------------------------------------
	// -------------------------------------------------------------------------------------
	self.setTemplate = function () {
		if(self.tempId()) {
			var stepId = self.tempId(),
				steps = self.steps();
			
			for (var i = 0; i < steps.length; i++) {
				if(steps[i].id() === stepId) {
					steps[i].template(parseInt(self.selectedTemplate()));
					self.isDirty(true);
				}
			}
		}
		$('#templates').hide();
    };
	
    // Returns the next step or result id for a new item -----------------------------------
	// -------------------------------------------------------------------------------------
    self.getNewId = function(isResult) {
        var id = 0,
			obj = (isResult) ? self.results() : self.steps();	 

        for (var i = 0; i < obj.length; i++) {
            if (obj[i].id() > id) {
                id = obj[i].id();
            }
        }
        return id + 1;
    };

    // Saves or cancels all current edits
    // -------------------------------------------------------------------------------------
    self.saveOrCancelAllEdits = function() {
        // Stop editing, if some step is in edit mode
        for (var i = 0; i < self.steps().length; i++) {
            var step = self.steps()[i];
            if (step.isActive()) {
                step.saveOrCancelEdit();
				self.isDirty(true);
            }
        }
		// Stop editing, if some result is in edit mode
        for (var i = 0; i < self.results().length; i++) {
            var result = self.results()[i];
            if (result.isActive()) {
                result.saveOrCancelEdit();
				self.isDirty(true);
            }
        }		
		jsPlumb.select().each(function(conn) {
			conn.showOverlay("label");
		});
		$('#templates').hide();		
    };
	
	
	// Saves the workflow data as a JSON String to Local Storage ------------------------------------
	// ---------------------------------------------------------------------------------------------
	self.saveData = function() {
		
		var steps = self.steps(),
			results = self.results(),
			data = { name: '', steps: [], results: [] };
		
			
		for (var i = 0; i < steps.length; i++) {
			var top = $('#'+steps[i].id()).css('top'),
				left = $('#'+steps[i].id()).css('left');				
			data.steps.push({isStart: steps[i].isStart(), Id: steps[i].id(), name: steps[i].name(), contactType: steps[i].contactType(), userType: steps[i].userType(), description: steps[i].description(), template: steps[i].template(), top: top, left: left});
        }
		for (var i = 0; i < results.length; i++) {
			data.results.push({Id: results[i].id(), sourceId: results[i].sourceId(), targetId: results[i].targetId(), sourceEndpoint: results[i].sourceEndpoint(), targetEndpoint: results[i].targetEndpoint(), label: results[i].label(), daysLater: results[i].daysLater()});
        }
		
		
		if (!Modernizr.localstorage) { 
			alert('You need to use a browser with Local Storage support to save your workflows.'); 
		}
		else {		
			
			for (var i = 0; i < self.workflows().length; i++) {
				var workflow = self.workflows()[i];
				if(workflow.isSelected()) {
					var current = workflow.key();
				}
			}
			
			if(current) {
				var value = JSON.parse(localStorage.getItem(current));
				data.name = value.name;
				var JsonString = JSON.stringify(data);
				localStorage.setItem(current, JsonString);
							
				saveEffect();
				
				self.isDirty(false);
			}
			else {
				bootbox.prompt("Give your workflow a name:", function(name) {                						   
					if(name) {
						data.name = name;
						var utc = new Date().getTime(), 
							key = "workflow."+utc,
							JsonString = JSON.stringify(data),
							workflow = new ListViewModel(self, key, name);
							
						localStorage.setItem(key, JsonString);//save new workflow to LS
						
						for (var i = 0; i < localStorage.length; i++) {
							if(localStorage.key(i) === key) {
								var index = i;
							}
						}
						self.workflows.splice(index, 0, workflow);//have to splice instead of push for FF
						workflow.isSelected(true);
						$.cookie('selected_workflow', workflow.key(), { expires: 365 });
						
						setTimeout(function() {
							saveEffect();
						}, 350);
						
						self.isDirty(false);
					}
				});
			}
			
		}	
		
	};
	
	
	// Gets specific workflow data from Local Storage ----------------------------------------------
	// ---------------------------------------------------------------------------------------------
	self.selectWorkflow = function(data) {
		
		if(self.isDirty()) {			
			unsavedWarning(function() { 
				return getData(data); 
			});
		}
		else {
			getData(data);
		}
				
	};
	
	// Checks if dirty, calls clear data -----------------------------------------------------------
	// ---------------------------------------------------------------------------------------------	
	self.newWorkflow = function() {
		
		if(self.isDirty()) {
			unsavedWarning(self.clearData);
		}
		else {
			self.clearData();
		}
		
	};
	
	// Deletes all workflows from local storage and workflow list ----------------------------------
	// ---------------------------------------------------------------------------------------------
	self.deleteAllWorkflows = function() {
		
		if(self.isDirty()) {
			unsavedWarning(verify);
		}
		else {
			verify();
		}
		function verify() {	
			bootbox.dialog({
				message: "Are you sure you want to delete all saved workflows?",
				buttons: {
					main: {
						label: "Cancel",
						className: "btn-default",
						callback: function() {
							return;
						}
					},
					danger: {
						label: "Delete Workflows",
						className: "btn-danger",
						callback: function() {
							deleteAll();
						}
					}
				}
			});
		}
		
	};
	
	// Removes all steps/results from screen and viewModel -----------------------------------------
	// ---------------------------------------------------------------------------------------------
	self.clearData = function() {
		self.saveOrCancelAllEdits();
		jsPlumb.deleteEveryEndpoint();
		for (var i = 0; i < self.workflows().length; i++) {
			self.workflows()[i].isSelected(false);
		}
		self.steps.removeAll();
		self.results.removeAll();
		resetCounter();
		self.isDirty(false);
		$.removeCookie('selected_workflow');
	};
	
	
	/**
    * Private method, resets counter variable for getting the right jsPlumb connection id into
	* results viewmodels during programatic connections - (jsPlumb.bind("connection"))
    */
	function resetCounter() {
		self.counter = 0;
	}
	
	/**
    * Private method, fills worklfows observable array with saved data
    */
    function setWorkflows() {
        self.workflows.removeAll();

        for (var i = 0; i < self.allWorkflows().length; i++) {
            var workflow = self.allWorkflows()[i];
            self.workflows.push(workflow);
        }
    }
	
	/**
    * Private method
    */
	function getData(data) {
		var storage = getStorageKeys();
		for (var i = 0; i < self.workflows().length; i++){
			if(self.workflows()[i].isSelected() || self.isDirty()) {
				self.clearData();
			}
		}			
		
		for (var i = 0; i < storage.length; i++){
			if(storage[i] === data.key()) {
				var workflow = JSON.parse(localStorage[storage[i]]);
				self.workflows()[i].isSelected(true);
				$.cookie('selected_workflow', self.workflows()[i].key(), { expires: 365 });
			}
		}
		
		if(!workflow) {
			alert("Sorry, can't find a workflow in your local storage associated with key = " + data.key());
			return;
		}
		
		var steps = workflow.steps,
			results = workflow.results;
			
		//fill the steps() observable array with a new StepViewModel
		for (var i = 0; i < steps.length; i++) {
			var stepViewModel = new StepViewModel(self, steps[i].isStart, steps[i].Id, steps[i].name, steps[i].contactType, steps[i].userType, steps[i].description, steps[i].template, steps[i].top, steps[i].left);
			self.steps.push(stepViewModel);
		}
		
		//fill the results() observable array with a new ResultViewModel
		for (var i = 0; i < results.length; i++) {
			var resultViewModel = new ResultViewModel(self, results[i].Id, results[i].sourceId, results[i].targetId, results[i].sourceEndpoint, results[i].targetEndpoint, results[i].label, results[i].daysLater);
			self.results.push(resultViewModel);
		}
		
		jsPlumb.bind("ready", function() {
			//make steps jsPlumb items
			for (var i = 0; i < steps.length; i++) {
				plumbing.plumbIt(steps[i].Id);
				$("#"+steps[i].Id).on( "dragstart", function(event, ui) {
					self.isDirty(true);
				});
			}
			
			//make the jsPlumb connections
			for (var i = 0; i < results.length; i++) {
				plumbing.connectIt(results[i]);
			}
			
		});
	};
	
	/**
    * Private method delets all saved workflows from local storage
    */
	function deleteAll() {
		self.clearData();
		self.workflows.removeAll();
		var storage = getStorageKeys();		
		
		for (var i = 0; i < storage.length; i++){
			localStorage.removeItem(storage[i]);
		}
		
		$.removeCookie('selected_workflow');
		$('#workflowBtn .badge').effect( "highlight", {color:"#ff0000"}, 1500);
	};
	
	
	/**
    * Private method, handles unsaved warning dialog
    */
	function unsavedWarning(func) {
		bootbox.dialog({
			message: "You have unsaved changes to this workflow.  If you proceed, those changes will be lost. Are you sure you want to continue without saving?",
			title: "Warning!",
			buttons: {
				main: {
					label: "Cancel",
					className: "btn-default",
					callback: function() {
						return;
					}
				},
				danger: {
					label: "Continue Without Saving",
					className: "btn-danger",
					callback: function() {
						func();
					}
				}
			}
		});
	};
	
	/**
    * Private method, initializes the context menu plugin
    */
	function initContext() {
		
		var menu = new function () {
			var menu = {},
				items = self.contactTypes();
			for(var i = 0; i < items.length; i++) {
				menu[items[i].Id()] = { name: items[i].name(), icon: items[i].icon() }
			}
			return menu;
		}
		
		$.contextMenu({
			selector: '.context',
			className: 'context-title', 
			callback: function(key, options) {
				var cm = $('.context-menu-root'),
					y = parseInt(cm.css('top')),
					x = parseInt(cm.css('left')),
					top = Math.round(y/20)*20,
					left = Math.round(x/20)*20;
				self.addNewStep(parseInt(key), top+'px', left+'px'); 
			},
			items: menu
		});
		
	}
	
	
	/**
    * Private method, produces the save workflow transfer effect
    */
	function saveEffect() {
		$('article .step, article .aLabel').effect( "transfer", { to: $('#workflowBtn') }, 500);
		$('#workflowBtn .badge').effect( "highlight", {color:"#7ab02c"}, 1500);
	}
	
	/**
    * Private method, checks if results exists
    */
	function resultExists(info) {
		var conId = info.connection.id,
			exists = false;
		for (var i = 0; i < self.results().length; i++) {
			if(self.results()[i].conId() == conId) {
				exists = true;
			}
        }
		return exists;
	}
	
	/**
    * Private method, returns array of 'workflow' storage keys
    */	
	function getStorageKeys() {
		var keys = [];		
		
		for (var key in localStorage){
			if(key.substr(0, key.indexOf(".")) === "workflow") {
				keys.push(key);
			}
		}
		
		return keys;
	}
	
	// bind jsPlumb EVENTS--------------------------------------------------------------------------
	// ---------------------------------------------------------------------------------------------

	// a connection is made:
	jsPlumb.bind("connection", function(info, originalEvent) {	
		if(originalEvent) {
			if(!resultExists(info)) {
				self.addNewResult(info);
			}
		}
		else {
			self.results()[self.counter].conId(info.connection.id);
			self.counter++;
		}
	});
	
	// a connection is detached
	jsPlumb.bind("connectionDetached", function(info, originalEvent) {
		if(originalEvent) {
			self.removeResult(info);
		}
	});
	
	// a connection is moved
	jsPlumb.bind("connectionMoved", function(info, originalEvent) {
		if(originalEvent) {
			self.updateResult(info);
		}
	});
	
	// a connection gets clicked
	jsPlumb.bind("click", function(connection, originalEvent) { 
		if(originalEvent) {
			//console.log(connection.id);
			self.showResult(connection);
		}
	});
	

    /**
    * Funtion initializes workflow view model
    */
    self.initialize = function() {
		setWorkflows();
		initContext();
				
		//Check for an active workflow from a previous session
		var active = $.cookie('selected_workflow'),
			storage = getStorageKeys();
		
		for (var i = 0; i < storage.length; i++){
			if(storage[i] === active) {
				var workflow = self.workflows()[i];
			}
		}
		if(workflow) {
			getData(workflow);		
		}
		else {
			$.removeCookie('selected_workflow');
		}
    };
	
}
