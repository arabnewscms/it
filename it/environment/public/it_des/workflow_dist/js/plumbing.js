var plumbing = new function() {
	
	var self = this;
	
	self.styles = function() {
		var connPaint =  {
			lineWidth:4,
			strokeStyle:"#61B7CF",
			joinstyle:"round",
			outlineColor:"white",
			outlineWidth:2
		},
		connHover = {
			lineWidth:4,
			strokeStyle:"#216477",
			outlineWidth:2,
			outlineColor:"white"
		},
		endpointHover = {
			fillStyle:"#216477",
			strokeStyle:"#216477"
		};
		return { connPaint: connPaint, connHover: connHover, endpointHover: endpointHover };
	};
	
	self.aSourceEndpoint = function() {
		var styles = self.styles(),
			endpoint = {
				endpoint:"Dot",
				paintStyle: { 
					strokeStyle:"#7AB02C",
					fillStyle:"transparent",
					radius:6,
					lineWidth:3 
				},				
				isSource:true,
				//maxConnections:-1,
				deleteEndpointsOnDetach:false,
				connector:[ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],								                
				connectorStyle:styles.connPaint,
				hoverPaintStyle:styles.endpointHover,
				connectorHoverStyle:styles.connHover
			};
		return endpoint;
	};
	
	self.aTargetEndpoint = function() {
		var styles = self.styles(),
			endpoint = {
				endpoint:"Dot",
				paintStyle: { 
					strokeStyle:"#7AB02C",
					fillStyle:"#7AB02C",
					radius:6,
					lineWidth:3 
				},				
				isTarget:true,
				maxConnections:-1,
				deleteEndpointsOnDetach:false,
				connector:[ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],								                
				connectorStyle:styles.connPaint,
				hoverPaintStyle:styles.endpointHover,
				connectorHoverStyle:styles.connHover
			};
		return endpoint;
	};
	
	self.addEndpoints = function(id, sourceAnchors, targetAnchors) {
		for (var i = 0; i < sourceAnchors.length; i++) {
			jsPlumb.addEndpoint($('#' + id), 
								self.aSourceEndpoint(), 
								{ 
									anchor:sourceAnchors[i], 
									uuid:id+"_"+sourceAnchors[i],
									connectorOverlays:[ 
										[ "Arrow", { location:1 } ],
										[ "Label", { 
											label:"New Result <br /> 0 days later",
											location:0.40,
											id:"label",
											cssClass:"aLabel" //see styles.scss .aLabel
										}]
									]
								});//jsPlumb						
		}//for
		for (var j = 0; j < targetAnchors.length; j++) {
			jsPlumb.addEndpoint($('#' + id), self.aTargetEndpoint(), { anchor:targetAnchors[j], uuid:id+"_"+targetAnchors[j] });						
		}
	};
	
	self.init = function(id) {
		jsPlumb.draggable($('#' + id), { 
				grid: [20, 20],
				// default drag options
				DragOptions : { cursor: 'pointer', zIndex:2000 },
				Container:"flowchart-demo",
				start: function() { 
					//on drag start, hide result edit form & show result label
					$('div.result').hide();
					$('#templates').hide();
					jsPlumb.select().each(function(conn) {
						conn.showOverlay("label");
					}); 
				}
			}
		);
	};
	
	self.plumbIt = function(id) {
		self.addEndpoints(id, ["Right", "Bottom"], ["Top", "Left"]);
		self.init(id);
	};
	
	self.unPlumbIt = function(id) {
		var endpoints = jsPlumb.getEndpoints($('#'+id)); //get all endpoints of that DIV
		for (var i=0; i<endpoints.length; i++) {
			jsPlumb.deleteEndpoint(endpoints[i]);  //remove endpoint
		}
	};
	
	self.connectIt = function(result) {		
		var connection = jsPlumb.connect({uuids:[
											result.sourceId+"_"+result.sourceEndpoint, 
											result.targetId+"_"+result.targetEndpoint
											]
										});
		connection.getOverlay("label").setLabel(result.label + '<br />' + result.daysLater + ' days later');
	}
	
};


