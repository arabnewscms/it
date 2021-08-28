@push('baboon_js')
<script type="text/javascript">
function nk(num, digits=1) {
  const lookup = [
    { value: 1, symbol: "" },
    { value: 1e3, symbol: "k" },
    { value: 1e6, symbol: "M" },
    { value: 1e9, symbol: "G" },
    { value: 1e12, symbol: "T" },
    { value: 1e15, symbol: "P" },
    { value: 1e18, symbol: "E" }
  ];
  const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
  var item = lookup.slice().reverse().find(function(item) {
    return num >= item.value;
  });
  return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
}

function realName(key){
	var name = '';
	if(key == 'project_id'){
	 var name = 'Project';
	}else if(key == 'os'){
	 var name = 'Your OS';
	}else if(key == 'auto_migrate'){
	 var name = 'Auto Migrate';
	}else if(key == 'soft_delete'){
	 var name = 'Soft Delete';
	}else if(key == 'datatable'){
	 var name = 'DataTables';
	}else if(key == 'controller'){
	 var name = 'Controllers';
	}else if(key == 'views'){
	 var name = 'Views Blade';
	}else if(key == 'has_admin'){
	 var name = 'Have Admin';
	}else if(key == 'laravelcollective'){
	 var name = 'Laravel Collective';
	}else if(key == 'model'){
	 var name = 'Models';
	}else if(key == 'linkatmodel'){
	 var name = 'Relations';
	}else if(key == 'migration'){
	 var name = 'Migrations';
	}else if(key == 'col_width_lg_count'){
	 var name = 'col-lg';
	}else if(key == 'col_width_md_count'){
	 var name = 'col-md';
	}else if(key == 'col_width_sm_count'){
	 var name = 'col-sm';
	}else if(key == 'col_width_xs_count'){
	 var name = 'col-xs';
	}else if(key == 'color'){
	 var name = 'Color';
	}else if(key == 'date'){
	 var name = 'Date';
	}else if(key == 'date_time'){
	 var name = 'DateTime';
	}else if(key == 'select_'){
	 var name = 'select';
	}else if(key == 'textarea_ckeditor'){
	 var name = 'textarea With CKEditor';
	}else if(key == 'link_ajax'){
	 var name = 'Ajax With';
	}else if(key == 'col_name_null'){
	 var name = ' Nullable/ SQL NULL';
	}else if(key == 'col_name_has'){
	 var name = ' Have Validation';
	}else if(key == 'forginkeyto'){
	 var name = ' Add Forgin Key';
	}else if(key == 'on_delete'){
	 var name = 'On Delete';
	}else if(key == 'on_update'){
	 var name = 'On Update';
	}else if(key == 'belongsto'){
	 var name = 'Belongs To';
	}else if(key == 'belongstomany'){
	 var name = 'Belongs To Many';
	}else if(key == 'hasmany'){
	 var name = 'Has Many';
	}else if(key == 'hasmanythrough'){
	 var name = 'Has Many Through';
	}else if(key == 'hasone'){
	 var name = 'Has One';
	}else if(key == 'morphmany'){
	 var name = 'Morph Many';
	}else if(key == 'morphmap'){
	 var name = 'Morph Map';
	}else if(key == 'browser'){
	 var name = 'Your Browser';
	}else{
		var name = key;
	}
	return name;
}

var form = new FormData();
//&date={{ date('Y-m-d') }}
var settings = {
  "url": "https://baboonstatistics.tagatsoft.com/api/v1/load/statistics?project_id={{ env('APP_KEY') }}",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Accept": "application/json"
  },
  "processData": false,
  "mimeType": "multipart/form-data",
  "contentType": false,
  "data": form
};

$.ajax(settings).done(function (response) {
	var statistics = JSON.parse(response);
	if(statistics.status){
 		 if(statistics.data.browser){
 		 	$.each(statistics.data.browser, function(key, value) {
			      $('.browser').append('<li>'+key+' : <span class="counter">'+nk(value)+'</span></li>');
			});
 		 }


 		 if(statistics.data.total){
 		 	$('.global').append('<li>Total OS: '+Object.keys(statistics.data.os).length+'</span></li>');
 		 	$('.global').append('<li>Total Browser: '+Object.keys(statistics.data.os).length+'</span></li>');
 		 	$.each(statistics.data.total, function(key, value) {
 		 		if(key == 'project_id' || key == 'id' || key == 'os' || key == 'browser' || key == 'created_at' || key == 'updated_at'){
 		 			if(key != 'project_id' && key != 'created_at' && key != 'updated_at' ){
 		 				if(key == 'os'){
 		 					var val = value == 'Darwin'?'Mac OSX':value;
 		 				}else{
 		 					var val = value;
 		 				}
			      		$('.global').append('<li>'+realName(key)+' : <span class="counter">'+val+'</span></li>');
 		 			}
 		 		}else{
			      $('.global').append('<li>'+realName(key)+' : <span class="counter">'+nk(value)+'</span></li>');
 		 		}
			});
 		 }



 		 if(statistics.data.you){
 		 	$.each(statistics.data.you, function(key, value) {
 		 		if(key == 'project_id' || key == 'id' || key == 'os' || key == 'browser' || key == 'created_at' || key == 'updated_at'){
 		 			if(key != 'project_id' && key != 'created_at' && key != 'updated_at' && key != 'id'){
 		 				if(key == 'os'){
 		 					var val = value == 'Darwin'?'Mac OSX':value;
 		 				}else{
 		 					var val = value;
 		 				}
			      		$('.you').append('<li>'+realName(key)+' : <span class="counter">'+val+'</span></li>');
 		 			}
 		 		}else{
			      $('.you').append('<li>'+realName(key)+' : <span class="counter">'+nk(value)+'</span></li>');
 		 		}
			});
 		 }

 		 if(statistics.data.os){
 		 	$.each(statistics.data.os, function(key, value) {
 		 		if(key == 'Darwin'){
			      $('.os').append('<li>Mac OSX : <span class="counter">'+nk(value)+'</span></li>');
 		 		}else{
			      $('.os').append('<li>'+key+' : <span class="counter">'+nk(value)+'</span></li>');
 		 		}
			});
 		 }
	}
});
</script>
@endpush
<div class="col-md-12">
	<div class="col-md-12">
		<label>
			<input type="checkbox" name="collect" checked class="collect" value="no">
			 Collect My Counters
		</label>
		<hr />
		<p>
<p>What do these stats mean?</p>
These statistics are represented in calculating the number of times the items were generated through Baboon Maker, which is generally or specifically according to your project, so you can see the number of generation operations that you have done with seeing all other operations in general for all users from all over the world
		</p>
	</div>
	<div class="col-md-3">
		<h4>Your Statistics</h4>
		<ol class="you"></ol>
	</div>
	<div class="col-md-3">
		<h4>Global Statistics</h4>
		<ol class="global"></ol>
	</div>
	<div class="col-md-3">
		<h4>Totel OS</h4>
		<ol class="os"></ol>
	</div>
	<div class="col-md-3">
		<h4>Browsers</h4>
		<ol class="browser"></ol>
	</div>
</div>