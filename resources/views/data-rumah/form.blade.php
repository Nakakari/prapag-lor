@extends('layouts.app')
@section('title', $data ? 'Ubah Data Rumah' : 'Tambah Data Rumah')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-bottom-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">

                    @if ($data)
                        {!! Form::open()->route('data-rumah-warga.update', [$data->id])->fill($data)->id('form')->put()->multipart() !!}
                    @else
                        {!! Form::open()->route('data-rumah-warga.store')->id('form')->multipart() !!}
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            {!! Form::text('nomor_rumah', 'Nomor Rumah', $nomor_rumah) !!}
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jenis_dinding">Jenis Dinding</label>
                                <select name="jenis_dinding" class="form-control" required="" id="jenis-dinding">
                                    <option value=""></option>
                                    @foreach (App\Models\DataRumah::JenisDinding() as $row)
                                        <option value="{{ $row }}"
                                            {{ $data ? ($data->jenis_dinding == $row ? 'selected' : '') : '' }}>
                                            {{ ucwords($row) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jenis_lantai">Jenis Lantai</label>
                                <select name="jenis_lantai" class="form-control" required="" id="jenis-lantai">
                                    <option value=""></option>
                                    @foreach (App\Models\DataRumah::Jenislantai() as $row)
                                        <option value="{{ $row }}"
                                            {{ $data ? ($data->jenis_lantai == $row ? 'selected' : '') : '' }}>
                                            {{ ucwords($row) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jenis_atap">Jenis Atap</label>
                                <select name="jenis_atap" class="form-control" required="" id="jenis-atap">
                                    <option value=""></option>
                                    @foreach (App\Models\DataRumah::JenisAtap() as $row)
                                        <option value="{{ $row }}"
                                            {{ $data ? ($data->jenis_atap == $row ? 'selected' : '') : '' }}>{{ ucwords($row) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Panjang</label>
                                        <input type="number" class="form-control" id="panjang">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Lebar</label>
                                        <input type="number" class="form-control" id="lebar">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="luas">Luas m2</label>
                                        <input type="number"
                                            class="form-control @if ($errors->has('luas')) is-invalid @endif "
                                            name="luas" value="{{ old('luas', $data ? $data->luas : '') }}"
                                            required="" />
                                        @if ($errors->has('luas'))
                                            <div class="invalid-feedback">{{ $errors->first('luas') }}</div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('kepala_keluarga', 'Kepala Keluarga')->required() !!}
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required="" id="jenis-kelamin">
                                    <option value=""></option>
                                    @foreach (App\Models\DataRumah::JenisKelamin() as $row)
                                        <option value="{{ $row }}"
                                            {{ $data ? ($data->jenis_kelamin == $row ? 'selected' : '') : '' }}>
                                            {{ ucwords($row) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if (auth()->user()->role != 'ketua_rt')
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="rw">RW</label>
                                    <select name="rw" class="form-control" required="" id="rw">
                                        <option value=""> -- Pilih RW -- </option>
                                        @foreach (App\Models\DataRw::with('rts')->get() as $row)
                                            <option value="{{ $row->name }}" data-rt="{{ $row->rts }}"
                                                {{ $data ? ($data->rw == $row->name ? 'selected' : '') : '' }}>
                                                00{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="rt">RT</label>
                                    <select name="rt" class="form-control" disabled="" id="rt">
                                        <option value=""> -- Pilih RT -- </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ketua_rt">Ketua RT</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('ketua_rt')) is-invalid @endif "
                                        name="ketua_rt" value="{{ old('ketua_rt', $data ? $data->ketua_rt : '') }}"
                                        required="" id="ketua_rt" />
                                    @if ($errors->has('ketua_rt'))
                                        <div class="invalid-feedback">{{ $errors->first('ketua_rt') }}</div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ auth()->user()->ketua_rt->rt }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ auth()->user()->ketua_rt->rw }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ketua RT</label>
                                    <input type="text" name="ketua_rt" class="form-control"
                                        value="{{ auth()->user()->ketua_rt->name }}" readonly>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-12 mb-2">
                            <label for="ketua_rt" class="d-block">Fasilitas Yang Sudah Ada</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="jamban" id=""
                                        value="1" {{ $data ? ($data->jamban ? 'checked' : '') : '' }}> Jamban
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="listrik" id=""
                                        value="1" {{ $data ? ($data->listrik ? 'checked' : '') : '' }}> Listrik
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Air Bersih</label>
                                <select name="air_bersih" class="custom-select" id="air-bersih">
                                    <option value=""></option>
                                    <option value="sumur_gali"
                                        {{ $data ? ($data->air_bersih == 'sumur_gali' ? 'selected' : '') : '' }}>Sumur Gali
                                    </option>
                                    <option value="sumur_bor"
                                        {{ $data ? ($data->air_bersih == 'sumur_bor' ? 'selected' : '') : '' }}>Sumur Bor
                                    </option>
                                    <option value="pam" {{ $data ? ($data->air_bersih == 'pam' ? 'selected' : '') : '' }}>
                                        PAM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="file">Foto Rumah</label>
                                <br>
                                <input type="file" {{-- class="form-control @if ($errors->has('file')) is-invalid @endif " --}} name="file" required />
                                @if ($errors->has('file'))
                                    <div class="invalid-feedback">{{ $errors->first('file') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="fom-group">
                                <button type="submit" class="btn btn-sm btn-primary"> Simpan </button>
                                <a href="{{ route('data-rumah-warga.index') }}" class="btn btn-sm btn-light">Kembali</a>
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
@include('plugins.jquery-validate')
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#form').validate()

            /* JENIS DINDING */
            $('#jenis-dinding').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Dinding --'
            })
            /* JENIS LANTAI */
            $('#jenis-lantai').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Lantai --'
            })
            /* JENIS ATAP */
            $('#jenis-atap').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Atap --'
            })
            /* JENIS KELAMIN */
            $('#jenis-kelamin').select2({
                allowClear: true,
                placeholder: '-- Pilih Jenis Kelamin --'
            })
            /* JENIS KELAMIN */
            $('#air-bersih').select2({
                allowClear: true,
                placeholder: '-- Pilih --'
            })

            /* RW */
            $('#rw').select2({
                allowClear: true,
                placeholder: '-- Pilih RW --'
            })

            $(document).on('change', '#rt', function(e) {
                e.preventDefault();
                setKetuaRt()
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
                        `<option value="${val.name}" data-ketua-rt="${val.ketua_rt}" ${'{{ $data->rt }}' == val.name ? 'selected':''}>00${val.name}</option>`
                        )
                })
                $('#rt').prop('disabled', false)

                $('#rt').select2({
                    allowClear: true,
                    placeholder: '-- Pilih RT --',
                })
            @endif


            function setKetuaRt() {
                let ketua_rt = $('#rt').find(':selected').data('ketua-rt');
                $('#ketua_rt').val(ketua_rt)
            }

            /* CALCULATE LUAR RUMAH */
            function getLuas() {
                let panjang = $('#panjang').val();
                let lebar = $('#lebar').val();

                if (lebar != undefined && panjang != undefined) {
                    let luas = panjang * lebar;

                    $('input[name="luas"]').val(luas)
                } else {
                    $('input[name="luas"]').val(0)

                }
            }

            $(document).on('keyup', '#lebar', function(e) {
                e.preventDefault();
                getLuas();
            })
            $(document).on('keyup', '#panjang', function(e) {
                e.preventDefault();
                getLuas();
            })


        })
    </script>
@endpush
