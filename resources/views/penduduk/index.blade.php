@extends('layouts.app')
@section('title', 'Penduduk')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow card border-bottom-primary">
                <div class="card-header">
                    <div class="float-left">
                        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary btn-sm print-excel" onclick="dialogMonografi()"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pie-chart" viewBox="0 0 16 16">
                                <path
                                    d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793zm1 0V7.5h6.482A7 7 0 0 0 8.5 1.018M14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8" />
                            </svg> Monografi Penduduk
                        </button>
                        <a href="{{ route('penduduk.create') }}" class="btn btn-info btn-sm"><i class="fas fa-plus"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    {{-- @if (auth()->user()->role != 'ketua_rt') --}}
                    <form action="{{ url('penduduk') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="nik" class="col-lg-4">NIK</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="nik" id="nik"
                                            class="form-control form-control-sm"
                                            onkeypress="return numbersonly(this, event);" maxlength="16" placeholder="NIK"
                                            value="{{ request()->get('nik') != null ? request()->get('nik') : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="no_kk" class="col-lg-4">NO KK</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="no_kk" id="no_kk"
                                            class="form-control form-control-sm"
                                            onkeypress="return numbersonly(this, event);" maxlength="16"
                                            placeholder="No. KK"
                                            value="{{ request()->get('no_kk') != null ? request()->get('no_kk') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label for="nama" class="col-lg-2">Nama</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="nama" id="nama"
                                            class="form-control form-control-sm"
                                            value="{{ request()->get('nama') != null ? request()->get('nama') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="pendidikan" class="col-lg-4">Pendidikan</label>
                                    <div class="col-lg-8">
                                        <select name="pendidikan"
                                            class="form-control form-control-sm @if ($errors->has('pendidikan')) is-invalid @endif "
                                            id="pendidikan">
                                            <option value=""> -- Pilih Pendidikan -- </option>
                                            @foreach ($jenisPendidikan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->get('pendidikan') ? (request()->get('pendidikan') == $item->id ? 'selected' : '') : '' }}>
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="umur" class="col-lg-4">Umur</label>
                                    <div class="col-lg-3">
                                        <input type="number" name="umur" id="umur"
                                            class="form-control form-control-sm"
                                            value="{{ request()->get('umur') != null ? request()->get('umur') : '' }}">
                                    </div>
                                    <label for="umur2" class="col-lg-2">s/d</label>
                                    <div class="col-lg-3">
                                        <input type="number" name="umur2" id="umur2"
                                            class="form-control form-control-sm"
                                            value="{{ request()->get('umur2') != null ? request()->get('umur2') : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="pekerjaan" class="col-lg-4">Pekerjaan</label>
                                    <div class="col-lg-8">
                                        <select name="pekerjaan"
                                            class="form-control form-control-sm @if ($errors->has('pekerjaan')) is-invalid @endif "
                                            id="pekerjaan">
                                            <option value=""> -- Pilih Pekerjaan -- </option>
                                            @foreach ($jenisPekerjaan as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->get('pekerjaan') ? (request()->get('pekerjaan') == $item->id ? 'selected' : '') : '' }}>
                                                    {{ $item->kode . ' || ' . $item->deskripsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="goldar" class="col-lg-4">Golongan Darah</label>
                                    <div class="col-lg-8">
                                        <select name="goldar"
                                            class="form-control form-control-sm @if ($errors->has('goldar')) is-invalid @endif "
                                            id="goldar">
                                            <option value=""> -- Pilih Pekerjaan -- </option>
                                            @foreach ($jenisGolDar as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->get('goldar') ? (request()->get('goldar') == $item->id ? 'selected' : '') : '' }}>
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="gender" class="col-lg-4">Jenis Kelamin</label>
                                    <div class="col-lg-8">
                                        <select name="gender"
                                            class="form-control form-control-sm @if ($errors->has('gender')) is-invalid @endif "
                                            id="gender">
                                            <option value=""> -- Pilih Jenis Kelamin -- </option>
                                            @foreach ($jenisKelamin as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->get('gender') ? (request()->get('gender') == $item->id ? 'selected' : '') : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="agama" class="col-lg-4">Agama</label>
                                    <div class="col-lg-8">
                                        <select name="agama"
                                            class="form-control form-control-sm @if ($errors->has('agama')) is-invalid @endif "
                                            id="agama">
                                            <option value=""> -- Pilih Agama -- </option>
                                            @foreach ($jenisAgama as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->get('agama') ? (request()->get('agama') == $item->id ? 'selected' : '') : '' }}>
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="rw" class="col-lg-4">RW</label>
                                    <div class="col-lg-8">
                                        <select name="rw"
                                            class="form-control form-control-sm @if ($errors->has('rw')) is-invalid @endif "
                                            id="rw">
                                            <option value=""> -- Pilih RW -- </option>
                                            @foreach (App\Models\DataRw::with('rts')->get() as $row)
                                                <option value="{{ $row->name }}" data-rt="{{ $row->rts }}">
                                                    00{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="rt" class="col-lg-4">RT</label>
                                    <div class="col-lg-8">
                                        <select name="rt"
                                            class="form-control form-control-sm @if ($errors->has('rt')) is-invalid @endif "
                                            id="rt" disabled="">
                                            <option value=""> -- Pilih RT -- </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="feather-16" data-feather="filter"></i> Filter
                                </button>
                                <a href="{{ url('penduduk') }}" class="btn btn-danger btn-sm">
                                    <i class="feather-16" data-feather="refresh-cw"></i> Reset
                                </a>
                            </div>

                        </div>
                    </form>
                    {{-- @endif --}}
                    <div class="row justify-content-end mb-2">
                        <div class="col-lg-4">
                            <button class="btn btn-danger btn-sm" onclick="registerPendataanExport('btnPdf')">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                            <button onclick="registerPendataanExport('btnExcel')" class="btn btn-success btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-excel" viewBox="0 0 16 16">
                                    <path
                                        d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704" />
                                    <path
                                        d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                                </svg> EXCEL
                            </button>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <span class="text-muted text-uppercase fs-12 fw-bold">Total Laki-Laki</span>
                                            <h3 class="mb-0">{{ number_format($laki) }}</h3>
                                        </div>
                                        <div class="align-self-center flex-shrink-0">
                                            <i data-feather="user" class="icon-lg icon-dual-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <span class="text-muted text-uppercase fs-12 fw-bold">Total Perempuan</span>
                                            <h3 class="mb-0">{{ number_format($perempuan) }}</h3>
                                        </div>
                                        <div class="align-self-center flex-shrink-0">
                                            <i data-feather="user" class="icon-lg icon-dual-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <span class="text-muted text-uppercase fs-12 fw-bold">Total Penduduk</span>
                                            <h3 class="mb-0">{{ number_format($total) }}</h3>
                                        </div>
                                        <div class="align-self-center flex-shrink-0">
                                            <i data-feather="user" class="icon-lg icon-dual-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-sm mt-2" id="penduduk-table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="2">NO</th>
                                <th rowspan="2">NIK</th>
                                <th rowspan="2">NO KK</th>
                                <th rowspan="2">NAMA</th>
                                <th rowspan="2">JENIS KELAMIN</th>
                                <th rowspan="2">TEMPAT LAHIR</th>
                                <th rowspan="2">TGL LAHIR</th>
                                <th rowspan="2">SHDK</th>
                                <th colspan="2">ALAMAT</th>
                                <th rowspan="2">PENDIDIKAN</th>
                                <th rowspan="2">PEKERJAAN</th>
                                <th rowspan="2">UMUR</th>
                                <th rowspan="2">NAMA AYAH</th>
                                <th rowspan="2">NAMA IBU</th>
                                <th rowspan="2">AKSI</th>
                            </tr>
                            <tr>
                                <th>RT</th>
                                <th>RW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td style="white-space: nowrap; text-align:center;">{{ $loop->iteration }}</td>
                                    <td style="white-space: nowrap;">
                                        <span>
                                            {{ $row->nik }}
                                        </span>
                                        <i class="fa fa-fw fa-copy" style="cursor: pointer;"
                                            onclick="copyToClipboard($(this).parent().find('span'))"></i>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>
                                            {{ $row->no_kk }}
                                        </span>
                                        <i class="fa fa-fw fa-copy" style="cursor: pointer;"
                                            onclick="copyToClipboard($(this).parent().find('span'))"></i>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ strtoupper($row->nama) }}
                                        </span>

                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ strtoupper($row->gender->name) }}</span>
                                    </td>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ strtoupper($row->tempat_lahir) }}</span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>
                                            {{ date('d-m-Y', strtotime($row->tanggal_lahir)) }}
                                        </span>
                                        <i class="fa fa-fw fa-copy" style="cursor: pointer;"
                                            onclick="copyToClipboard($(this).parent().find('span'))"></i>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ strtoupper($row->statusRelation->nama) }}</span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>00{{ $row->rt->name }}</span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>00{{ $row->rw->name }}</span>

                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ strtoupper($row->pendidikan->nama) }}</span>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        {{ strtoupper($row->pekerjaan->deskripsi) }}
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ Carbon\Carbon::parse($row->tanggal_lahir)->age }}</span>

                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ $row->nama_ayah }}</span>
                                        <i class="fa fa-fw fa-copy" style="cursor: pointer;"
                                            onclick="copyToClipboard($(this).parent().find('span'))"></i>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <span>{{ $row->nama_ibu }}</span>
                                        <i class="fa fa-fw fa-copy" style="cursor: pointer;"
                                            onclick="copyToClipboard($(this).parent().find('span'))"></i>
                                    </td>

                                    <td style="white-space: nowrap;">
                                        {{-- <a href="{{ route('penduduk.surat-tidak-mampu', $row->uuid) }}"
                                            class="btn btn-info btn-sm sign-button" title="CetaK Surat Kematian"><i
                                                class="fa fa-print"></i></a> --}}
                                        <a href="{{ route('penduduk.edit', $row->uuid) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm delete-data"><i
                                                class="fa fa-trash"></i></a>
                                        <form action="{{ route('penduduk.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-sign" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="#" method="GET" target="_blank">

                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Penanda Tangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            @php
                                $nomor = ['145', '...', 'X', date('Y')];
                                $nomor = implode('/', $nomor);
                            @endphp
                            <input type="text" name="nomor" value="{{ $nomor }}" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Aparatur Desa</label>
                            <select name="pejabat_id" class="custom-select" required>
                                <option value="">-- Pilih Pejabat --</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('penduduk.modal.monografi')
