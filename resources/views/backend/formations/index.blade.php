{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<!--begin::Card-->
<div class="card card-custom">
  <div class="card-header flex-wrap py-3">
    <div class="card-title">
      <h3 class="card-label">{{ $config['page_title'] }}
        <span class="d-block text-muted pt-2 font-size-sm">{{ $config['page_description'] }}</span></h3>
    </div>
    <div class="card-toolbar">
      <!--begin::Dropdown-->
      <div class="dropdown dropdown-inline mr-2">
        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="svg-icon svg-icon-md">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
              height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path
                  d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                  fill="#000000" opacity="0.3"></path>
                <path
                  d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                  fill="#000000"></path>
              </g>
            </svg>
            <!--end::Svg Icon-->
          </span>Export</button>
        <!--begin::Dropdown Menu-->
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <!--begin::Navigation-->
          <ul class="navi flex-column navi-hover py-2">
            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" id="export_print">
                <span class="navi-icon">
                  <i class="la la-print"></i>
                </span>
                <span class="navi-text">Print</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" id="export_copy">
                <span class="navi-icon">
                  <i class="la la-copy"></i>
                </span>
                <span class="navi-text">Copy</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" id="export_excel">
                <span class="navi-icon">
                  <i class="la la-file-excel-o"></i>
                </span>
                <span class="navi-text">Excel</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" id="export_csv">
                <span class="navi-icon">
                  <i class="la la-file-text-o"></i>
                </span>
                <span class="navi-text">CSV</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link" id="export_pdf">
                <span class="navi-icon">
                  <i class="la la-file-pdf-o"></i>
                </span>
                <span class="navi-text">PDF</span>
              </a>
            </li>
          </ul>
          <!--end::Navigation-->
        </div>
        <!--end::Dropdown Menu-->
      </div>
      <!--end::Dropdown-->
      <!--begin::Button-->
      <a href="#" data-toggle="modal" data-target="#modalCreate" class="btn btn-primary font-weight-bolder">
        <span class="svg-icon svg-icon-md">
          <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
            viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect x="0" y="0" width="24" height="24"></rect>
              <circle fill="#000000" cx="9" cy="15" r="6"></circle>
              <path
                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                fill="#000000" opacity="0.3"></path>
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>New Record</a>
      <!--end::Button-->
    </div>
  </div>

  <div class="card-body">
    <!--begin: Datatable-->
    <table class="table table-bordered table-hover table-checkable" id="Datatable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create {{ $config['page_title'] }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <form id="formStore" action="{{ route('backend.formations.store') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Name formation</label>
            <input type="text" name="name" class="form-control form-control-solid" placeholder="Ex: Perawat" />
          </div>
          <div class="form-group">
            <label>Description qualification</label>
            <textarea name="description" rows="15" class="form-control form-control-solid"
              placeholder="Ex: 1. et officia laboriosam"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" type="button" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create {{ $config['page_title'] }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <form id="formUpdate" action="#">
        @method('PUT')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="modal-body">
          <div class="form-group">
            <label>Name formation</label>
            <input type="text" name="name" class="form-control form-control-solid" placeholder="Ex: Perawat" />
          </div>
          <div class="form-group">
            <label>Description qualification</label>
            <textarea name="description" rows="15" class="form-control form-control-solid"
              placeholder="Ex: 1. et officia laboriosam"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" type="button" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      @method('DELETE')
      <div class="modal-body">
        <a href="" type="hidden" name="id" disabled></a>
        Are you sure you want to delete this item? </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="formDelete" type="button" class="btn btn-danger">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
{{-- page scripts --}}
<script type="text/javascript">
  $(document).ready(function(){
    var datatable = $('#Datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        order: [[0, 'asc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: "{{ route('backend.formations.index') }}",
        buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        columns: [
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });

    $("#export_print").on("click", (function(e) {
      e.preventDefault(), datatable.button(0).trigger()
    })),
    $("#export_copy").on("click", (function(e) {
      e.preventDefault(), datatable.button(1).trigger()
    })),
    $("#export_excel").on("click", (function(e) {
      e.preventDefault(), datatable.button(2).trigger()
    })),
    $("#export_csv").on("click", (function(e) {
      e.preventDefault(), datatable.button(3).trigger()
    })),
    $("#export_pdf").on("click", (function(e) {
      e.preventDefault(), datatable.button(4).trigger()
    }));

    $('#modalDelete').on('show.bs.modal', function (event) {
      var id = $(event.relatedTarget).data('id');
      $(this).find('.modal-body').find('a[name="id"]').attr('href', '{{ route("backend.formations.index") }}/'+ id);
    });

    $('#modalDelete').on('hidden.bs.modal', function (event) {
      $(this).find('.modal-body').find('a[name="id"]').attr('href', '');
    });

    $('#modalCreate').on('show.bs.modal', function (event) {
    });

    $('#modalCreate').on('hidden.bs.modal', function (event) {
      $(this).find('.modal-body').find('input[name="name"]').val('');
      $(this).find('.modal-body').find('textarea[name="description"]').val('');
    });

    $('#modalEdit').on('show.bs.modal', function (event) {
      var id = $(event.relatedTarget).data('id');
      var name = $(event.relatedTarget).data('name');
      var description = $(event.relatedTarget).data('description');
      $(this).find('#formUpdate').attr('action', '{{ route("backend.formations.index") }}/'+id)
      $(this).find('.modal-body').find('input[name="name"]').val(name);
      $(this).find('.modal-body').find('textarea[name="description"]').val(description);
    });

    $('#modalEdit').on('hidden.bs.modal', function (event) {
      $(this).find('.modal-body').find('input[name="name"]').val('');
      $(this).find('.modal-body').find('textarea[name="description"]').val('');
      $(this).find('#formUpdate').attr('action', '#')
    });

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
            datatable.draw();
            $('#modalCreate').modal('hide');
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
            datatable.draw();
            $('#modalEdit').modal('hide');
          }else{
            $("[role='alertform']").css('display','block').html('');
            $.each( response.error, function( key, value ) {
                $("[role='alertform']").append('<span style="display: block">'+value+'</span>');
            });
            toastr.error("Please complete your form",'Failed !');
          }
        },error: function(response){
            form.find("[type='submit']").prop('disabled', false).text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm");
            toastr.error("Please complete your form",'Failed !');
        }
      });
    });

    $("#formDelete").click(function(e){
      e.preventDefault();
      var form 	    = $(this);
      var url 	    = $('#modalDelete').find('a[name="id"]').attr('href');
      var btnHtml   = form.html();
      var _token    = "{{ csrf_token() }}";
      var spinner   = $('<span role="status" class="spinner-border spinner-border-sm" aria-hidden="true"></span>');
      $.ajax({
            beforeSend:function() {
              form.text(' Loading. . .').prepend(spinner);
            },
            type: 'DELETE',
            url: url,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                toastr.success(response.message,'Success !');
                form.text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm").html(btnHtml);
                $('#modalDelete').modal('hide');
                datatable.draw();
            },
            error: function (response) {
              toastr.error(response.responseJSON.message ,'Failed !');
              form.text('Submit').find("[role='status']").removeClass("spinner-border spinner-border-sm").html(btnHtml);
              $('#modalDelete').modal('hide');
              $('#modalDelete').find('a[name="id"]').attr('href', '');
            }
        });
    });
  });
</script>
@endsection
