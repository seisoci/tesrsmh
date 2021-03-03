{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<!-- begin::Card-->
<div class="card card-custom overflow-hidden">
  <div class="card-body p-0">
    <!-- begin: Invoice-->
    <!-- begin: Invoice header-->
    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
      <div class="col-md-9">
        <div class="d-flex justify-content-between pb-10 pb-md-2 flex-column flex-md-row">
          <h1 class="display-4 font-weight-boldest mb-2 d-block">{{ $data->full_name ?? '' }}</h1>
          <span></span>
          <div class="d-flex flex-column text-right">
            <span>Dibuat tanggal & waktu:</span>
            <span class="font-weight-bolder mb-2 opacity-80">{{ $data->created_at ?? '' }}</span>
          </div>
        </div>
        <div id="data_pelamar" class="pb-10">
          <h4>{{ $data->formation->name ?? '' }}</h4>
          <div class="border-bottom w-100"></div>
          <div class="d-flex justify-content-center pt-8 py-6">
            <div class="d-flex flex-column flex-root align-items-center">
              <h2 class="font-weight-bolder">Data Pelamar</h2>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-8">
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Posisi yang dilamar</span>
              <span class="opacity-70">{{ $data->formation->name ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Nama Lengkap</span>
              <span class="opacity-70">{{ $data->full_name ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root text-right">
              <span class="font-weight-bolder mb-2">Nama Panggilan</span>
              <span class="opacity-70">{{ $data->nickname ??'' }}</span>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-8">
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Tempat Lahir</span>
              <span class="opacity-70">{{ $data->birthplace ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Tanggal Lahir</span>
              <span class="opacity-70">{{ $data->birthdate ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root text-right">
              <span class="font-weight-bolder mb-2">Email</span>
              <span class="opacity-70">{{ $data->email ?? '' }}</span>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-8">
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Jenis Kelamin</span>
              <span class="opacity-70">{{ $data->gender ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Agama</span>
              <span class="opacity-70">{{ $data->religion ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root text-right">
              <span class="font-weight-bolder mb-2">Status</span>
              <span class="opacity-70">{{ $data->status ?? '' }}</span>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-8">
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Tinggi Badan</span>
              <span class="opacity-70">{{ $data->height ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">No Identitas (KTP/SIM)</span>
              <span class="opacity-70">{{ $data->no_identity ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root text-right">
              <span class="font-weight-bolder mb-2">Alamat KTP</span>
              <span class="opacity-70">{{ $data->address_ktp ?? '' }}</span>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-8">
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">NPWP</span>
              <span class="opacity-70">{{ $data->npwp ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">Alamat Tempat Tinggal</span>
              <span class="opacity-70">{{ $data->address ?? '' }}</span>
            </div>
            <div class="d-flex flex-column flex-root text-right">
              <span class="font-weight-bolder mb-2">No Handphone</span>
              <span class="opacity-70">{{ $data->phone ?? '' }}</span>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-8">
            <div class="d-flex flex-column flex-root">
              <span class="font-weight-bolder mb-2">No Telepon</span>
              <span class="opacity-70">{{ $data->phone_2 ?? '' }}</span>
            </div>
          </div>
        </div>
        <div id="data_keluarga" class="pb-10">
          <div class="border-bottom w-100"></div>
          <div class="d-flex justify-content-center pt-8 pb-6">
            <div class="d-flex flex-column flex-root align-items-center">
              <h2 class="font-weight-bolder">Data Keluarga</h2>
            </div>
          </div>
          <h5 class="font-weight-bolder">&#10004;&nbsp; Data Tanggungan</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama Lengkap</th>
                  <th class="font-weight-bold text-muted text-uppercase">Jenis Kelamin</th>
                  <th class="font-weight-bold text-muted text-uppercase">Hubungan</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Pendidikan Terakhir</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest">
                  <td class="pl-0 pt-7">{{ $data->dependent->full_name ?? '' }}</td>
                  <td class="pt-7">{{ $data->dependent->gender ?? '' }}</td>
                  <td class="pt-7">{{ $data->dependent->relationship ?? '' }}</td>
                  <td class="text-danger pr-0 pt-7">{{ $data->dependent->last_education ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <h5 class="font-weight-bolder pt-8">&#10004;&nbsp; Data Keluarga</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama Lengkap</th>
                  <th class="font-weight-bold text-muted text-uppercase">Jenis Kelamin</th>
                  <th class="font-weight-bold text-muted text-uppercase">Hubungan</th>
                  <th class="font-weight-bold text-muted text-uppercase">Pendidikan Terakhir</th>
                  <th class="font-weight-bold text-muted text-uppercase">Tempat Lahir</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Tanggal Lahir</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data->family ?? array() as $item)
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $item->full_name ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->gender ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->relationship ?? '' }}</td>
                  <td class="border-top-0 text-danger pt-7">{{ $item->last_education ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->birthplace ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->birthdate ?? '' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <h5 class="font-weight-bolder pt-8">&#10004;&nbsp; Kontak Darurat</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama</th>
                  <th class="font-weight-bold text-muted text-uppercase">Hubungan</th>
                  <th class="font-weight-bold text-muted text-uppercase">Nomor Handphone</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Alamat</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $data->emergencycontact->full_name ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->emergencycontact->relationship ?? '' }}</td>
                  <td class="border-top-0 text-danger pt-7">{{ $data->emergencycontact->phone ?? '' }}</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->emergencycontact->address ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div id="data_pendidikan" class="pb-10">
          <div class="border-bottom w-100"></div>
          <div class="d-flex justify-content-center pt-8 pb-6">
            <div class="d-flex flex-column flex-root align-items-center">
              <h2 class="font-weight-bolder">Data Riwayat Pendidikan</h2>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama Institusi</th>
                  <th class="font-weight-bold text-muted text-uppercase">Kota/Kabupaten</th>
                  <th class="font-weight-bold text-muted text-uppercase">Jurusan</th>
                  <th class="font-weight-bold text-muted text-uppercase">Tahun Kelulusan</th>
                  <th class="font-weight-bold text-muted text-uppercase">IPK</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Melanjutkan Pendidikan ?</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $data->education->institution_name ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->education->city ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->education->majors ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->education->graduation_year ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->education->gpa ?? '' }}</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->education->continue_education ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div id="data_organisasi" class="pb-10">
          <div class="border-bottom w-100"></div>
          <div class="d-flex justify-content-center pt-8 pb-6">
            <div class="d-flex flex-column flex-root align-items-center">
              <h2 class="font-weight-bolder">Data Pengalaman Organisasi, Pelatihan, Bahasa Asing</h2>
            </div>
          </div>
          <h5 class="font-weight-bolder">&#10004;&nbsp; Pengalaman Organisasi</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama Organisasi</th>
                  <th class="font-weight-bold text-muted text-uppercase">Jabatan</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Tahun</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $data->organization->name ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->organization->position ?? '' }}</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->organization->year ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <h5 class="font-weight-bolder pt-8">&#10004;&nbsp; Riwayat Pelatihan</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama</th>
                  <th class="font-weight-bold text-muted text-uppercase">Tahun</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Masa Berlaku</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $data->training->name ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->training->year ?? '' }}</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->training->expired ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <h5 class="font-weight-bolder pt-8">&#10004;&nbsp; Bahasa Asing</h5>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Bahasa</th>
                  <th class="font-weight-bold text-muted text-uppercase">Mendengar</th>
                  <th class="font-weight-bold text-muted text-uppercase">Membaca</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Menulis</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $data->foreignlanguage->language ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->foreignlanguage->listening ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $data->foreignlanguage->speaking ?? '' }}</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->foreignlanguage->writing ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div id="data_pengalaman" class="pb-10">
          <div class="border-bottom w-100"></div>
          <div class="d-flex justify-content-center pt-8 pb-6">
            <div class="d-flex flex-column flex-root align-items-center">
              <h2 class="font-weight-bolder">Data Pengalaman Kerja</h2>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase">Nama Perusahaan</th>
                  <th class="font-weight-bold text-muted text-uppercase">Perusahaan Di bidang</th>
                  <th class="font-weight-bold text-muted text-uppercase">Alamat</th>
                  <th class="font-weight-bold text-muted text-uppercase">Jabatan</th>
                  <th class="font-weight-bold text-muted text-uppercase">Tanggal Masuk</th>
                  <th class="font-weight-bold text-muted text-uppercase">Tanggal Keluar</th>
                  <th class="font-weight-bold text-muted text-uppercase">Gaji</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Alasan Berhenti Kerja?</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data->workexperience ?? array() as $item)
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">{{ $item->name ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->sector ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->address ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->position ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->date_start ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->date_end ?? '' }}</td>
                  <td class="border-top-0 pt-7">{{ $item->salary ?? '' }}</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $item->resign ?? '' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div id="data_kuisioner" class="pb-10">
          <div class="border-bottom w-100"></div>
          <div class="d-flex justify-content-center pt-8 pb-6">
            <div class="d-flex flex-column flex-root align-items-center">
              <h2 class="font-weight-bolder">Data Riwayat Pendidikan</h2>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="pl-0 font-weight-bold text-muted text-uppercase style=" width:65%"">Pertanyaan</th>
                  <th class="pr-0 font-weight-bold text-muted text-uppercase">Jawaban</th>
                </tr>
              </thead>
              <tbody>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">1. Darimana anda mengetahui lowongan kerjadi RS.Mitra Husada</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_1 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">2. Apakah anda pernah melamar kerja di RS.Mitra Husada
                    sebelumnya.Kapan dan posisi
                    apa?</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_2 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">3. Apakah saat ini anda melamar kerja di perusahaan/rs lain?
                    sebagai posisi
                    apa?</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_3 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">4. Apakah saat ini anda terikat kontrak dengan perusahaan/rs lain?
                  </td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_4 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">5. Apakah anda memilki pekerjaan part time?dimana san sebagai apa?
                  </td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_5 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">6. Apakah anda pernah mengalami sakit keras atau menjalani
                    perawatan
                    intensif? Jika iya kapan dan sebutkan penyakitnya?</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_6 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">7. Apabila diterima, kapan anda mulai bekerja</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_7 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">8. Berapa besar gaji yang anda harapkan?</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_8 ?? '' }}</td>
                </tr>
                <tr class="font-weight-boldest border-bottom-0">
                  <td class="border-top-0 pl-0 pt-7">9. Apakah anda mempunyai saudara atau teman yang bekerja di
                    rs.mitra
                    husada</td>
                  <td class="border-top-0 pr-0 pt-7">{{ $data->others->answer_9 ?? '' }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end: Invoice header-->
  <!-- begin: Invoice footer-->
  <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
    <div class="text-center">
      <h5 class="text-small text-center">&copy;2021 Rumah Sakit Mitra Husada</h5>
      <span class="text-center">Dokumen Pribadi</span>
    </div>
  </div>
  <!-- end: Invoice footer-->
  <!-- begin: Invoice action-->
  <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
    <div class="col-md-9">
      <div class="d-flex justify-content-between">
        <span></span>
        <button type="button" class="d-print-none btn btn-primary font-weight-bold" onclick="window.print();">Print
          Data</button>
      </div>
    </div>
  </div>
  <!-- end: Invoice action-->
  <!-- end: Invoice-->
</div>
<!-- end::Card-->
@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

<script>
  $(document).ready(function(){
    $('body').addClass('print-content-only');
  });
</script>
@endsection
