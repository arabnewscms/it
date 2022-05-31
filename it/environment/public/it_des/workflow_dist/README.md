Workflow
=========

Workflow provides a way to create visual flowcharts of workflow data.  It is a single page application built with HTML, CSS, and JavaScript.

> [View Demo](http://workflow.webdemo.imprezzio.com)

Dependencies
-----------

Workflow uses a number of open source projects to work properly:

* [jQuery] - as usual.
* [jQueryUI] - for drag and drop and other such ui events.
* [jsPlumb] - for making visual connections (results).
* [knockoutjs] - for updating viewmodels with user input.
* [knockout mapping plugin] - for binding hardcoded data in "demo.data.js" to viewmodels.
* [jquery.cookie] - for remembering which workflow user was last working on to load on next visit.
* [jQuery contextMenu] - neat plugin used for adding steps via a context menu (right click).
* [Twitter Bootstrap] - for some of the ui components and styling.
* [Bootbox.js] - for nice looking alert, confirm, and prompt dialogs.
* [Modernizr] - detects whether or not user's browser has local storage enabled for saving workflows.

---

The Scripts
--------------

* **ko.extensions.js**  
Contains definitions for custom event bindings (saving on ENTER press, etc.).  

* **demo.data.js**  
Since it's just a demo, here are some hardcoded array objects used for binding data to dropdowns, template list, etc. Contains definitions for ContactTypes, UserTypes, and Templates - used for emails and mailings.  

* **workflowViewModel.js**  
Is the parent ViewModel for all other ViewModels. It keeps track of the workflow currently being worked on as well as a list of all saved workflows. It will get/save/delete workflow data from local storage. When the page loads, it'll check for a 'selected_workflow' cookie and load that workflow if it exists.  It also contains the jsPlumb event listeners for adding/removing connections or 'results'.

* **listViewModel.js**  
Defines saved workflows.  Contains the local storage key and user given name.  

* **stepViewModel.js**  
Defines steps (draggable boxes).  Contains user editable data such as name, contact type, description, etc.  Also contains it's x and y position on the screen so it'll be put in the right place when loaded.  

* **resultViewModel.js**  
Defines results (connection between 2 boxes). Contains the ids of the result's source and target steps, as well as the source and target endpoint locations, such as "Bottom" and "Left".  Also contains user editable info displayed on the connection label.  Finally, contains the connection id 'conn_id' given to it when a jsPlumb connection is created.

* **templateViewModel.js**  
Defines templates (used in steps with a contact type of email or mailing).  Contains the id and name of the template.  

* **demo.js**  
Creates templateViewModels (from demo.data.js) and listViewModels (from local storage) pushes them into the workflowViewModel. 

* **plumbing.js**  
Contains settings for the jsPlumb connections and endpoints. Contains functions for turning 'step' divs into jsPlumb objects, adding/removing endpoints from them, and connecting them when a workflow is loaded.  

* **view.js**  
Contains a few functions related to ui interactions, like showing the saved workflow list, hiding the help box, etc.  

---

Workflow Anatomy
--------------  

Here's a simple workflow example:

![Workflow Example](http://workflow.webdemo.imprezzio.com/img/example.png)  

This would get saved as:
```json
{
	"name": "Workflow Example",
	"steps": [{
		"isStart": true,
		"Id": 1,
		"name": "Step 1",
		"contactType": 1,
		"userType": 1,
		"description": "I'm the first step",
		"template": null,
		"top": "80px",
		"left": "20px"
	},
	{
		"isStart": false,
		"Id": 2,
		"name": "Step 2",
		"contactType": 3,
		"userType": 1,
		"description": "I'm the second step",
		"template": null,
		"top": "80px",
		"left": "320px"
	}],
	"results": [{
		"Id": 1,
		"sourceId": "1",
		"targetId": "2",
		"sourceEndpoint": "Right",
		"targetEndpoint": "Left",
		"label": "I'm a result",
		"daysLater": 1
	}]
}
```
You can see, here we have 2 steps and 1 result.  The "result" represents a jsPlumb [connector].  By saving the result's source and target ids and [endpoint] locations, we can tell jsPlumb to draw this [connection] when this workflow gets loaded in the future.  By saving the top and left positions of step divs, we can also put them back in the right place when the workflow gets loaded.

**Some terms to note:**

![Workflow Example](http://workflow.webdemo.imprezzio.com/img/example2.png) 

---

The ViewModels
-------------- 


###WorkflowViewModel

```js
 - contactTypes: mapping.fromJS  //call, mailing, appointment, etc.
 - userTypes: mapping.fromJS  //all agency users, full time, etc.
 - templateTypes: mapping.fromJS //some email template imgs
 - allWorkflows: observableArray //gets populated with saved workflows when page loads
 - workflows: observableArray //keeps track of saved workflows during user session
 - steps: observableArray //draggable boxes in selected workflow
 - results: observableArray //connections between boxes in selected workflow
 - templates: observableArray //for rendering template list in the html
 - selectedTemplate: observable //contains the value of selected template id for a given step
 - tempId: observable //stores the stepId to know which step to update when a template is selected
 - counter: 0 //for updating result conn_id's when loading a saved workflow
 - isDirty: observable //bool to check if there are unsaved changes to the workflow
 ---------------------------------------------------------------------------------------------------
 - addNewStep(contactType, top, left)
 - addNewResult(info)
 - updateResult(info)
 - removeResult(info)
 - showResult(connection) //shows form for updating result label data -> label, daysLater
 - showTemplates(data, event) //shows the template select dialog
 - setTemplate //updates appropriate step with templateId selected in template dialog
 - getNewId(isResult) //assigns a new id to steps and results when created
 - saveOrCancelAllEdits 
 - saveData //saves workflow to local storage as a json string
 - selectWorkflow //gets saved workflow from local storage
 - newWorkflow 
 - deleteAllWorkflows 
 - clearData //clears workFlowViewModel of steps, results.  used when starting a new workflow, etc.
```

**jsPlumb event bindings**  

* [connection] -> addNewResult(info)
* [connectionDetached](http://jsplumbtoolkit.com/doc/events.html#evt-connection-detached) -> removeResult(info) 
* [connectionMoved](http://jsplumbtoolkit.com/doc/events.html#evt-connection-moved) -> updateResult(info) 
* [click](http://jsplumbtoolkit.com/doc/events.html#evt-click) -> showResult(connection)  



###ListViewModel

```js
- key: observable //local storage key
- name: observable //user-given name
- isSelected: observable //currently being worked on
- isActive: observable //name is being edited
- oldName: //for recovering old name value when name editing is aborted (esc key) or new value is invalid (null)
- --------------------------------------------------------------------------------------------------------------
- editWorkflowName(data)
- saveWorkflowName
- cancelEditWorkflowName
- saveOrCancelEdit
- deleteWorkflow
```  

###StepViewModel

```js
 - isStart: observable //bool starting step, only and exactly 1 per workflow
 - id: observable
 - name: observable
 - contactType: observable
 - userType: observable
 - description: observable
 - template: observable //id of selected template
 - top: observable //pixels from top
 - left: observable	//pixels from left
 - isActive: observable //some data is being edited
 - activeField: observable //which field is being edited, passed by A tag in data-update attribute
 - oldName: null //for recovering old value
 - oldDesc: null //for recovering old value
 - ------------------------------------------------------------------------------------------------------------
 - saveStep
 - deleteStep
 - editStep(data)
 - cancelEditStep
 - saveOrCancelEdit
 - setIsStart(data) //sets step isStart bool to true, sets all other steps isStart to false
```  

###ResultViewModel

```js
 - id: observable
 - sourceId: observable //id of step that's the source of the connection
 - targetId: observable //id of step that's the target of the connection
 - sourceEndpoint: observable //name of the source's endpoint location - 'Bottom'
 - targetEndpoint: observable //name of the target's endpoint location - 'Left'
 - label: observable //string
 - daysLater: observable //int
 - conId: observable //stores id given by jsPlumb when connection is made
 - top: observable //helper for knowing where to display the label edit form, based on label position
 - left: observable //same as above
 - width: observable //same as above
 - isActive: observable //currently being edited
 - oldLabel: null //for recovering old value
 - oldDaysLater: null //for recovering old value
 --------------------------------------------------------------------------------------------------------------
 - saveResult
 - deleteResult
 - cancelEditResult
 - saveOrCancelEdit
```  

###TemplateViewModel

```js
 - id: observable //from demo.data.js
 - name: observable //from demo.data.js
 - isSelected: observable //set to true if the id matches template id of the selected step passed down from the parent workflowViewModel.
 --------------------------------------------------------------------------------------------------------------
 - showImg //shows img associated with template on mouseover
 - hideImg //hides img on mouseout
 - setSelected(data) //passes user selected template id back to parent workflowViewModel so it can update the step's template observable with the right value 
```  

---

jsPlumb Elements & Connections
--------------  
**plumbing.js** defines the **plumbing** object, which contains setting info for [connector]s, [endpoint]s, and [label]s.  It also contains functions for adding endpoints to 'step' DIVs, making 'step' DIVs jsPlumb [draggable] elements, and programtically creating and removing jsPlumb [connection]s.  

* **styles**  
connection styles & endpoint hover styles  

* **aSourceEndpoint**  
source endpoint settings  

* **aTargetEndpoint**  
target endpoint settings  

* **addEndpoints(id, sourceAnchors, targetAnchors)**  
Adds endpoints to an element based on id.  Also takes sourceAnchors and targetAnchors arrays that define positions for where to place the end points - ["Top", "Left"], ["Bottom", "Right"].  

* **init(id)**  
sets element as a jsPlumb draggable  

* **plumbIt(id)**  
Called when adding steps to a workflow, in turn it calls the addEndpoint and init functions.  

* **unPlumbIt(id)**  
Called when deleting steps, it removes all the endpoint on a step of a given id. 

* **connectIt(result)**  
Called when loading a saved workflow.  It programatically makes all the connections by looping through the results array (WorkFlowViewModel -> results()) and connecting via uuid's ("1_Right" -> "2_Left").  Also updates the connection overlay label with data from the results item (label, daysLater).



[jQuery]:http://jquery.com
[jQueryUI]:http://jqueryui.com
[knockoutjs]:http://knockoutjs.com
[knockout mapping plugin]:http://knockoutjs.com/documentation/plugins-mapping.html
[jsPlumb]:http://jsplumbtoolkit.com/demo/home/dom.html
[Twitter Bootstrap]:http://getbootstrap.com
[Bootbox.js]:http://bootboxjs.com/
[jquery.cookie]:https://github.com/carhartl/jquery-cookie
[jQuery contextMenu]:https://github.com/medialize/jQuery-contextMenu
[Modernizr]:http://modernizr.com/

[connector]:http://jsplumbtoolkit.com/doc/connectors.html
[endpoint]:http://jsplumbtoolkit.com/doc/endpoints.html
[label]:http://jsplumbtoolkit.com/doc/overlays.html#type-label
[draggable]:http://jsplumbtoolkit.com/doc/home.html#dragging

[connection]:(http://jsplumbtoolkit.com/doc/connections.html#programmatic)
