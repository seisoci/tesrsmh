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
    </div>
  </div>

  <div class="card-body">
    <div class="mb-10">
      <div class="row align-items-center">
        <div class="col-lg-9 col-xl-8">
          <div class="row align-items-center">
            <div class="col-md-4 my-2 my-md-0">
              <div class="d-flex align-items-center">
                <label class="mr-3 mb-0 d-none d-md-block">Formation:</label>
                <select class="form-control" id="select2">
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--begin: Datatable-->
    <table class="table table-bordered table-hover table-checkable" id="Datatable">
      <thead>
        <tr>
          <th>Nama Lengkap</th>
          <th>Formasi</th>
          <th>Email</th>
          <th>Jenis Kelamin</th>
          <th>Agama</th>
          <th>Status</th>
          <th>No Identitas</th>
          <th>No HP</th>
          <th>Tanggal dibuat</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
{{-- Modal --}}
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
        order: [[8, 'desc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.applicants.index') }}",
          data: function(d){
            d.formation = $('#select2').find(':selected').val();
          }
        },
        buttons: ["print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
        columns: [
            {data: 'full_name', name: 'full_name'},
            {data: 'formation.name', name: 'formation.name', orderable: false, searchable: false},
            {data: 'email', name: 'email'},
            {data: 'gender', name: 'gender'},
            {data: 'religion', name: 'religion'},
            {data: 'status', name: 'status'},
            {data: 'no_identity', name: 'no_identity'},
            {data: 'phone', name: 'phone'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          {
            targets: 2,
            width: '100px',
          },
          {
            targets: 3,
            width: '75px',
            render: function(data, type, full, meta) {
              var status = {
                'M': {'title': 'Laki-laki'},
                'F': {'title': 'Perempuan'},
              };
              if (typeof status[data] === 'undefined') {
                return data;
              }
              return status[data].title;
            },
          },
          {
            targets: 4,
            width: '75px',
            render: function(data, type, full, meta) {
              return data.charAt(0).toUpperCase() + data.slice(1);
            },
          },
          {
            targets: 5,
            width: '75px',
            render: function(data, type, full, meta) {
              return data.charAt(0).toUpperCase() + data.slice(1);
            },
          },
          {
            targets: 9,
            width: '150px',
          },
        ]
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

    $("#select2").select2({
      placeholder: "Search formation",
      allowClear: true,
      ajax: {
          url: "{{ route('backend.applicants.select2') }}",
          dataType: "json",
          delay: 250,
          data: function(e) {
              return {
                  q: e.term || '',
                  page: e.page || 1
              }
          },
          cache: true
      },
    }).on('change', function (e){
      datatable.draw();
    });

    $('#modalDelete').on('show.bs.modal', function (event) {
      var id = $(event.relatedTarget).data('id');
      $(this).find('.modal-body').find('a[name="id"]').attr('href', '{{ route("backend.applicants.index") }}/'+ id);
    });

    $('#modalDelete').on('hidden.bs.modal', function (event) {
      $(this).find('.modal-body').find('a[name="id"]').attr('href', '');
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
