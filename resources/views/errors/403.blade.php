{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="d-flex flex-column flex-root w-100 h-100">
  <!--begin::Error-->
  <div class="error error-5 d-flex flex-row-fluid bgi-size-cover bgi-position-center"
    style="background-image: url(/media/error/bg5.jpg);">
    <!--begin::Content-->
    <div class="container d-flex flex-row-fluid flex-column justify-content-md-center p-12">
      <h1 class="error-title font-weight-boldest text-info mt-10 mt-md-0 mb-12">Oops!</h1>
      <p class="font-weight-boldest display-4">{{ $errors['code'] }}</p>
      <p class="font-size-h3">{{ $errors['message'] }}</p>
    </div>
    <!--end::Content-->
  </div>
  <!--end::Error-->
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}

{{-- page scripts --}}
@endsection
