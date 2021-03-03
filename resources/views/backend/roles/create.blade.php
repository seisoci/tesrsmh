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
      <form id="formStore" action="{{ route('backend.roles.store') }}">
        @csrf
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
            <input type="text" name="name" class="form-control" placeholder="Enter name" />
          </div>
          <div class="form-group">
            <label>List Permission</label>
            <div class="checkbox-list">
              @foreach($data as $value)
              <label class="checkbox">
                <input type="checkbox" name="permission[]" value="{{ $value->id }}" />
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#formStore").submit(function(e) {
      e.preventDefault();
      var form = $(this);
      var btnHtml = form.find("[type='submit']").html();
      var spinner = $('<span role="status" class="spinner-border spinner-border-sm" aria-hidden="true"></span>');
      var url = form.attr("action");
      var data = new FormData(this);
      $.ajax({
        beforeSend: function() {
          form.find("[type='submit']").prop('disabled', true).text(' Loading. . .').prepend(spinner);
        },
        cache: false,
        processData: false,
        contentType: false,
        type: "POST",
        url: url,
        data: data,
        success: function(response) {
          form.find("[type='submit']").prop('disabled', false).text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm");
          if (response.status == "success") {
            toastr.success(response.message, 'Success !');
            setTimeout(function() {
              window.location.href = "{{route('backend.roles.index')}}"
            }, 3000);
          } else {
            $("[role='alert']").parent().removeAttr("style");
            $(".alert-text").html('');
            $.each(response.error, function(key, value) {
              $(".alert-text").append('<span style="display: block">'+value+'</span>');
            });
            toastr.error("Please complete your form", 'Failed !');
          }
        },
        error: function(response) {
          form.find("[type='submit']").prop('disabled', false).text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm");
          toastr.error(response.responseJSON.message, 'Failed !');
        }
      });
    });
  });
</script>
@endsection
