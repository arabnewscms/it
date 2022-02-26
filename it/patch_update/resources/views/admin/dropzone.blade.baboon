@php
// Time to temp id
$temp_id = !empty(request('temp_id'))?request('temp_id'):(time()*rand(0000,9999));

// Prepare temp path and id to rename it in store function
 if(!empty($type) && $type == 'create'){
  $path = $path.'/tempfile_'.$temp_id;
  $id = $temp_id;
 }elseif(!empty($type) && $type == 'edit'){
    $id = !empty($id)?$id:$temp_id;
 }else{
  $path = $path.'/tempfile_'.$temp_id;
  $id = $temp_id;
 }
@endphp



<input type="hidden" name="dz_path" value="{{ $path }}">
<input type="hidden" name="dz_type" value="{{ $type }}">
<input type="hidden" name="dz_id" value="{{ $id }}">

<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" id="drop_{{ $dz_param }}">
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title float-left"> {{ trans('admin.'.$dz_param) }} <small>({{ trans('admin.multi_upload') }})</small></h3>
    </div>
    <div class="card-body">
      <div id="actions_{{ $dz_param }}" class="row">
        <div class="col-lg-6">
          <div class="btn-group w-100">
            <span class="btn btn-success col fileinput-button_{{ $dz_param }} dz-clickable">
              <i class="fas fa-plus"></i>
              <span>{{ trans('admin.add_files') }}</span>
            </span>
            <a href="javascript: void(0)" class="btn btn-primary col start_{{ $dz_param }} hidden">
            <i class="fas fa-upload"></i>
            <span>{{ trans('admin.start_upload') }}</span>
            </a>
            <button type="reset" class="btn btn-warning col cancel_{{ $dz_param }} hidden">
            <i class="fas fa-times-circle"></i>
            <span>{{ trans('admin.cancel_upload') }}</span>
            </button>
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center">
          <div class="row">
          <div><center>{{ trans('admin.drag_drop_files_here') }}</center></div>
          <div class="fileupload-process w-100">
            <div id="{{ $dz_param }}-total-progress" class="progress hidden progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <hr />
      <!--start Previews Template-->
      <div class="table table-striped files" id="previews_{{ $dz_param }}">
        <div id="multi_upload_dropzone_{{ $dz_param }}" class="file-row">
          <!-- This is used as the file preview template -->
          <div>
            <div class="col-md-12">
              <small class="error text-danger" data-dz-errormessage></small>
            </div>
            <div class="col-md-12">
              <div class="row align-items-center h-100">
              <div class="col-md-6">
                  <div class="row align-items-center h-100">
                  <div class="col-md-4">
                    <span class="preview_{{ $dz_param }}">
                    <img data-dz-thumbnail style="width:{{ !empty($thumbnailWidth)?$thumbnailWidth:80 }}px;height: {{ !empty($thumbnailHeight)?$thumbnailHeight:80 }}px;cursor: pointer;" />
                    </span>
                  </div>
                  <div class="col-md-8">
                  <p class="name" data-dz-name></p>
                  <p class="size" data-dz-size></p>
                  </div>
                  </div>
              </div>
              <div class="col-md-6">
                    <a href="javascript: void(0)" class="btn btn-primary start_{{ $dz_param }}">
                      <i class="fa fa-upload"></i>
                      <span>{{ trans('admin.start') }}</span>
                    </a>
                    <a href="javascript: void(0)" data-dz-remove class="btn btn-warning cancel_{{ $dz_param }}">
                      <i class="fa fa-ban"></i>
                      <span>{{ trans('admin.cancel') }}</span>
                    </a>
                    <a href="javascript: void(0)" data-dz-remove class="btn btn-danger delete_{{ $dz_param }}">
                      <i class="fa fa-trash"></i>
                      <span>{{ trans('admin.delete') }}</span>
                    </a>
                    <hr />

                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                  </div>
              </div>
              </div>
              <hr />
            </div>

          </div>
        </div>
      </div>
      <!--End Previews Template-->
    </div>
  </div>
</div>



