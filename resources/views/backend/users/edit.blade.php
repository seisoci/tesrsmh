{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card card-custom">
      <div class="card-header">
        <h3 class="card-title">
          {{ $config['title'] }}
        </h3>
      </div>
      <!--begin::Form-->
      <form id="formUpdate" action="{{ route('backend.users.update', Request::segment(3)) }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @method('PUT')
        <div class="card-body">
          <div class="form-group" style="display:none;">
            <div class="alert alert-custom alert-light-danger" role="alert">
              <div class="alert-icon"><i class="flaticon-danger text-danger"></i></div>
              <div class="alert-text">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="image-input" id="kt_image_2" style="asset('/media/users/blank.png')">
              <div class="image-input-wrapper"
                style="background-image: url({{ $data['user']->image != NULL ? asset("storage/images/original/".$data['user']->image) : asset('media/users/blank.png') }})">
              </div>
              <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="profile_avatar_remove" />
              </label>
              <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
              </span>
            </div>
            <span class="form-text text-muted">Maximum file 2 MB and format png, jpg, jpeg</span>
          </div>
          <div class="form-group">
            <label>Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter name"
              value="{{ $data['user']->name ?? '' }}" />
          </div>
          <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input type="text" name="email" class="form-control" placeholder="Enter email"
              value="{{ $data['user']->email ?? '' }}" />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" />
            <span class="form-text text-muted">Don't input if u don't want change password.</span>
          </div>
          <div class="form-group">
            <label>Retype Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control"
              placeholder="Enter retype password" />
          </div>
          <div class="form-group">
            <label for="activeSelect">Active <span class="text-danger">*</span></label>
            <select class="form-control" id="activeSelect" name="active">
              <option value="0" {{ $data['user']->active == 0 ? 'selected' : NULL }}>Inactive</option>
              <option value="1" {{ $data['user']->active == 1 ? 'selected' : NULL }}>Active</option>
            </select>
          </div>
          <div class="form-group">
            <label for="roleSelect">Role <span class="text-danger">*</span></label>
            <select class="form-control" id="roleSelect" name="role">
              @foreach ($data['roles'] ?? array() as $item)
              <option value="{{ $item->name }}" {{ $data['userRole']->name == $item->name ? 'selected' : NULL }}>
                {{ ucfirst(str_replace('-',' ', $item->name)) }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
          </div>
      </form>
      <!--end::Form-->
    </div>
  </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}

{{-- page scripts --}}
<script type="text/javascript">
  $(document).ready(function(){
    new KTImageInput('kt_image_2');

    $("#formUpdate").submit(function(e){
      e.preventDefault();
      var form 	= $(this);
      var btnHtml = form.find("[type='submit']").html();
      var spinner = $('<span role="status" class="spinner-border spinner-border-sm" aria-hidden="true"></span>');
      var url 	= form.attr("action");
      var data 	= new FormData(this);
      $.ajax({
          beforeSend:function() {
            form.find("[type='submit']").prop('disabled', true).text(' Loading. . .').prepend(spinner);
          },
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          cache: false,
          processData: false,
          contentType: false,
          type: "POST",
          url : url,
          data : data,
          success: function(response) {
            form.find("[type='submit']").prop('disabled', false).text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm");
            if ( response.status == "success" ){
              toastr.success(response.message,'Success !');
              setTimeout(function() {
                  window.location.href = "{{route('backend.users.index')}}"
              }, 3000);
            }else{
              $("[role='alert']").parent().removeAttr("style");
              $(".alert-text").html('');
              $.each( response.error, function( key, value ) {
                $(".alert-text").append('<span style="display: block">'+value+'</span>');
              });
              toastr.error("Please complete your form",'Failed !');
            }
          },error: function(response){
              form.find("[type='submit']").prop('disabled', false).text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm");
              toastr.error(response.responseJSON.message, 'Failed !');
          }
        });
    });
  });
</script>
@endsection