@endsection
@include('plugins.select2')
@include('plugins.datatables')
@push('styles')
    <style>
        .select2-container {
            width: 250px !important;
        }

        table>thead>tr>th {
            vertical-align: middle !important;
            text-align: center;
            font-size: 10px;
        }

        table>tbody>tr>td {
            font-size: 10px;
        }

        .feather-16 {
            width: 16px;
            height: 16px;
        }

        .feather-24 {
            width: 24px;
            height: 24px;
        }

        .feather-32 {
            width: 32px;
            height: 32px;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#penduduk-table').DataTable({
                scrollX: true
            });

            $(document).on('click', '.delete-data', function(e) {
                e.preventDefault();
                let accept = confirm('Anda yakin hapus data ini?');
                if (accept) {
                    $(this).parent().find('form').submit();
                }
            });

            $(document).on('click', '.sign-button', function(e) {
                e.preventDefault()

                $('#modal-sign').find('form').attr('action', $(this).attr('href'));
                $('#modal-sign').modal('show')

            })
        });

        $(document).ready(function() {

            /* JENIS DINDING */
            $('#pendidikan').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Pendidikan --'
            })
            $('#pekerjaan').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Pekerjaan --'
            })

            $('#agama').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Agama --'
            })

            $('#gender').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Kelamin --'
            })
            $('#goldar').select2({
                allowClear: true,
                placeholder: '-- Pilih Golongan Darah --'
            })

            /* RW */
            $('#rw, #filter-rw').select2({
                allowClear: true,
                placeholder: '-- Pilih RW --'
            })

            $('#rt, #filter-rt').select2({
                allowClear: true,
                placeholder: '-- Pilih RT --'
            })

            $(document).on('change', '#rt, #filter-rt', function(e) {
                e.preventDefault();
            })

            $(document).on('change', '#rw, #filter-rw', function(e) {
                e.preventDefault();
                $('#rt,#filter-rt').empty();
                $('#rt,#filter-rt').append(`<option value=""></option>`)
                let rts = $(this).find(':selected').data('rt')

                $.each(rts, function(index, val) {
                    $('#rt, #filter-rt').append(
                        `<option value="${val.id}" data-ketua-rt="${val.ketua_rt}">00${val.name}</option>`
                    )
                })

                $('#rt, #filter-rt').prop('disabled', false)

                $('#rt, #filter-rt').select2({
                    allowClear: true,
                    placeholder: '-- Pilih RT --',
                })

            })


        })

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text().trim()).select();
            document.execCommand("copy");
            $temp.remove();
            alert('copied')
        }

        function dialogMonografi() {
            $("#monografi-modal").modal('show')
        }

        function registerPendataanExport(btnType) {
            window.open('/penduduk/penduduk-export?' +
                'nik=' + $("input[name='nik']").val() +
                '&no_kk=' + $("input[name='no_kk']").val() +
                '&nama=' + $("input[name='nama']").val() +
                '&pendidikan=' + $("#pendidikan").val() +
                '&umur=' + $("input[name='umur']").val() +
                '&umur2=' + $("input[name='umur2']").val() +
                '&pekerjaan=' + $("#pekerjaan").val() +
                '&goldar=' + $("#goldar").val() +
                '&gender=' + $("#gender").val() +
                '&agama=' + $("#agama").val() +
                '&rw=' + $("#rw").val() +
                '&rt=' + $("#rt").val() +
                '&btnType=' + btnType
            );
        }
    </script>
@endpush
