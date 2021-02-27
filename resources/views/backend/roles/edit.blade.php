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
        <div class="card-toolbar">
          <div class="example-tools justify-content-center">
            <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
            <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
          </div>
        </div>
      </div>
      <!--begin::Form-->
      <form id="formUpdate" action="{{ route('backend.roles.destroy', Request::segment(3)) }}">
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
            <label>Role Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{ $data->name }}" />
          </div>
          <div class="form-group">
            <label>List Permission</label>
            <div class="checkbox-list">
              @foreach($permission as $value)
              <label class="checkbox">
                <input type="checkbox" name="permission[]" value="{{ $value->id }}"
                  {{ in_array($value->id, $rolePermissions) ? 'checked' : NULL }} />
                <span></span>
                {{ ucwords($value->name) }}
              </label>
              @endforeach
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
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
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
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
                  window.location.href = "{{route('backend.roles.index')}}"
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
              toastr.error("Please check your connection", 'Failed !');
          }
        });
    });
  });
</script>
@endsection
