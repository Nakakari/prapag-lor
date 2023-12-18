@extends('layouts.app')
@section('title', 'Data Kematian')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card border-bottom-primary">
                <div class="card-header">
                    <div class="float-left">
                        @if ($data)
                            <h6 class="m-0 font-weight-bold text-primary">Ubah @yield('title')</h6>
                        @else
                            <h6 class="m-0 font-weight-bold text-primary">Tambah @yield('title')</h6>
                        @endif
                    </div>
                </div>

                <div class="card-body table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('fail') }}
                        </div>
                    @endif
                    @if ($data)
                        {!! Form::open()->route('data-kematian.update', [$data->id])->put()->fill($data)->id('form')->multipart() !!}
                    @else
                        <form action="{{ route('data-kematian.store') }}" method="post">
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nik')) is-invalid @endif " name="nik"
                                    value="{{ old('nik', $data ? $data->nik : '') }}"
                                    onkeypress="return numbersonly(this, event);" maxlength="16" />
                                @if ($errors->has('nik'))
                                    <div class="invalid-feedback">{{ $errors->first('nik') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama')) is-invalid @endif " name="nama"
                                    value="{{ old('nama', $data ? $data->nama : '') }}" />
                                @if ($errors->has('nama'))
                                    <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date"
                                    class="form-control @if ($errors->has('tanggal_lahir')) is-invalid @endif "
                                    name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $data ? $data->tanggal_lahir : '') }}" />
                                @if ($errors->has('tanggal_lahir'))
                                    <div class="invalid-feedback">{{ $errors->first('tanggal_lahir') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" required="" id="jenis_kelamin_id" name="jenis_kelamin_id">
                                    <option value=""> -- Pilih Jenis Kelamin -- </option>
                                    @foreach ($jenisKelamin as $row)
                                        <option value="{{ $row->id }}"
                                            {{ $data ? ($data->jenis_kelamin_id == $row->id ? 'selected' : '') : '' }}>
                                            {{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('alamat')) is-invalid @endif "
                                    name="alamat" value="{{ old('alamat', $data ? $data->alamat : '') }}" />
                                @if ($errors->has('alamat'))
                                    <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="rw">RW</label>
                                <select name="rw_id" class="form-control" required="" id="rw">
                                    <option value=""> -- Pilih RW -- </option>
                                    @foreach ($rw as $row)
                                        <option value="{{ $row->id }}" data-rt="{{ $row->rts }}"
                                            {{ $data ? ($data->rw_id == $row->id ? 'selected' : '') : '' }}>
                                            00{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="rt">RT</label>
                                <select name="rt_id" class="form-control" disabled="" id="rt">
                                    <option value=""> -- Pilih RT -- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tahun">Tahun Meninggal</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('tahun')) is-invalid @endif "
                                    name="tahun" value="{{ old('tahun', $data ? $data->tahun : date('Y')) }}"
                                    maxlength="4" />
                                @if ($errors->has('tahun'))
                                    <div class="invalid-feedback">{{ $errors->first('tahun') }}</div>
                                @endif
                            </div>
                        </div>



                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="tanggal_pemakaman">Tanggal Pemakaman</label>
                                <input type="date"
                                    class="form-control @if ($errors->has('tanggal_pemakaman')) is-invalid @endif "
                                    name="tanggal_pemakaman"
                                    value="{{ old('tanggal_pemakaman', $data ? $data->tanggal_pemakaman : '') }}" />
                                @if ($errors->has('tanggal_pemakaman'))
                                    <div class="invalid-feedback">{{ $errors->first('tanggal_pemakaman') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tempat_tanggal_meninggal">Tempat Tanggal Meninggal</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('tempat_tanggal_meninggal')) is-invalid @endif "
                                    name="tempat_tanggal_meninggal"
                                    value="{{ old('tempat_tanggal_meninggal', $data ? $data->tempat_tanggal_meninggal : '') }}" />
                                @if ($errors->has('tempat_tanggal_meninggal'))
                                    <div class="invalid-feedback">{{ $errors->first('tempat_tanggal_meninggal') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama_ayah')) is-invalid @endif "
                                    name="nama_ayah" value="{{ old('nama_ayah', $data ? $data->nama_ayah : '') }}" />
                                @if ($errors->has('nama_ayah'))
                                    <div class="invalid-feedback">{{ $errors->first('nama_ayah') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama_ibu')) is-invalid @endif "
                                    name="nama_ibu" value="{{ old('nama_ibu', $data ? $data->nama_ibu : '') }}" />
                                @if ($errors->has('nama_ibu'))
                                    <div class="invalid-feedback">{{ $errors->first('nama_ibu') }}</div>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_keluarga">Nama Keluarga Yang Bisa Dihubungi</label>
                            <input
                                type="text"
                                class="form-control @if ($errors->has('nama_keluarga')) is-invalid @endif "
                                name="nama_keluarga"
                                value="{{old('nama_keluarga', $data ? $data->nama_keluarga:'')}}"
                            />
                            @if ($errors->has('nama_keluarga'))
                            <div class="invalid-feedback">{{$errors->first('nama_keluarga')}}</div>
                            @endif
                        </div>
                    </div> --}}

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="penyebab_kematian">Penyebab Kematian</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('penyebab_kematian')) is-invalid @endif "
                                    name="penyebab_kematian"
                                    value="{{ old('penyebab_kematian', $data ? $data->penyebab_kematian : '') }}" />
                                @if ($errors->has('penyebab_kematian'))
                                    <div class="invalid-feedback">{{ $errors->first('penyebab_kematian') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nama_pelapor">Nama Pelapor 1</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama_pelapor')) is-invalid @endif "
                                    name="nama_pelapor"
                                    value="{{ old('nama_pelapor', $data ? $data->nama_pelapor : '') }}" />
                                @if ($errors->has('nama_pelapor'))
                                    <div class="invalid-feedback">{{ $errors->first('nama_pelapor') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nik_pelapor">NIK Pelapor 1</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nik_pelapor')) is-invalid @endif "
                                    name="nik_pelapor" value="{{ old('nik_pelapor', $data ? $data->nik_pelapor : '') }}"
                                    onkeypress="return numbersonly(this, event);" maxlength="16" />
                                @if ($errors->has('nik_pelapor'))
                                    <div class="invalid-feedback">{{ $errors->first('nik_pelapor') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nama_pelapor_2">Nama Pelapor 2</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nama_pelapor_2')) is-invalid @endif "
                                    name="nama_pelapor_2"
                                    value="{{ old('nama_pelapor_2', $data ? $data->nama_pelapor_2 : '') }}" />
                                @if ($errors->has('nama_pelapor_2'))
                                    <div class="invalid-feedback">{{ $errors->first('nama_pelapor_2') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="nik_pelapor_2">NIK Pelapor 2</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('nik_pelapor_2')) is-invalid @endif "
                                    name="nik_pelapor_2"
                                    value="{{ old('nik_pelapor_2', $data ? $data->nik_pelapor_2 : '') }}"
                                    onkeypress="return numbersonly(this, event);" maxlength="16" />
                                @if ($errors->has('nik_pelapor_2'))
                                    <div class="invalid-feedback">{{ $errors->first('nik_pelapor_2') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('keterangan')) is-invalid @endif "
                                    name="keterangan" value="{{ old('keterangan', $data ? $data->keterangan : '') }}" />
                                @if ($errors->has('keterangan'))
                                    <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="fom-group">
                                <button type="submit" class="btn btn-sm btn-primary"> Simpan </button>
                                <a href="{{ route('data-kematian.index') }}" class="btn btn-sm btn-light">Kembali</a>
                            </div>
                        </div>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
@include('plugins.select2')
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
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.cari').select2();
        });

        /* RW */
        $('#rw').select2({
            allowClear: true,
            placeholder: '-- Pilih RW --'
        })
        $('#jenis_kelamin_id').select2({
            allowClear: true,
            placeholder: '-- Pilih Jenis Kelamin --'
        })


        $(document).on('change', '#rt', function(e) {
            e.preventDefault();
        })

        $(document).on('change', '#rw', function(e) {
            e.preventDefault();
            $('#rt').empty();
            $('#rt').append(`<option value=""></option>`)
            let rts = $(this).find(':selected').data('rt')

            $.each(rts, function(index, val) {
                $('#rt').append(
                    `<option value="${val.name}" data-ketua-rt="${val.ketua_rt}">00${val.name}</option>`
                )
            })

            $('#rt').prop('disabled', false)

            $('#rt').select2({
                allowClear: true,
                placeholder: '-- Pilih RT --',
            })

        })

        @if ($data)
            let rts = $('#rw').find('option:selected').data('rt')
            $.each(rts, function(index, val) {
                $('#rt').append(
                    `<option value="${val.name}" data-ketua-rt="${val.ketua_rt}" ${'{{ $data->rt_id }}' == val.name ? 'selected':''}>00${val.name}</option>`
                )
            })
            $('#rt').prop('disabled', false)

            $('#rt').select2({
                allowClear: true,
                placeholder: '-- Pilih RT --',
            })
        @endif
    </script>
@endpush
