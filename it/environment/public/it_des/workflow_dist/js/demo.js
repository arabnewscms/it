(function() {
	'use strict';
	
	// Create chart view model
	var workflowViewModel = new WorkflowViewModel();
	
	/**
	* Initializes view model and apply bindings
	*/
	function initializeDemoData(demoData) {
		
		// Add Templates to chart
		if (demoData.templates) {
		    for (var i = 0; i < demoData.templates.length; i++) {
		        var template = demoData.templates[i],
                    templateViewModel = new TemplateViewModel(workflowViewModel, template.Id, template.name);

		        workflowViewModel.templates.push(templateViewModel);
		    }
		}
		
		
		if (Modernizr.localstorage) {
			// Add Saved data to workflow list
		    for (var i = 0; i < localStorage.length; i++) {
		        var key = localStorage.key(i);

				if(key.substr(0, key.indexOf(".")) === "workflow") {
					var value = JSON.parse(localStorage[key]),
						listViewModel = new ListViewModel(workflowViewModel, key, value.name);	
					workflowViewModel.allWorkflows.push(listViewModel);
				}
		    }
		}
	    // Initialize chart view model
		workflowViewModel.initialize();

		// Bind view model to view
		ko.applyBindings(workflowViewModel);
	}
		
	initializeDemoData(demoData);
	
})();