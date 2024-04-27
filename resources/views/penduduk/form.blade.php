@extends('layouts.app')
@section('title', 'Data Penduduk')
<?php
use App\Helpers\AplikasiHelper;
?>
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow">
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
                        {!! Form::open()->route('penduduk.update', [$data->id])->put()->fill($data)->id('form')->multipart() !!}
                    @else
                        {!! Form::open()->route('penduduk.store')->id('form')->multipart() !!}
                    @endif
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Form::text('nik', 'NIK', $data ? $data->nik : '')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('no_kk', 'NO KK', $data ? $data->no_kk : '')->required() !!}
                        </div>
                        <div class="col-lg-6">
                            {!! Form::text('nama', 'Nama Lengkap', $data ? $data->nama : '')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('tanggal_lahir', 'Tanggal Lahir')->type('date')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('tempat_lahir', 'Tempat Lahir')->required() !!}
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
                                <select name="id_jenis_agama" class="form-control" id="religion" required>
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
                                    <label for="rw">RW</label>
                                    <select name="rw"
                                        class="form-control @if ($errors->has('rw')) is-invalid @endif "
                                        required="" id="rw">
                                        <option value=""></option>
                                        @foreach (App\Models\DataRw::with('rts')->get() as $row)
                                            <option value="{{ $row->name }}" data-rt="{{ $row->rts }}">
                                                00{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="rt">RT</label>
                                    <select name="rt"
                                        class="form-control @if ($errors->has('rt')) is-invalid @endif "
                                        required="" id="rt" disabled="">
                                        >
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-3">
                                {!! Form::text('rt', 'RT', auth()->user()->ketua_rt->rt)->readonly() !!}
                            </div>
                            <div class="col-lg-3">
                                {!! Form::text('rw', 'RW', auth()->user()->ketua_rt->rw)->readonly() !!}
                            </div>
                        @endif

                        <div class="col-lg-12">
                            {!! Form::textarea('address', 'Alamat', $data ? $data->alamat : AplikasiHelper::desa) !!}
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>SHDK</label>
                                <select name="status_relation" class="form-control" id="status_relation" required>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Status Kawin</label>
                                <select name="status_marital" class="form-control" id="status_marital" required>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pendidikan</label>
                                <select name="degree" class="form-control" id="degree" required>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Pekerjaan</label>
                                <select name="occupation" class="form-control" id="occupation" required>
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('blood_type', 'Gol Darah') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('birth_certificate', 'Akta Kelahiran') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('marriage_certificate', 'Akta Nikah') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('divorce_certificate', 'Akta Cerai') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('father_name', 'Nama Ayah') !!}
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('mother_name', 'Nama Ibu') !!}
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
            $('#rw').select2({
                allowClear: true,
                placeholder: 'Pilih RW'
            })
            $('#status_relation').select2({
                allowClear: true,
                placeholder: 'Pilih SHDK'
            })
            $('#status_marital').select2({
                allowClear: true,
                placeholder: 'Pilih Status'
            })
            $('#degree').select2({
                allowClear: true,
                placeholder: 'Pilih Pendidikan'
            })
            $('#religion').select2({
                allowClear: true,
                placeholder: 'Pilih Agama'
            })
            $('#occupation').select2({
                allowClear: true,
                placeholder: 'Pilih Pekerjaan'
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
                        `<option value="${val.id}" data-ketua-rt="${val.ketua_rt}">00${val.name}</option>`
                    )
                })

                $('#rt').prop('disabled', false)

                $('#rt').select2({
                    allowClear: true,
                    placeholder: '-- Pilih RT --',
                })

            })
        })
    </script>
@endpush
