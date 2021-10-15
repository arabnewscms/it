/**
* Custom KnockOut handler: handles key press event, when user presses Enter key
*/
ko.bindingHandlers.enterPress = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel) {
        var allBindings = allBindingsAccessor();
        element.addEventListener('keydown', function (event) {
            var keyCode = (event.which ? event.which : event.keyCode);
            if (keyCode === 13) {
                allBindings.enterPress.call(viewModel);
                return false;
            }
            return true;
        });
    }
};

/**
* Custom KnockOut handler: handles key press event, when user presses Escape key
*/
ko.bindingHandlers.escPress = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel) {
        var allBindings = allBindingsAccessor();
        element.addEventListener('keydown', function (event) {
            var keyCode = (event.which ? event.which : event.keyCode);
            if (keyCode === 27) {
                allBindings.escPress.call(viewModel);
                return false;
            }
            return true;
        });
    }
};

/**
* Custom knockout extender: required field validation
*/
ko.extenders.required = function (target) {
    // add some sub-observables to our observable
    target.hasError = ko.observable();

    // define a function to do validation
    function validate(newValue) {
        target.hasError(newValue ? false : true);
    }

    // initial validation
    validate(target());

    // validate whenever the value changes
    target.subscribe(validate);

    // return the original observable
    return target;
};

/**
* Custom knockout extender: required whole number
*/
ko.extenders.integer = function(target) { 
    //create a writeable computed property to intercept writes to our observable 
    var result = ko.computed({ 
        read: target, 
        write: function(newValue) {
          var current = target(),
valueToWrite = Math.round(isNaN(newValue) ? 0 : newValue);

          if (valueToWrite !== current) {
            target(valueToWrite);
          } else {
            //if the rounded value is the same, but a different value was written, force a notification for the current field to pick it up
            if (newValue != current) {
                target.notifySubscribers(valueToWrite);
            }
          }
        }
    }).extend({ notify: "always" });
    
    //initialize with current value to make sure it is rounded appropriately
    result(target());

    //return the new computed property
    return result;
};