@extends('admin.master')

@section('content')

<!-- Main content -->
<section class="content" id="newBtnSection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-secondary my-3" id="newBtn">Add new</button>
        </div>
      </div>
    </div>
</section>
<!-- /.content -->


<section class="content mt-3" id="addThisFormContainer">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title" id="cardTitle">Add new data</h3>
                    </div>
                    <div class="card-body">
                        <form id="createThisForm">
                            @csrf
                            <input type="hidden" class="form-control" id="codeid" name="codeid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                                    </div>
                                </div>
                                <div class="col-sm-2 d-none">
                                    <div class="form-group">
                                        <label>Amount <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" id="short_desc" name="short_desc" rows="3" placeholder="Enter short description"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea class="form-control summernote" id="long_desc" name="long_desc" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="icon">Icon (Bootstrap Icon Class)</label>
                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Enter icon class, e.g., bi-bullseye">
                                        <button type="button" id="checkIconBtn" class="btn btn-primary mt-2">Check Icon</button>
                                        <div class="mt-2" id="iconPreview" style="font-size:24px;"></div>
                                        <small>See all icons at <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image (800x600)</label>
                                        <input type="file" class="form-control-file" id="image" accept="image/*">
                                        <img id="preview-image" src="#" alt="" style="max-width: 300px; width: 100%; height: auto; margin-top: 20px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>YouTube Link</label>
                                        <input type="url" class="form-control" id="youtube_link" name="youtube_link" placeholder="Enter YouTube link">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Video Upload</label>
                                        <input type="file" class="filepond" id="video" name="video" accept="video/mp4,video/webm">
                                        <div id="video-preview" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-none">
                                <label>Sort Order</label>
                                <input type="number" class="form-control" id="sl" name="sl" value="0">
                            </div>
                            
                            <!-- Meta Fields Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4>SEO Meta Fields</h4>
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Meta Keywords (comma separated)</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="e.g. service, business, company">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Meta Image (1200x630 recommended)</label>
                                        <input type="file" class="form-control-file" id="meta_image" accept="image/*">
                                        <img id="preview-meta-image" src="#" alt="" style="max-width: 300px; width: 100%; height: auto; margin-top: 20px;">
                                    </div>
                                </div>
                            </div>
                            <!-- End Meta Fields Section -->
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="addBtn" class="btn btn-secondary" value="Create">Create</button>
                        <button type="submit" id="FormCloseBtn" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content" id="contentContainer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">All Data</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table cell-border table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    {{-- <th>Amount</th> --}}
                                    {{-- <th>Sort No.</th> --}}
                                    {{-- <th>Video</th> --}}
                                    {{-- <th>Image</th> --}}
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection

