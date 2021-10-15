/**
* Result view model
*/
function ResultViewModel(parent, id, sourceId, targetId, sourceEndpoint, targetEndpoint, label, daysLater, conId) {
    var self = this;
	
	self.id = ko.observable();
	self.sourceId = ko.observable();
	self.targetId = ko.observable();
	self.sourceEndpoint = ko.observable();
	self.targetEndpoint = ko.observable();
	self.label = ko.observable().extend({ required: true });
	self.daysLater = ko.observable().extend({ integer: 0 });
	self.conId = ko.observable('');
	
	
	self.top = ko.observable(0);
	self.left = ko.observable(0);
	self.width = ko.observable(0);

	self.isActive = ko.observable(false);
	
	// Properties, that never changes dinamically, can be created non-observable
    self.parent = parent;

	// Temporary properties for keeping old values, when editing row
    self.oldLabel = null;
	self.oldDaysLater = null;
	
	// Subscribe to value change events
    self.label.subscribe(function () {
        if (!self.isActive()) {
            self.oldLabel = self.label();
        }
    });
	self.daysLater.subscribe(function () {
        if (!self.isActive()) {
            self.oldDaysLater = self.daysLater();
        }
    });
	
	
	/**
    * Computed KnockOut function, returns position info based on overlay position/size
    */
    self.position = ko.computed(function () {
        var top,
			left;
			
		top = self.top()+'px';
		left = parseInt(self.left() + self.width()/2)+'px';

        return { top: top, left: left };
    });
	
	/**
    * Selects all input/textarea text
    */
    self.selectText = function (data, event) {
		$(event.target).select();
    };
	
	/** 
    * Saves a result
    */
    self.saveResult = function () {
		if (self.label.hasError()) {
            return;
        }		
		
		if (!self.id()) {
            self.parent.results.push(self);
            self.id(self.parent.getNewId(true));
        }
		else {
			jsPlumb.select().each(function(conn) {
				if(conn.id === self.conId()) {
					conn.getOverlay("label").setLabel(self.label() + '<br />' + self.daysLater() + ' days later');
				}
			});
		}
		
        self.isActive(false);
		self.parent.isDirty(true);
		showOverlays();

        // Setting old values
        self.oldLabel = self.label();
		self.oldDaysLater = self.daysLater();
    };
	
	/**
    * Deletes a result.
    */
    self.deleteResult = function (parentViewModel) {
        // Saves or cancels all edits
        self.parent.saveOrCancelAllEdits();
        var deletingStep = this;
				
		bootbox.dialog({
			message: "Are you sure you want to delete this result?",
			buttons: {
				main: {
					label: "Cancel",
					className: "btn-default",
					callback: function() {
						return;
					}
				},
				danger: {
					label: "Delete Result",
					className: "btn-danger",
					callback: function() {
						var conId = self.conId(),
						results = self.parent.results(); 
						
						for (var i = 0; i < results.length; i++) {
							if(results[i].conId() === conId) {
								var result = results[i];
							}
						}
						
						jsPlumb.select().each(function(conn) {			
							if(conn.id === conId) {
								jsPlumb.detach(conn);
							}
						});			
				
						// Remove result from observable arrays
						self.parent.results.remove(result);
					}
				}
			}
		});			
       
    };
	
	/**
    * Cancels inline editing of a result
    */
    self.cancelEditResult = function () {
        if (!self.id()) {
            // If step was new, remove it from grid
            self.parent.results.remove(self);
        } else {
            // Restore old values
            self.label(self.oldLabel);
			self.daysLater(self.oldDaysLater);
			
            self.isActive(false);
        }
		showOverlays();
    };	
	
	/**
    * Saves a result or cancels edit mode, depending on label.hasError()
    */
    self.saveOrCancelEdit = function() {
        if (self.isActive()) {
            if (self.label.hasError()) {
                self.cancelEditResult();
            }
			else {
                self.saveResult();
            }
        }
    };
	
	/**
    * Private method, shows connection overlays
    */
	function showOverlays() {
		jsPlumb.select().each(function(conn) {
			conn.showOverlay("label");
		});
		jsPlumb.setDraggable($('.step'), true);
	};
	
	// Set properties with chain syntax
    self.id(id).sourceId(sourceId).targetId(targetId).sourceEndpoint(sourceEndpoint).targetEndpoint(targetEndpoint).label(label).daysLater(daysLater).conId(conId);

}