@push('js')
<script type="text/javascript">
  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode{{$dz_param}} = document.querySelector("#multi_upload_dropzone_{{ $dz_param }}")
  previewNode{{$dz_param}}.id = ""
  var previewTemplate = previewNode{{$dz_param}}.parentNode.innerHTML
  previewNode{{$dz_param}}.parentNode.removeChild(previewNode{{$dz_param}})

  var myDropzone{{$dz_param}} = new Dropzone(
    "#drop_{{ $dz_param }}",

     { // Make the whole body a dropzone
    timeout: "999999",
    url: "{{ aurl($route.'/upload/multi') }}", // Set the url
    paramName:"{{ $dz_param }}",
    // crossDomain: true,
    // format: "json",
    thumbnailWidth: '{{ !empty($thumbnailWidth)?$thumbnailWidth:80 }}',
    thumbnailHeight: '{{ !empty($thumbnailHeight)?$thumbnailHeight:80 }}',
    parallelUploads: '{{ !empty($parallelUploads)?$parallelUploads:20 }}',
    maxFiles: '{{ !empty($maxFiles)?$maxFiles:2000 }}' ,
    maxFileSize: '{{ !empty($maxFileSize)?$maxFileSize:30 }}' ,
    //addRemoveLinks: true,
    previewTemplate: previewTemplate,
    autoQueue: {{ !empty($autoQueue)?$autoQueue:'false' }} , // Make sure the files aren't queued until manually added
    previewsContainer: "#previews_{{ $dz_param }}", // Define the container to display the previews
    clickable: ".fileinput-button_{{ $dz_param }}", // Define the element that should be used as click trigger to select files.
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'X-XSRF-TOKEN': '{{ csrf_token() }}',
        'x-csrftoken': '{{ csrf_token() }}',
    },

    @if(!empty($acceptedMimeTypes))
    acceptedMimeTypes:"{{ str_replace('|',',',$acceptedMimeTypes) }}",
    @endif
  });

  function resetProgress(){
    document.querySelector("#{{ $dz_param }}-total-progress .progress-bar").style.width = "0%";
    document.querySelector("#{{ $dz_param }}-total-progress").style.opacity = "0";
  }


  function findMimeTypeImage(type){
    if(new RegExp("\\b"+"video"+"\\b").test(type)) {
        return '{{ url('assets/img/video.png') }}';
      }else if(new RegExp("\\b"+"wordprocessingml"+"\\b").test(type)) {
        return '{{ url('assets/img/word.png') }}';
      }else if(new RegExp("\\b"+"spreadsheetml"+"\\b").test(type)) {
        return '{{ url('assets/img/xls.jpeg') }}';
      }else if(new RegExp("\\b"+"presentationml"+"\\b").test(type)) {
        return '{{ url('assets/img/power_point.png') }}';
      }else if(new RegExp("\\b"+"audio"+"\\b").test(type)) {
        return '{{ url('assets/img/audio.jpeg') }}';
      }else if(new RegExp("\\b"+"zip"+"\\b").test(type)) {
        return '{{ url('assets/img/zip.jpeg') }}';
      }else if(new RegExp("\\b"+"pdf"+"\\b").test(type)) {
        return '{{ url('assets/img/pdf.png') }}';
      }else if(new RegExp("\\b"+"text"+"\\b").test(type)) {
        return '{{ url('assets/img/text.png') }}';
      }else{
        return '{{ url('assets/img/file.png') }}';
      }
  }

// Generate Random Id String//
function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

      $(document).on('click','.preview_{{ $dz_param }}',function(){
      $('.dz_viewer_{{ $dz_param }}').html('');
      var mimtype_{{ $dz_param }} = $(this).attr('mimtype');
      var url = $(this).attr('url');
      // Image
        if(mimtype_{{ $dz_param }}.match('image.*')){
          var image = `<center>
                        <img src="`+url+`" style="width:100%;height:100%;" />
                       </center>`;
           $('.dz_viewer_{{ $dz_param }}').html(image);
           $("#dz_viewer_{{ $dz_param }}").modal('show');
        }else if(mimtype_{{ $dz_param }}.match('video.*')){
         var random_video{{ $dz_param }} = makeid(10);
         var video = `
            <video class="vjs-theme-fantasy video-js" id="dz_video_viewer`+random_video{{ $dz_param }}+`" data-setup='{"controls": true, "autoplay": false, "preload": "auto"}' width="762px" height="450px" >
              <source src="`+url+`"   >
            </video>`;
           $('.dz_viewer_{{ $dz_param }}').html(video);
           $("#dz_viewer_{{ $dz_param }}").modal('show');
           // Video Player Code //

            var mplayer{{ $dz_param }} = videojs('#dz_video_viewer'+random_video{{ $dz_param }}, {
                controls: true,
                autoplay: false,
                preload: 'auto'
               });
            $("#dz_viewer_{{ $dz_param }}").on('hidden.bs.modal', function() {
             mplayer{{ $dz_param }}.pause();
            });
           // Video Player Code //
        }else if(mimtype_{{ $dz_param }}.match('audio.*')){
          var audio_{{ $dz_param }} = `
          <audio controls style="width:100%">
            <source src="`+url+`">
          </audio>`;
           $('.dz_viewer_{{ $dz_param }}').html(audio_{{ $dz_param }});
           $("#dz_viewer_{{ $dz_param }}").modal('show');
           // Audio Player Code //
           $("#dz_viewer_{{ $dz_param }}").on('hidden.bs.modal', function() {
             $('audio')[0].pause();
           });
           // Audio Player Code //
        }else{
          var win_{{ $dz_param }} = window.open(url, '_blank');
          if (win_{{ $dz_param }}) {
              win_{{ $dz_param }}.focus();
          } else {
              alert('Please allow popups for this website');
          }
        }
      });




    //Add existing files into dropzone
