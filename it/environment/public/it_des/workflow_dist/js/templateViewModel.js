/**
* Template view model
*/
function TemplateViewModel(parent, id, name) {
    var self = this;
	
	self.id = ko.observable();
	self.name = ko.observable();

	// Properties, that never changes dinamically, can be created non-observable
    self.parent = parent;
	
	self.isSelected = ko.observable(false);
	
	// Subscribe to value change events
	self.parent.selectedTemplate.subscribe(function () {
		var id = parent.selectedTemplate();
		if(self.id() == id) {
			self.isSelected(true);
		}
		else {
			self.isSelected(false);
		}
		showSelected();
    });
	
	// Computed KnockOut function, sets check icon css for selected template
	// -------------------------------------------------------------------------------------	
    self.icon = ko.computed(function () {
		if(self.id()) {
			var classes = 'glyphicon';
				
			if(self.isSelected()) {
				classes += ' glyphicon-ok';
			}

			return classes;
		}
    });
	
	// Show template image on popover td hover ---------------------------------------------
	// -------------------------------------------------------------------------------------	
	self.showImg = function () {
		hideSelected();
	};
	
	// Show template image on popover td hover ---------------------------------------------
	// -------------------------------------------------------------------------------------	
	self.hideImg = function () {
		showSelected();
	};
	
	// Show template image on popover td hover ---------------------------------------------
	// -------------------------------------------------------------------------------------	
	self.setSelected = function (data, event) {
		self.parent.selectedTemplate(data.id());
	};
	
	
	function showSelected() {
		$('#templates img').addClass('hidden');
		$('#img_'+self.parent.selectedTemplate()).removeClass('hidden');
	}
	
	function hideSelected() {
		$('#img_'+self.parent.selectedTemplate()).addClass('hidden');
		$('#img_'+self.id()).removeClass('hidden');
	}
	

	// Set properties with chain syntax
    self.id(id).name(name);

}