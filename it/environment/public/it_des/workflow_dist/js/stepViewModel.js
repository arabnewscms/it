/**
* Step view model
*/
function StepViewModel(parent, isStart, id, name, contactType, userType, description, template, top, left) {
    var self = this;

    // Observable properties
	self.isStart = ko.observable();
    self.id = ko.observable();
	self.name = ko.observable().extend({ required: true });
	self.contactType = ko.observable();
	self.userType = ko.observable();
    self.description = ko.observable();
	self.template = ko.observable();
	self.top = ko.observable();
	self.left = ko.observable();
	
	
    self.isActive = ko.observable(false);
	self.activeField = ko.observable(null);
	
	// Properties, that never changes dinamically, can be created non-observable
    self.parent = parent;


    // Temporary properties for keeping old values, when editing row
    self.oldName = null;
	self.oldDesc = null;

    // Subscribe to title value change events
    self.name.subscribe(function () {
        if (!self.isActive()) {
            self.oldName = self.name();
        }
    });
	self.description.subscribe(function () {
        if (!self.isActive()) {
            self.oldDesc= self.description();
        }
    });
	
	/**
    * Computed KnockOut function, returns active class for step where isStart is true
    */
    self.start = ko.computed(function () {
		if(self.id()) {
			var isStart = self.isStart(),
				classes = '';
				
			if(isStart) {
				classes += 'active';
			}
	
			return classes;
		}
    });

    /**
    * Computed KnockOut function, returns contact type info from contactTypes object depending on self.contactType() value
    */
    self.contact = ko.computed(function () {
        if(self.id() && self.contactType()) {
			var classes = 'glyphicon',
				contactType = self.contactType(),
				index = self.parent.contactTypes.mappedIndexOf({ Id: contactType }),
				label = self.parent.contactTypes()[index].name(),
				icon = self.parent.contactTypes()[index].icon();
			
			classes += ' ' + icon;
	
			return { classes: classes, label: label };
		}
    });
	
	/**
    * Computed KnockOut function, returns user type info from userTypes object depending on self.userType() value
    */
    self.user = ko.computed(function () {
		if(self.id() && self.userType()) {
			var userType = self.userType(),
				index = self.parent.userTypes.mappedIndexOf({ Id: userType }),
				label = self.parent.userTypes()[index].name();
	
			return label;
		}
    });
	
	/**
    * Computed KnockOut function, returns template name based on self.template() value
    */
    self.templateName = ko.computed(function () {
		if(self.id()) {
			var label = "Select a Template";
			
			if(self.template()) {
				var templateType = parseInt(self.template()),
					index = self.parent.templateTypes.mappedIndexOf({ Id: templateType }),
					label = self.parent.templateTypes()[index].name();				
			}
			
			return label;
		}		
    });

    /** 
    * Saves a step
    */
    self.saveStep = function () {
        if (self.name.hasError()) {
            return;
        }

        // Add step to steps() array
        if (!self.id()) {
            self.parent.steps.push(self);
            self.id(self.parent.getNewId());
        }

        self.isActive(false);
		self.activeField(null);
		
		self.parent.isDirty(true);

        // Setting old values
        self.oldName = self.name();
		self.oldDesc = self.description();
    };

    /**
    * Deletes a step and all results associated with that step.
    */
    self.deleteStep = function (parentViewModel) {
        // Saves or cancels all edits
        self.parent.saveOrCancelAllEdits();

        // <a data-bind="click: deleteStep.bind($data, $parent)">Delete</a>
        // Using "this" instead of "self" - first bound parameter is step itself
        // and second bound parameter is parent view model
        // This example shows, how binding with parameters works
        var deletingStep = this;
		
		bootbox.dialog({
			message: "Are you sure you want to delete this step?",
			buttons: {
				main: {
					label: "Cancel",
					className: "btn-default",
					callback: function() {
						return;
					}
				},
				danger: {
					label: "Delete Step",
					className: "btn-danger",
					callback: function() {
						
						plumbing.unPlumbIt(deletingStep.id());
													
						var results = parentViewModel.results(),
							deletingResult = [];
						
						for (var i = 0; i < results.length; i++) {	
							if(results[i].sourceId() == deletingStep.id() || results[i].targetId() == deletingStep.id()) {
								deletingResult.push(results[i]);
							}
						}
						
						//remove all results associated with deleted step
						parentViewModel.results.removeAll(deletingResult);
						//remove deleted step
						parentViewModel.steps.remove(deletingStep);
						if(deletingStep.isStart()) {
							if(parentViewModel.steps().length > 0) parentViewModel.steps()[0].isStart(true);
						}
						
						self.parent.isDirty(true);
							
						
						
					}
				}
			}
		});		
        
    };

    /**
    * Starts inline editing of an step
    */
    self.editStep = function (data, event) {		
        // Saves or cancels all edits
        self.parent.saveOrCancelAllEdits();
        self.isActive(true);		
		self.activeField($(event.target).data('update'));
    };
	
	/**
    * Selects all input/textarea text
    */
    self.selectText = function (data, event) {
		$(event.target).select();
    };
	
	/**
    * Sets all other steps isStart = false if this one is made true
    */
    self.setIsStart = function (data, event) {
		self.parent.saveOrCancelAllEdits();
		var id = self.id(),
			steps = self.parent.steps();
		for (var i = 0; i < steps.length; i++) {
			if(steps[i].id() != id) {
				steps[i].isStart(false);
			}
			else {
				steps[i].isStart(true);
			}
		}
		self.parent.isDirty(true);
    };

    /**
    * Cancels inline editing of an step
    */
    self.cancelEditStep = function () {
        if (!self.id()) {
            // If step was new, remove it from grid
            self.parent.steps.remove(self);
        } else {
            // Restore old values
            self.name(self.oldName);
			self.description(self.oldDesc);
			
            self.isActive(false);
			self.activeField(null);
        }
    };

    /**
    * Saves an step or cancels edit mode, depending on title.hasError()
    */
    self.saveOrCancelEdit = function() {
        if (self.isActive()) {
            if (self.name.hasError()) {
                self.cancelEditStep();
            } else {
                self.saveStep();
            }
        }
    };

    // Set properties with chain syntax
    self.isStart(isStart).id(id).name(name).contactType(contactType).userType(userType).description(description).template(template).top(top).left(left);

}