@php
$dz_files = \App\Models\Files::orderBy('id','asc');
    if(!empty($acceptedMimeTypes) && count(explode('|',$acceptedMimeTypes)) > 0){
       foreach(explode('|',$acceptedMimeTypes) as $mime){
          if(preg_match('/^image/i',$acceptedMimeTypes)){
            $extract_name = explode('/',$mime);
             $dz_files->where('mimtype','LIKE','%'.$extract_name[0].'%');
          }
        }
    }
$get_dz_files = $dz_files->where('type_file',$route)->where('type_id',$id)->get();
$mimetypes = array_filter(explode('|',$acceptedMimeTypes));
// || preg_match('/^image/i',$acceptedMimeTypes)
//@if(in_array($file->mimtype,explode('|',$acceptedMimeTypes)))
//@endif
@endphp
    var i=0;
        @foreach($get_dz_files as $file)

        var mockFile = {
          name: '{{ $file->name }}',
          size: '{{ $file->size_bytes }}',
          type: '{{ $file->mimtype }}',
          serverID: '{{ $file->id }}',
          accepted: true
        }; // use actual id server uses to identify the file (e.g. DB unique identifier)

        myDropzone{{$dz_param}}.emit("addedfile", mockFile);
        @if(preg_match('/image/i',$file->mimtype))
         myDropzone{{$dz_param}}.emit('thumbnail', mockFile, '{{ it()->url($file->full_path) }}');

        @else
         myDropzone{{$dz_param}}.emit('thumbnail', mockFile, findMimeTypeImage('{{ $file->mimtype }}'));
        @endif
        myDropzone{{$dz_param}}.emit("success", mockFile);
        myDropzone{{$dz_param}}.emit("complete", mockFile);
        myDropzone{{$dz_param}}.files.push(mockFile);



        $('.start_{{ $dz_param }},.cancel_{{ $dz_param }},.progress').addClass('hidden');

        // Put File Information To Delete it
        $(myDropzone{{$dz_param}}.files[i].previewTemplate).find('.preview_{{ $dz_param }}')
        .attr("fid",'{{ $file->id }}')
        .attr("type_id",'{{ $file->type_id }}')
        .attr("mimtype",'{{ $file->mimtype }}')
        .attr("url",'{{ it()->url($file->full_path) }}')
        .attr("type_file",'{{ $file->type_file }}');

        i++;

        @endforeach
        //console.log(myDropzone{{$dz_param}}.files);



  myDropzone{{$dz_param}}.on("addedfile", function(file) {
    // Hookup the start button
    $('.start_{{ $dz_param }},.cancel_{{ $dz_param }}').removeClass('hidden');
    file.previewElement.querySelector(".start_{{ $dz_param }}").onclick = function() {
      myDropzone{{$dz_param}}.enqueueFile(file);
    }
  });



  // Update the total progress bar
  myDropzone{{$dz_param}}.on("totaluploadprogress", function(progress) {
    document.querySelector("#{{ $dz_param }}-total-progress .progress-bar").style.width = progress + "%";
  })

  myDropzone{{$dz_param}}.on("sending", function(file, xhr, formData) {
    @if(!empty($maxFileSize) && is_numeric($maxFileSize))
    if (file.size > {{ $maxFileSize }}*1024*1024) {
      myDropzone{{$dz_param}}.removeFile(file);
      const SweetDZ = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 10000,
        timerProgressBar: true,
       });

        SweetDZ.fire({
        icon: 'error',
        type: 'error',
        //title: '{{ trans('admin.alert') }}:',
        text: '{{ trans('admin.file_too_big',['size'=>$maxFileSize]) }}'
        });
        return false;
    }
    @endif

    // if(!file.type.match('image.*')) {
    //     myDropzone{{$dz_param}}.removeFile(file);
    //     alert('Not an image')
    //     return false;
    // }

    formData.append("dz_path", "{{ $path }}");
    formData.append("dz_type", "{{ $type }}");
    formData.append("dz_id", "{{ $id }}");
    formData.append("_token", "{{ csrf_token() }}");
    // Show the total progress bar when upload starts
    document.querySelector("#{{ $dz_param }}-total-progress").style.opacity = "1";
    $('.progress').removeClass('hidden');
    // And hidden the start button
    $(file.previewElement).find('.start').addClass('hidden');

  });

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone{{$dz_param}}.on("queuecomplete", function(progress) {
    document.querySelector("#{{ $dz_param }}-total-progress").style.opacity = "0";
    $('.start_{{ $dz_param }},.cancel_{{ $dz_param }}').addClass('hidden');
  });

  // On Delete File must be remove from server also
   myDropzone{{$dz_param}}.on("removedfile", function(file) {
    resetProgress();

    // Delete From Server by type file and type id if temp or real id

      var file_id = $(file.previewElement).find('.preview_{{ $dz_param }}').attr("fid");
      var type_id = $(file.previewElement).find('.preview_{{ $dz_param }}').attr("type_id");
      var type_file = $(file.previewElement).find('.preview_{{ $dz_param }}').attr("type_file");

    if(file_id !== undefined && type_id !== undefined && type_file !== undefined){
      //Ajax Delete Request
      $.ajax({
        url:'{{ aurl($route.'/delete/file') }}',
        dataType:'json',
        type:'post',
        data:{_token:'{{ csrf_token() }}',type_id:type_id,type_file:type_file,id:file_id}
      });
    }
  });

  // myDropzone{{$dz_param}}.on("complete", function(file, response) {
  //   //maxFiles

  // });

  myDropzone{{$dz_param}}.on("error", function(file, response) {
    if(response && response.errors){
      var msg = response.errors.{{ $dz_param }}[0];
      //console.log(file.previewElement);
      $(file.previewElement).find('.error').text(msg);
    }
  });

  // on success and uploaded files set ids
  myDropzone{{$dz_param}}.on("success", function(file, response) {
     resetProgress();
     if(response && response.status == true){
      $(file.previewTemplate).find('.preview_{{ $dz_param }}')
      .attr("fid",response.file.id)
      .attr("type_id",response.file.type_id)
      .attr("mimtype",response.file.mimtype)
      .attr("url",'{{ url('storage') }}/'+response.file.full_path)
      .attr("type_file",response.file.type_file);
     }


     $(file.previewElement).find('.cancel_{{ $dz_param }}').addClass('hidden');
    if(!file.type.match('image.*')){
    file.previewElement.querySelector("img").src = findMimeTypeImage(file.type);
    }
      console.log(file.type);
  });

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions_{{ $dz_param }} .start_{{ $dz_param }}").onclick = function() {
    myDropzone{{$dz_param}}.enqueueFiles(myDropzone{{$dz_param}}.getFilesWithStatus(Dropzone.ADDED));
  }

  document.querySelector("#actions_{{ $dz_param }} .cancel_{{ $dz_param }}").onclick = function() {
     $('.start_{{ $dz_param }},.cancel_{{ $dz_param }}').addClass('hidden');
    document.querySelector("#{{ $dz_param }}-total-progress").style.opacity = "0";
    myDropzone{{$dz_param}}.removeAllFiles(true);
    return false;
  }


  // DropzoneJS Code End
</script>

<!--View Image Modal -->
<div id="dz_viewer_{{ $dz_param }}" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="btn btn-default btn-sm float-left" data-dismiss="modal">x</button>
      </div>
      <div class="modal-body">
        <span class="dz_viewer_{{ $dz_param }}">

        </span>
      </div>
    </div>
  </div>
</div>
<!--View Image Modal End-->

@endpush