@section('script')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<script>
  FilePond.registerPlugin(
      FilePondPluginImagePreview,
      FilePondPluginFileValidateType
  );

  const pond = FilePond.create(document.querySelector('.filepond'), {
      acceptedFileTypes: ['video/mp4', 'video/webm'],
      fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
          resolve(type);
      }),
      maxFileSize: '50MB',
      labelIdle: 'Drag & Drop your video or <span class="filepond--label-action">Browse</span>',
      labelFileTypeNotAllowed: 'File of invalid type',
      fileValidateTypeLabelExpectedTypes: 'Expects MP4 or WebM',
      allowProcess: false,
      allowRemove: true,
      allowRevert: false
  });
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
  $(document).ready(function () {
      $('#checkIconBtn').click(function() {
          var val = $('#icon').val().trim();
          if(val){
              $('#iconPreview').html('<i class="bi ' + val + '"></i>');
          } else {
              $('#iconPreview').html('<span style="color:red">Please enter an icon class.</span>');
          }
      });

      $("#addThisFormContainer").hide();
      $("#newBtn").click(function(){
          clearform();
          $("#newBtn").hide(100);
          $("#addThisFormContainer").show(300);
      });
      $("#FormCloseBtn").click(function(){
          $("#addThisFormContainer").hide(200);
          $("#newBtn").show(100);
          clearform();
      });

      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      
      var url = "{{URL::to('/admin/service')}}";
      var upurl = "{{URL::to('/admin/service-update')}}";

      $("#addBtn").click(function(){
          // Create or Update
          var form_data = new FormData();
          form_data.append("title", $("#title").val());
          form_data.append("sl", $("#sl").val());
          form_data.append("amount", $("#amount").val());
          form_data.append("short_desc", $("#short_desc").val());
          form_data.append("icon", $("#icon").val());
          form_data.append("long_desc", $("#long_desc").val());
          form_data.append("youtube_link", $("#youtube_link").val());
          form_data.append("meta_title", $("#meta_title").val());
          form_data.append("meta_description", $("#meta_description").val());
          form_data.append("meta_keywords", $("#meta_keywords").val());

          // Image upload
          var imageInput = document.getElementById('image');
          if(imageInput.files && imageInput.files[0]) {
              form_data.append("image", imageInput.files[0]);
          }

          if (pond.getFiles().length > 0) {
              form_data.append("video", pond.getFiles()[0].file);
          }

          // Meta image upload
          var metaImageInput = document.getElementById('meta_image');
          if(metaImageInput.files && metaImageInput.files[0]) {
              form_data.append("meta_image", metaImageInput.files[0]);
          }

          if($(this).val() == 'Create') {
              // Create
              $.ajax({
                  url: url,
                  method: "POST",
                  contentType: false,
                  processData: false,
                  data: form_data,
                  success: function(res) {
                    clearform();
                    success(res.message);
                    pageTop();
                    reloadTable();
                  },
                  error: function(xhr) {
                    console.error(xhr.responseText);
                    pageTop();
                    if (xhr.responseJSON && xhr.responseJSON.errors)
                      error(Object.values(xhr.responseJSON.errors)[0][0]);
                    else
                      error();
                  }
              });
          } else {
              // Update
              form_data.append("codeid", $("#codeid").val());
              
              $.ajax({
                  url: upurl,
                  type: "POST",
                  dataType: 'json',
                  contentType: false,
                  processData: false,
                  data: form_data,
                  success: function(res) {
                    clearform();
                    success(res.message);
                    pageTop();
                    reloadTable();
                  },
                  error: function(xhr) {
                    console.error(xhr.responseText);
                    pageTop();
                    if (xhr.responseJSON && xhr.responseJSON.errors)
                      error(Object.values(xhr.responseJSON.errors)[0][0]);
                    else
                      error();
                  }
              });
          }
      });

      //Edit
      $("#contentContainer").on('click','.edit', function(){
          $("#cardTitle").text('Update this data');
          let codeid = $(this).data('id');
          info_url = url + '/'+codeid+'/edit';
          $.get(info_url,{},function(d){
              populateForm(d);
              pageTop();
          });
      });
      //Edit  end

      //Delete
      $("#contentContainer").on('click', '.delete', function() {
          if(!confirm('Sure?')) return;
          codeid = $(this).data('id');
          info_url = url + '/'+codeid;
          $.ajax({
              url:info_url,
              method: "GET",
              type: "DELETE",
              data:{
              },
              success: function(res) {
                clearform();
                success(res.message);
                pageTop();
                reloadTable();
              },
              error: function(xhr) {
                console.error(xhr.responseText);
                pageTop();
                if (xhr.responseJSON && xhr.responseJSON.errors)
                  error(Object.values(xhr.responseJSON.errors)[0][0]);
                else
                  error();
              }
          });
      });
      //Delete  
      
      function populateForm(data) {
          $("#title").val(data.title);
          $("#sl").val(data.sl);
          $("#amount").val(data.amount); 
          $("#short_desc").val(data.short_desc); 
          $("#long_desc").summernote('code', data.long_desc);
          $("#youtube_link").val(data.youtube_link);
          $("#meta_title").val(data.meta_title);
          $("#meta_description").val(data.meta_description);
          $("#meta_keywords").val(data.meta_keywords);
          $("#icon").val(data.icon);
          $("#codeid").val(data.id);

          // Image
          if(data.image) {
              $("#preview-image").attr('src', '/images/service/' + data.image);
              if(!$("#preview-image").next('.remove-file').length) {
                  $("<button/>", {
                      type: "button",
                      class: "btn btn-danger remove-file position-absolute top-0 end-0",
                      html: '<i class="fas fa-times"></i>',
                      "data-filename": data.image,
                      "data-path": "images/service",
                      "data-model": "Service",
                      "data-id": data.id,
                      "data-col": "image"
                  }).insertAfter("#preview-image");
                  $("#preview-image").parent().css('position', 'relative');
              }
          } else {
              $("#preview-image").attr('src', '');
              $("#preview-image").next('.remove-file').remove();
          }

          // Video
          $(".video-remove-btn").remove(); 
          if(data.video) {
              $("<button/>", {
                  type: "button",
                  class: "btn btn-danger remove-file video-remove-btn",
                  html: '<i class="fas fa-times"></i> Remove Video',
                  "data-filename": data.video,
                  "data-path": "images/service/videos",
                  "data-model": "Service",
                  "data-id": data.id,
                  "data-col": "video"
              }).insertAfter("#video");
          }

          // Meta Image
          if(data.meta_image) {
              $("#preview-meta-image").attr('src', '/images/service/meta/' + data.meta_image);
              if(!$("#preview-meta-image").next('.remove-file').length) {
                  $("<button/>", {
                      type: "button",
                      class: "btn btn-danger remove-file position-absolute top-0 end-0",
                      html: '<i class="fas fa-times"></i>',
                      "data-filename": data.meta_image,
                      "data-path": "images/service/meta",
                      "data-model": "Service",
                      "data-id": data.id,
                      "data-col": "meta_image"
                  }).insertAfter("#preview-meta-image");
                  $("#preview-meta-image").parent().css('position', 'relative');
              }
          } else {
              $("#preview-meta-image").attr('src', '');
              $("#preview-meta-image").next('.remove-file').remove();
          }

          $("#addBtn").val('Update').html('Update');
          $("#addThisFormContainer").show(300);
          $("#newBtn").hide(100);
      }
      
      function clearform(){
          $('#createThisForm')[0].reset();
          $('.summernote').summernote('reset');
          pond.removeFiles();
          $("#addBtn").val('Create');
          $("#addBtn").html('Create');
          $("#addThisFormContainer").slideUp(200);
          $("#newBtn").slideDown(200);
          $('#preview-image').attr('src', '#');
          $('#preview-meta-image').attr('src', '#');
          $("#cardTitle").text('Add new data');
          $('#createThisForm').find('.remove-file').remove();
      }

      previewImage('#image', '#preview-image');
      previewImage('#meta_image', '#preview-meta-image');

      $(document).on('change', '.toggle-status', function() {
        var service_id = $(this).data('id');
        var status = $(this).prop('checked') ? 1 : 0;

        $.ajax({
          url: '/admin/service-status',
          method: "POST",
          data: {
            service_id: service_id,
            status: status,
            _token: "{{ csrf_token() }}"
          },
          success: function(res) {
            success(res.message);
            reloadTable();
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            error('Failed to update status');
          }
        });
      });

      let table = $('#example1').DataTable({
        processing: true,
        serverSide: true,
          ajax: {
          url: '{{ route("allservice") }}',
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        },
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'icon', name: 'icon', orderable: false, searchable: false },
          // { data: 'image', name: 'image', orderable: false, searchable: false },
          { data: 'title', name: 'title' },
          // { data: 'amount', name: 'amount' },
          // { data: 'sl', name: 'sl' },
          // { data: 'video', name: 'video', orderable: false, searchable: false },
          { data: 'status', name: 'status', orderable: false, searchable: false },
          { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        responsive: true,
        lengthChange: false,
        autoWidth: false,
      });

      function reloadTable() {
        table.ajax.reload(null, false);
      }

  });
</script>

@endsection