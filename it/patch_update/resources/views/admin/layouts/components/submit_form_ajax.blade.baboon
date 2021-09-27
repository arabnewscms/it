@push('js')
<script type="text/javascript">
function scrollTo(IdorClass){
	var element_validate = $(IdorClass+'');
	if(element_validate.length){
		$('body,html').animate({
	            scrollTop: element_validate.offset().top - 100
	    }, 100,'swing');
    }
}

function showSweetAlertMessage(message,redirect=''){
	const SweetAlert = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 5000,
	  timerProgressBar: true,
	});

	SweetAlert.fire({
		icon: 'success',
		type: 'success',
		title: ' {{ trans('admin.success') }} :',
		text: message,
	});

// redirect to index module if click add btn
 if(redirect == 'add' || redirect == 'save'){
	setTimeout(function(){
		window.location.href = "{{ aurl(str_replace('#','', $form)) }}";
	},5000);
 }
}
$(document).ready(function(){
 // Save action to redirect
 var btnAction;
 $(document).on('click','button[type="submit"]',function(){
 	btnAction = $(this).attr('name');
 });

 // Prepare Form Data And Button
 var form_id = '{{ $form }}';
 var buttons = $('button[type="submit"]');
 // Start Ajax Code
	$(document).on('submit',form_id,function(e){
	 var form = $(form_id)[0];
	 $.ajax({
	    url: $(form).attr("action"),
	    type: $(form).attr("method"),
	    dataType: "JSON",
	    data: new FormData(form),
	    processData: false,
	    contentType: false,
	    beforeSend: function(){
	       buttons.addClass('hidden');
	       $(buttons).parent('div').append('<i class="fa fa-spinner fa-spin"></i>');
	       $('div.invalid-feedback').remove();
	       $('input.is-invalid,select.is-invalid,textarea.is-invalid,.form-control.is-invalid').removeClass('is-invalid');
	    },success: function (data, status){
	       scrollTo(form_id);
	       $('.fa-spin').remove();
	       buttons.removeClass('hidden');
	       if(btnAction != 'save' && btnAction !== 'save_back'){
	        form.reset();
	       }
	       showSweetAlertMessage(data['message'],btnAction);
	    },error: function (xhr, desc, err){
	       buttons.removeClass('hidden');
	       $('.fa-spin').remove();
	       if(xhr && xhr.responseJSON && xhr.responseJSON.errors){
	        var errors = xhr.responseJSON.errors;
	        scrollTo(form_id+' #'+Object.keys(errors)[0]);
	         $.each(errors,function(key,value){
	            $(form_id+' #'+key).addClass('is-invalid');
	            if($(form_id+' #'+key).attr('type') == 'file'){
	            $(form_id+' .'+key).append(`<div class="invalid-feedback">`+value[0]+`</div>`);
	            $('.invalid-feedback').show();
	            }else if($(form_id+' #'+key+':has(select)')){
	            $(form_id+' .'+key).append(`<div class="invalid-feedback">`+value[0]+`</div>`);
	            $('.invalid-feedback').show();
	            }else{
	            $(form_id+' #'+key).parent('div').append(`<div class="invalid-feedback">`+value[0]+`</div>`);
	            }
	         });
	       }
	    }
	 });
	 // Stop Form To submition
	 e.preventDefault(e);
	});
	// End Ajax Code
});
</script>
@endpush