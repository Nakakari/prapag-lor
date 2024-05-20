@extends('layouts.app')
@section('title', 'Data Penduduk')
<?php
use App\Helpers\AplikasiHelper;
?>
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow card border-bottom-primary">
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
                    @if ($data)
                        {!! Form::open()->route('penduduk.update', [$data->uuid])->put()->fill($data)->id('form')->multipart() !!}
                    @else
                        {!! Form::open()->route('penduduk.store')->id('form')->multipart() !!}
                    @endif
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control"
                                onkeypress="return numbersonly(this, event);" maxlength="16" placeholder="NIK"
                                value="{{ old('nik') ?? ($data ? $data->nik : '') }}" required />
                        </div>
                        <div class="col-lg-3">
                            <label for="no_kk">No. KK</label>
                            <input type="text" name="no_kk" id="no_kk" class="form-control"
                                onkeypress="return numbersonly(this, event);" maxlength="16" placeholder="No. KK"
                                value="{{ old('no_kk') ?? ($data ? $data->no_kk : '') }}" required />
                        </div>
                        <div class="col-lg-6">
                            {!! Form::text('nama', 'Nama Lengkap', $data ? $data->nama : '')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('tanggal_lahir', 'Tanggal Lahir', $data ? $data->tanggal_lahir : '')->type('date')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('tempat_lahir', 'Tempat Lahir', $data ? $data->tempat_lahir : '')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="id_jenis_kelamin" class="form-control" id="gender" required>
                                    <option value=""></option>
                                    @foreach ($jenisKelamin as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_jenis_kelamin == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Agama</label>
                                <select name="id_jenis_agama" class="form-control" id="id_jenis_agama" required>
                                    <option value=""></option>
                                    @foreach ($jenisAgama as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_jenis_agama == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        @if (auth()->user()->role != 'ketua_rt')
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="id_rw">RW</label>
                                    <select name="id_rw"
                                        class="form-control @if ($errors->has('id_rw')) is-invalid @endif "
                                        required="" id="id_rw">
                                        <option value=""></option>
                                        @foreach ($dataRwRt as $row)
                                            <option value="{{ $row->name }}" data-rt="{{ $row->rts }}"
                                                {{ $data ? ($data->id_rw == $row->name ? 'selected' : '') : '' }}>
                                                00{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="id_rt">RT</label>
                                    <select name="id_rt"
                                        class="form-control @if ($errors->has('id_rt')) is-invalid @endif "
                                        required="" id="id_rt" disabled="">
                                        >
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-3">
                                {!! Form::text('id_rt', 'RT', auth()->user()->ketua_rt->rt)->readonly() !!}
                            </div>
                            <div class="col-lg-3">
                                {!! Form::text('id_rw', 'RW', auth()->user()->ketua_rt->rw)->readonly() !!}
                            </div>
                        @endif

                        <div class="col-lg-12">
                            {!! Form::textarea('alamat', 'Alamat', $data ? $data->alamat : AplikasiHelper::desa)->required() !!}
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>SHDK</label>
                                <select name="id_jenis_status_relation" class="form-control" id="id_jenis_status_relation"
                                    required>
                                    <option value=""></option>
                                    @foreach ($statusRelation as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_jenis_status_relation == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Status Kawin</label>
                                <select name="id_jenis_status_marital" class="form-control" id="id_jenis_status_marital"
                                    required>
                                    <option value=""></option>
                                    @foreach ($statusKawin as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_jenis_status_marital == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select name="id_jenis_pendidikan" class="form-control" id="id_jenis_pendidikan" required>
                                    <option value=""></option>
                                    @foreach ($jenisPendidikan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_jenis_pendidikan == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select name="id_master_pekerjaan" class="form-control" id="id_master_pekerjaan" required>
                                    <option value=""></option>
                                    @foreach ($jenisPekerjaan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_master_pekerjaan == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Golongan Darah (Opsional)</label>
                                <select name="id_jenis_golongan_darah" class="form-control" id="id_jenis_golongan_darah">
                                    <option value=""></option>
                                    @foreach ($jenisGolDar as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data ? ($data->id_jenis_golongan_darah == $item->id ? 'selected' : '') : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('sertifikat_kelahiran', 'Akta Kelahiran (Opsional)', $data ? $data->sertifikat_kelahiran : '') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('sertifikat_pernikahan', 'Akta Nikah (Opsional)', $data ? $data->sertifikat_pernikahan : '') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('sertifikat_perceraian', 'Akta Cerai (Opsional)', $data ? $data->sertifikat_perceraian : '') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('nama_ayah', 'Nama Ayah (Opsional)', $data ? $data->nama_ayah : '') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('nama_ibu', 'Nama Ibu (Opsional)', $data ? $data->nama_ibu : '') !!}
                        </div>


                        <div class="col-lg-12">
                            <div class="fom-group">
                                <button type="submit" class="btn btn-sm btn-primary"> Simpan </button>
                                <a href="{{ route('penduduk.index') }}" class="btn btn-sm btn-light">Kembali</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@include('plugins.jquery-validate')
@include('plugins.select2')
@push('styles')
    <style>
        .select2-container .select2-selection--single .select2-selection__clear {
            position: relative;
            right: 15px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form').validate()

            $('#gender').select2({
                allowClear: true,
                placeholder: 'Pilih Jenis Kelamin'
            })
            $('#rt').select2({
                allowClear: true,
                placeholder: 'Pilih RT'
            })
            $('#id_rw').select2({
                allowClear: true,
                placeholder: 'Pilih RW'
            })
            $('#id_jenis_status_relation').select2({
                allowClear: true,
                placeholder: 'Pilih SHDK'
            })
            $('#id_jenis_status_marital').select2({
                allowClear: true,
                placeholder: 'Pilih Status'
            })
            $('#id_jenis_pendidikan').select2({
                allowClear: true,
                placeholder: 'Pilih Pendidikan'
            })
            $('#id_jenis_agama').select2({
                allowClear: true,
                placeholder: 'Pilih Agama'
            })
            $('#id_master_pekerjaan').select2({
                allowClear: true,
                placeholder: 'Pilih Pekerjaan'
            })
            $('#id_jenis_golongan_darah').select2({
                allowClear: true,
                placeholder: 'Pilih Golongan Darah'
            })

            // $(document).on('change', '#id_rt', function(e) {
            //     e.preventDefault();
            // })

            // $(document).on('change', '#id_rw', function(e) {
            //     e.preventDefault();
            //     $('#id_rt').empty();
            //     $('#id_rt').append(`<option value=""></option>`)
            //     let rts = $(this).find(':selected').data('rt')

            //     $.each(rts, function(index, val) {
            //         $('#id_rt').append(
            //             `<option value="${val.id}" data-ketua-rt="${val.ketua_rt}">00${val.name}</option>`
            //         )
            //     })

            //     $('#id_rt').prop('disabled', false)

            //     $('#id_rt').select2({
            //         allowClear: true,
            //         placeholder: '-- Pilih RT --',
            //     })

            // })
        })

        function setRt() {
            $('#id_rt').empty();
            $('#id_rt').append(`<option value=""></option>`)
            let rts = $('#id_rw').find(':selected').data('rt')

            let default_rt = '';
            @if ($data)
                default_rt = {{ $data->id_rt }}
            @endif

            $.each(rts, function(index, val) {
                $('#id_rt').append(
                    `<option value="${val.name}" ${default_rt == val.name ? 'selected':''}>00${val.name}</option>`
                )
            })

            $('#id_rt').prop('disabled', false)

            $('#id_rt').select2({
                allowClear: true,
                placeholder: '-- Pilih RT --',
            })
        }

        $(document).on('change', '#id_rw', function(e) {
            e.preventDefault();
            setRt()
        })

        setRt()
    </script>
@endpush
