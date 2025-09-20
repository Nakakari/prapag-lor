@extends('layouts.app')
@push('styles')
    <style>
        .text-end-input {
            text-align: right !important;
        }

        .text-end-input::placeholder {
            text-align: right;
            opacity: 0.6;
        }

        .form-control.text-end-input {
            text-align: right !important;
        }
    </style>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        @if ($data)
                            <h6>Ubah Surat Kuasa</h6>
                        @else
                            <h6>Tambah Surat Kuasa</h6>
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
                        {!! Form::open()->route('surat-kuasa.update', [$data->id])->put()->fill($data)->id('form')->multipart() !!}
                    @else
                        {!! Form::open()->route('surat-kuasa.store')->id('form')->multipart() !!}
                    @endif
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="id_sumber_dana" class="">Sumber Dana</label>
                            @php
                                $selected = collect(
                                    old(
                                        'id_sumber_dana',
                                        $data && $data->suratKuasaDetail
                                            ? $data->suratKuasaDetail->pluck('id_sumber_dana')->toArray()
                                            : [],
                                    ),
                                )->map(fn($v) => (string) $v);
                            @endphp

                            <select id="id_sumber_dana" name="id_sumber_dana[]" class="form-control" multiple required
                                data-placeholder="Silakan Pilih">

                                @foreach ($sumberDanas as $sumberDana)
                                    <option value="{{ $sumberDana['id'] }}"
                                        {{ $selected->contains((string) $sumberDana['id']) ? 'selected' : '' }}>
                                        {{ $sumberDana['nama'] }}
                                    </option>
                                @endforeach
                            </select>


                            @error('id_sumber_dana')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            {!! Form::text('tanggal_surat', 'Tanggal Surat', $data ? $data->tanggal : date('Y-m-d'))->type('date')->required() !!}
                        </div>
                        <div class="col-lg-2">
                            <label for="">Nomer Surat</label>
                            <input type="text" class="form-control text-end-input" name="nomor" id="nomor"
                                value="{{ $data ? $data->nomor : '' }}" required>

                        </div>
                        <div class="col-lg-4">
                            {!! Form::text('nomor_surat', '&nbsp;', $data ? $data->nomor_surat : $nomorSuratKeluar)->required()->readonly() !!}
                        </div>
                    </div>
                    <hr>
                    <h6>Pemberi Kuasa</h6>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="nama_pemberi_kuasa" class="">Pilih Pegawai</label>
                            <select id="nama_pemberi_kuasa" class="form-control" name="nama_pemberi_kuasa">
                                <option value="">Silakan Pilih</option>
                                @foreach ($penanggungJawab as $pj)
                                    <option value="{{ $pj['nama'] }}" data-nik="{{ $pj['nik'] }}" required
                                        data-jabatan="{{ $pj['jabatan'] }}" data-alamat="{{ $pj['Alamat'] }}"
                                        data-nohp="{{ $pj['no_hp'] }}"
                                        {{ $data ? ($data->nama_pemberi_kuasa == $pj['nama'] ? 'selected' : '') : '' }}>
                                        {{ $pj['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-4">
                            <label for="nik_pemberi_kuasa">NIK</label>
                            <input type="text" class="form-control" id="nik_pemberi_kuasa" name="nik_pemberi_kuasa"
                                value="{{ old('nik_pemberi_kuasa') ?? ($data ? $data->nik_pemberi_kuasa : '') }}" />
                        </div>
                        <div class="col-lg-4">
                            <label for="jabatan_pemberi_kuasa">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan_pemberi_kuasa"
                                name="jabatan_pemberi_kuasa"
                                value="{{ old('jabatan_pemberi_kuasa') ?? ($data ? $data->jabatan_pemberi_kuasa : '') }}" />
                        </div>
                        <div class="col-lg-4">
                            <label for="no_hp_pemberi_kuasa">No. HP</label>
                            <input type="text" class="form-control" id="no_hp_pemberi_kuasa" name="no_hp_pemberi_kuasa"
                                value="{{ old('no_hp_pemberi_kuasa') ?? ($data ? $data->no_hp_pemberi_kuasa : '') }}" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat_pemberi_kuasa" id="alamat_pemberi_kuasa" required>{{ old('alamat_pemberi_kuasa') ?? ($data ? $data->alamat_pemberi_kuasa : '') }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <h6>Penerima Kuasa</h6>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="nama_penerima_kuasa" class="">Pilih Pegawai</label>
                            <select id="nama_penerima_kuasa" class="form-control" name="nama_penerima_kuasa">
                                <option value="">Silakan Pilih</option>
                                @foreach ($penanggungJawab as $pj)
                                    <option value="{{ $pj['nama'] }}" data-nik="{{ $pj['nik'] }}" required
                                        data-jabatan="{{ $pj['jabatan'] }}" data-alamat="{{ $pj['Alamat'] }}"
                                        data-nohp="{{ $pj['no_hp'] }}"
                                        {{ $data ? ($data->nama_penerima_kuasa == $pj['nama'] ? 'selected' : '') : '' }}>
                                        {{ $pj['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-4">
                            <label for="nik_penerima_kuasa">NIK</label>
                            <input type="text" class="form-control" id="nik_penerima_kuasa" name="nik_penerima_kuasa"
                                value="{{ old('nik_penerima_kuasa') ?? ($data ? $data->nik_penerima_kuasa : '') }}" />
                        </div>
                        <div class="col-lg-4">
                            <label for="jabatan_penerima_kuasa">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan_penerima_kuasa"
                                name="jabatan_penerima_kuasa"
                                value="{{ old('jabatan_penerima_kuasa') ?? ($data ? $data->jabatan_penerima_kuasa : '') }}" />
                        </div>
                        <div class="col-lg-4">
                            <label for="no_hp_penerima_kuasa">No. HP</label>
                            <input type="text" class="form-control" id="no_hp_penerima_kuasa"
                                name="no_hp_penerima_kuasa"
                                value="{{ old('no_hp_penerima_kuasa') ?? ($data ? $data->no_hp_penerima_kuasa : '') }}" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat_penerima_kuasa" id="alamat_penerima_kuasa" required>{{ old('alamat_penerima_kuasa') ?? ($data ? $data->alamat_penerima_kuasa : '') }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <h6>Jumlah Dana</h6>
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <label for="nominal">Nominal</label>
                            <input type="text" class="form-control text-end-input" id="nominal" name="nominal"
                                required
                                value="{{ old('nominal') ?? ($data ? number_format($data->nominal, 0, ',', '.') : '') }}" />
                        </div>
                        <div class="col-lg-3">
                            <label for="start_date" class="form-label">Dari Tanggal</label>
                            <input type="date" id="start_date" class="form-control" name="start_date"
                                value="{{ old('start_date') ?? ($data ? $data->start_date : '') }}" required />
                        </div>
                        <div class="col-lg-3">
                            <label for="end_date" class="form-label">Sampai Tanggal</label>
                            <input type="date" id="end_date" class="form-control" name="end_date"
                                value="{{ old('end_date') ?? ($data ? $data->end_date : '') }}" required />
                            <div id="error-msg" class="text-danger mt-1"></div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="fom-group">
                                <button type="submit" id="submitBtn" class="btn btn-sm btn-primary"> Simpan </button>
                                <a href="{{ route('surat-kuasa.index') }}" class="btn btn-sm btn-light">Kembali</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@include('plugins.select2')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_penandatangan').select2({
                placeholder: '-- Pilih Pejabat Penandatangan -- ',
                allowClear: true
            });
            $('#rt').select2({
                placeholder: '--- Pilih RT ---',
                allowClear: true
            });
            $('#rw').select2({
                placeholder: '--- Pilih RW ---',
                allowClear: true
            });
            $('#occupation').select2({
                placeholder: '--- Pilih Pekerjaan ---',
                allowClear: true
            });
            $("#address").keyup(function() {
                var val = $(this).val()
                $(this).val(val.toUpperCase());
            });
        });

        function numbersonly(myfield, e, dec) {
            var key;
            var keychar;

            if (window.event)
                key = window.event.keyCode;
            else if (e)
                key = e.which;
            else
                return true;
            keychar = String.fromCharCode(key);
            // control keys
            if ((key == null) || (key == 0) || (key == 8) ||
                (key == 9) || (key == 13) || (key == 27))
                return true;

            // numbers
            else if ((("0123456789").indexOf(keychar) > -1))
                return true;

            // decimal point jump
            else if (dec && (keychar == ".")) {
                myfield.form.elements[dec].focus();
                return false;
            } else
                return false;
        }

        function formatRibuan(angka) {
            // buang semua karakter non-digit
            angka = angka.replace(/\D/g, "");
            // format pakai regex, tambahkan titik setiap 3 digit dari belakang
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function date(date) {
            return new Date(date).toISOString().substring(0, 10)
        }

        function datetimeLocal(datetime) {
            const dt = new Date(datetime);
            dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
            return dt.toISOString().slice(0, 16);
        }
    </script>

    <script>
        $(function() {
            $('#id_sumber_dana').select2({
                placeholder: $('#id_sumber_dana').data('placeholder'),
                allowClear: true,
                width: '100%'
            });
        });

        $(function() {
            $('#submitBtn').click(function(e) {
                e.preventDefault(); // cegah submit dulu
                let start = $('#start_date').val();
                let end = $('#end_date').val();
                let error = '';

                // 🔹 cek field required lain
                $('input[required], select[required], textarea[required]').each(function() {
                    let value = $(this).val();

                    // kalau select multiple (array/null)
                    if ($(this).is('select[multiple]')) {
                        if (!value || value.length === 0) {
                            error = 'Field ' + ($(this).attr('name') || $(this).attr('id')) +
                                ' wajib diisi.';
                            return false; // stop loop
                        }
                    } else {
                        // input biasa (string)
                        if (!value || !String(value).trim()) {
                            error = 'Field ' + ($(this).attr('name') || $(this).attr('id')) +
                                ' wajib diisi.';
                            return false; // stop loop
                        }
                    }
                });


                // 🔹 cek aturan khusus tanggal
                if (!error) {
                    if (end && !start) {
                        error = 'Tanggal mulai harus diisi jika tanggal akhir ada.';
                    } else if (start && end && (new Date(end) <= new Date(start))) {
                        error = 'Tanggal akhir harus lebih dari tanggal mulai.';
                    }
                }

                if (error) {
                    $('#error-msg').text(error);
                } else {
                    $('#error-msg').text('');
                    alert('Validasi sukses! Bisa submit data.');
                    // lanjut submit form
                    $('#form').submit();
                }
            });

        });

        $(document).ready(function() {
            $('#nama_penerima_kuasa').on('change', function() {
                let nik = $(this).find(':selected').data('nik') || '';
                let jabatan = $(this).find(':selected').data('jabatan') || '';
                let nohp = $(this).find(':selected').data('nohp') || '';
                let alamat = $(this).find(':selected').data('alamat') || '';
                $('#nik_penerima_kuasa').val(nik);
                $('#jabatan_penerima_kuasa').val(jabatan);
                $('#no_hp_penerima_kuasa').val(nohp);
                $('#alamat_penerima_kuasa').val(alamat);
            });

            $('#nama_pemberi_kuasa').on('change', function() {
                let nik = $(this).find(':selected').data('nik') || '';
                let jabatan = $(this).find(':selected').data('jabatan') || '';
                let nohp = $(this).find(':selected').data('nohp') || '';
                let alamat = $(this).find(':selected').data('alamat') || '';
                $('#nik_pemberi_kuasa').val(nik);
                $('#jabatan_pemberi_kuasa').val(jabatan);
                $('#no_hp_pemberi_kuasa').val(nohp);
                $('#alamat_pemberi_kuasa').val(alamat);
            });
        });

        $(document).ready(function() {
            $('#nominal').on('keypress keyup change paste', function(e) {
                if (!numbersonly(this, e)) {
                    e.preventDefault();
                    // hilangkan karakter non angka kalau terlanjur masuk
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                }
            });
        });

        $(document).ready(function() {
            $('#nominal').on('input', function() {
                let value = $(this).val();
                $(this).val(formatRibuan(value));
            });
        });
    </script>
@endpush
