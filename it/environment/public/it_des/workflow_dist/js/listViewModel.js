/**
* List of saved workflows
*/
function ListViewModel(parent, key, name) {
    var self = this;
	
	self.key = ko.observable();
	self.name = ko.observable().extend({ required: true });

	// Properties, that never changes dinamically, can be created non-observable
    self.parent = parent;
	
	self.isSelected = ko.observable(false);
	self.isActive = ko.observable(false);
	
	// Temporary properties for keeping old values, when editing row
    self.oldName = null;
	
	// Subscribe to title value change events
    self.name.subscribe(function () {
        if (!self.isActive()) {
            self.oldName = self.name();
        }
    });
	
	/**
    * edits a workflow name
    */
	self.editWorkflowName = function (data) {
        // Saves or cancels all edits
        self.parent.saveOrCancelAllEdits();
		self.isActive(true);
    };
	
	/** 
    * Saves workflow name
    */
    self.saveWorkflowName = function (data) {
        if (self.name.hasError()) {
            return;
        }
		
		var savingWorklfow = this;
		for (var i=0; i < localStorage.length; i++){
			if(localStorage.key(i) === savingWorklfow.key()) {
				var workflow = JSON.parse(localStorage[localStorage.key(i)]);
			}
		}
		workflow.name = self.name();
		var JsonString = JSON.stringify(workflow);
		localStorage.setItem(savingWorklfow.key(), JsonString);

        self.isActive(false);

        // Setting old values
        self.oldName = self.name();
    };
	
	/**
    * Cancels inline editing of workflow name
    */
    self.cancelEditWorkflowName = function () {
		// Restore old values
		self.name(self.oldName);			
		self.isActive(false);
    };

    /**
    * Saves workflow name or cancels edit mode, depending on name.hasError()
    */
    self.saveOrCancelEdit = function() {
        if (self.isActive()) {
            if (self.name.hasError()) {
                self.cancelEditWorkflowName();
            } else {
                self.saveWorkflowName();
            }
        }
    };
	
	/**
    * Deletes a workflow from local storage and workflow list
    */
	self.deleteWorkflow = function (parentViewModel) {
        // Saves or cancels all edits
        self.parent.saveOrCancelAllEdits();
        var deletingWorkflow = this;
		
		bootbox.dialog({
			message: "Are you sure you want to delete workflow " + deletingWorkflow.name() + "?",
			buttons: {
				main: {
					label: "Cancel",
					className: "btn-default",
					callback: function() {
						return;
					}
				},
				danger: {
					label: "Delete Workflow",
					className: "btn-danger",
					callback: function() {					
						localStorage.removeItem(deletingWorkflow.key());
						parentViewModel.workflows.remove(deletingWorkflow);
						if(deletingWorkflow.isSelected()){
							self.parent.clearData();
						}
						$('#workflowBtn .badge').effect( "highlight", {color:"#ff0000"}, 1500);
					}
				}
			}
		});
        
    };
	
	/**
    * Selects all input/textarea text
    */
    self.selectText = function (data, event) {
		$(event.target).select();
    };

	// Set properties with chain syntax
    self.key(key).name(name);

}