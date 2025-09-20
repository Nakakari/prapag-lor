@extends('layouts.app')
@section('content')
    <style>
        input[disabled],
        select[disabled],
        textarea[disabled] {
            background-color: #e9ecef !important;
            /* Bootstrap bg-light */
            color: #6c757d !important;
            /* Bootstrap text-muted */
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>

    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Formulir Biodata Keluarga</h4>
        </div>
        <div class="card-body">
            <form id="kkForm" action="#" method="POST">
                @csrf
                {{-- Data Kepala Keluarga --}}
                <div class="card mb-3" id="group-alamat-dn">
                    <div class="card-header bg-primary text-white">Data Kepala Keluarga & Data Wilayah</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <label>No. KK</label>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="no_kk" name="no_kk"
                                                    maxlength="16" onkeypress="return numbersonly(this, event);"
                                                    value="{{ $data ? $data->penduduk->no_kk : '' }}" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-warning" onclick="cariNoKk()"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="tipe_kk" class="form-label">Tipe Kartu Keluarga</label>
                                <select name="tipe_kk" id="tipe_kk" class="form-control select2" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="WNI">WNI Dalam Negeri</option>
                                    <option value="WNA">Orang Asing</option>
                                    <option value="WNILN">WNI Luar Negeri</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nama_kepala_keluarga" class="form-label">Nama Kepala Keluarga</label>
                                <input type="text" name="nama_kepala_keluarga" id="nama_kepala_keluarga"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jumlah_anggota" class="form-label">Jumlah Anggota Keluarga</label>
                                <input type="number" name="jumlah_anggota" id="jumlah_anggota" class="form-control"
                                    min="1" required>
                            </div>
                            <div class="col-md-12">
                                <label for="alamat_dn" class="form-label">Alamat</label>
                                <textarea name="alamat_dn" id="alamat_dn" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" name="rt" id="rt" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" name="rw" id="rw" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="provinsi_dn" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi_dn" id="provinsi_dn" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="kabupaten_dn" class="form-label">Kabupaten/Kota</label>
                                <input type="text" name="kabupaten_dn" id="kabupaten_dn" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="kecamatan_dn" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan_dn" id="kecamatan_dn" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label for="kelurahan_dn" class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan_dn" id="kelurahan_dn" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="dusun" class="form-label">Nama Dusun/Dukuh</label>
                                <input type="text" name="dusun" id="dusun" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Alamat di Luar Negeri --}}
                <div class="card mb-3 d-none" id="group-alamat-ln">
                    <div class="card-header bg-primary text-white"> Alamat di Luar Negeri</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="alamat_ln" class="form-label">Alamat/ Addres</label>
                                        <textarea name="alamat_ln" id="alamat_ln" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kota_ln" class="form-label">Kota</label>
                                        <input type="text" name="kota_ln" id="kota_ln" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provinsi_ln" class="form-label">Provinsi/Negara Bagian</label>
                                        <input type="text" name="provinsi_ln" id="provinsi_ln" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="negara_ln" class="form-label">Negara</label>
                                        <input type="text" name="negara_ln" id="negara_ln" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kode_pos_ln" class="form-label">Kode Pos</label>
                                        <input type="text" name="kode_pos_ln" id="kode_pos_ln" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="jumlah_anggota_ln" class="form-label">Jumlah Anggota Keluarga</label>
                                        <input type="number" name="jumlah_anggota_ln" id="jumlah_anggota_ln"
                                            class="form-control" min="1">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telepon_ln" class="form-label">Telepone / Handphone</label>
                                        <input type="text" name="telepon_ln" id="telepon_ln" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email_ln" class="form-label">Email</label>
                                        <input type="email" name="email_ln" id="email_ln" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kode_negara_ln" class="form-label">Kode Negara</label>
                                        <input type="text" name="kode_negara_ln" id="kode_negara_ln"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_negara_ln" class="form-label">Nama Negara</label>
                                        <input type="text" name="nama_negara_ln" id="nama_negara_ln"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kode_perwakilan_ln" class="form-label">Kode Perwakilan RI</label>
                                        <input type="text" name="kode_perwakilan_ln" id="kode_perwakilan_ln"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_perwakilan_ln" class="form-label">Nama Perwakilan RI</label>
                                        <input type="text" name="nama_perwakilan_ln" id="nama_perwakilan_ln"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Daftar Anggota --}}
                <div class="mb-3">
                    <button type="button" class="btn btn-success" onclick="showModalTambahAnggota()">
                        + Tambah Anggota
                    </button>
                    <button type="button" class="btn btn-secondary"
                        onclick="console.log(JSON.parse($('#anggota_json').val()))">
                        Lihat Isi JSON Anggota (Console)
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Hubungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="anggotaTable"></tbody>
                </table>

                <input type="hidden" name="anggota_json" id="anggota_json">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Modal Anggota --}}
    <div class="modal fade" id="anggotaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Anggota Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="accordionAnggota">
                        @php
                            $sections = [
                                [
                                    'id' => 'Identitas',
                                    'title' => 'Identitas Anggota',
                                    'fields' => [
                                        [
                                            'label' => 'Nama Lengkap',
                                            'id' => 'anggota_nama',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Gelar Depan',
                                            'id' => 'anggota_gelar_depan',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Gelar Belakang',
                                            'id' => 'anggota_gelar_belakang',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Jenis Kelamin',
                                            'id' => 'anggota_jk',
                                            'type' => 'select',
                                            'options' => ['L' => 'Laki-laki', 'P' => 'Perempuan'],
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Tempat Lahir',
                                            'id' => 'anggota_tempat_lahir',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Tanggal Lahir',
                                            'id' => 'anggota_tgl_lahir',
                                            'type' => 'date',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Kewarganegaraan',
                                            'id' => 'anggota_kewarganegaraan',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 'Dokumen',
                                    'title' => 'Dokumen',
                                    'fields' => [
                                        [
                                            'label' => 'Nomor Paspor',
                                            'id' => 'anggota_nomor_paspor',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tanggal Berakhir Paspor',
                                            'id' => 'anggota_tgl_berakhir_paspor',
                                            'type' => 'date',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nama Sponsor',
                                            'id' => 'anggota_nama_sponsor',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tipe Sponsor',
                                            'id' => 'anggota_tipe_sponsor',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Alamat Sponsor',
                                            'id' => 'anggota_alamat_sponsor',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nomor SK Penetapan WNI',
                                            'id' => 'anggota_nomor_sk',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Akta Lahir',
                                            'id' => 'anggota_akta_lahir',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nomor Akta Kelahiran',
                                            'id' => 'anggota_nomor_aktalahir',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 'Status',
                                    'title' => 'Status & Perkawinan',
                                    'fields' => [
                                        [
                                            'label' => 'Golongan Darah',
                                            'id' => 'anggota_gol_darah',
                                            'type' => 'select',
                                            'options' => ['A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O'],
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Agama',
                                            'id' => 'anggota_agama',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Organisasi Kepercayaan',
                                            'id' => 'anggota_organisasi',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Status Perkawinan',
                                            'id' => 'anggota_status_perkawinan',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Akta Perkawinan',
                                            'id' => 'anggota_akta_perkawinan',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nomor Akta Perkawinan',
                                            'id' => 'anggota_nomor_aktapernikahan',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tanggal Perkawinan',
                                            'id' => 'anggota_tgl_perkawinan',
                                            'type' => 'date',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Akta Cerai',
                                            'id' => 'anggota_akta_cerai',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nomor Akta Perceraian',
                                            'id' => 'anggota_nomor_aktacerai',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tanggal Perceraian',
                                            'id' => 'anggota_tgl_perceraian',
                                            'type' => 'date',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Status Hubungan',
                                            'id' => 'anggota_status_hubungan',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                    ],
                                ],
                                [
                                    'id' => 'Tambahan',
                                    'title' => 'Tambahan & Lainnya',
                                    'fields' => [
                                        [
                                            'label' => 'Kelainan Fisik & Mental',
                                            'id' => 'anggota_kelainan',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Penyandang Cacat',
                                            'id' => 'anggota_penyandang_cacat',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Pendidikan Terakhir',
                                            'id' => 'anggota_pendidikan',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Jenis Pekerjaan',
                                            'id' => 'anggota_pekerjaan',
                                            'type' => 'text',
                                            'required' => true,
                                        ],
                                        [
                                            'label' => 'Nomor ITAS/ITAP',
                                            'id' => 'anggota_nomor_itas',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tempat Terbit ITAS/ITAP',
                                            'id' => 'anggota_tempat_terbit_itas',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tanggal Terbit ITAS/ITAP',
                                            'id' => 'anggota_tgl_terbit_itas',
                                            'type' => 'date',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tanggal Akhir ITAS/ITAP',
                                            'id' => 'anggota_tgl_akhir_itas',
                                            'type' => 'date',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tempat Datang Pertama',
                                            'id' => 'anggota_tempat_datang',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Tanggal Kedatangan Pertama',
                                            'id' => 'anggota_tgl_datang',
                                            'type' => 'date',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'NIK Ibu',
                                            'id' => 'anggota_nik_ibu',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nama Ibu',
                                            'id' => 'anggota_nama_ibu',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'NIK Ayah',
                                            'id' => 'anggota_nik_ayah',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                        [
                                            'label' => 'Nama Ayah',
                                            'id' => 'anggota_nama_ayah',
                                            'type' => 'text',
                                            'required' => false,
                                        ],
                                    ],
                                ],
                            ];
                        @endphp
                        @foreach ($sections as $sec)
                            <div class="card">
                                <div class="card-header" id="heading{{ $sec['id'] }}">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse{{ $sec['id'] }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $sec['id'] }}">
                                            {{ $sec['title'] }}
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse{{ $sec['id'] }}" class="collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $sec['id'] }}" data-parent="#accordionAnggota">
                                    <div class="card-body row">
                                        @foreach ($sec['fields'] as $f)
                                            <div class="form-group col-md-{{ $f['type'] == 'textarea' ? '12' : '6' }}">
                                                <label class="control-label">{{ $f['label'] }}@if (!empty($f['required']))
                                                        <span class="required-asterisk text-danger">*</span>
                                                    @endif
                                                </label>
                                                @if ($f['type'] == 'select')
                                                    <select id="{{ $f['id'] }}" class="form-control"
                                                        {{ !empty($f['required']) ? 'required' : '' }}
                                                        data-required="{{ !empty($f['required']) ? 'true' : 'false' }}">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($f['options'] as $val => $text)
                                                            <option value="{{ $val }}">{{ $text }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @elseif($f['type'] == 'textarea')
                                                    <textarea id="{{ $f['id'] }}" class="form-control" rows="2"
                                                        {{ !empty($f['required']) ? 'required' : '' }} data-required="{{ !empty($f['required']) ? 'true' : 'false' }}"></textarea>
                                                @else
                                                    <input id="{{ $f['id'] }}" type="{{ $f['type'] }}"
                                                        class="form-control"
                                                        {{ !empty($f['required']) ? 'required' : '' }}
                                                        data-required="{{ !empty($f['required']) ? 'true' : 'false' }}">
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveAnggota">Simpan Anggota</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showModalTambahAnggota() {
            $("#anggotaModal").modal('show')
        }

        function showModalTambahAnggota() {
            const tipeKK = $('#tipe_kk').val();
            if (!tipeKK) {
                alert('Silakan pilih Tipe Kartu Keluarga terlebih dahulu.');
                return;
            }
            editIndex = null; // reset mode ke tambah baru
            resetAnggotaForm();
            $('#anggotaModal').modal('show');
        }

        $(function() {
            const $ln = $('#group-alamat-ln');
            const $modalFields = $('#accordionAnggota').find('input, select, textarea');

            function applyTipe() {
                const tipe = $('#tipe_kk').val();
                $('#group-alamat-ln').toggleClass('d-none', tipe !== 'WNILN');

                $('#group-alamat-ln').find('input, select, textarea').each(function() {
                    $(this).removeAttr('required').removeAttr('data-required');
                });

                if (tipe === 'WNILN') {
                    $('#group-alamat-ln').find('input, select, textarea').each(function() {
                        $(this).attr('required', true).attr('data-required', 'true');
                    });
                }

                const $allFields = $('#accordionAnggota').find('input, select, textarea');
                $allFields.prop('disabled', false).removeAttr('readonly required').removeClass(
                    'bg-light text-muted');
                $('.required-asterisk').show();

                if (tipe === 'WNI') {
                    $('#anggota_nama_sponsor, #anggota_tipe_sponsor, #anggota_alamat_sponsor, #anggota_nomor_itas, #anggota_tempat_terbit_itas, #anggota_tgl_terbit_itas, #anggota_tgl_akhir_itas, #anggota_tempat_datang, #anggota_tgl_datang')
                        .prop('disabled', true)
                        .removeAttr('required')
                        .addClass('bg-light text-muted')
                        .attr('title', 'Nonaktif untuk tipe WNI')
                        .each(function() {
                            $(this).closest('.form-group').find('.required-asterisk').hide();
                        });
                } else if (tipe === 'WNA') {
                    $('#anggota_nomor_sk')
                        .prop('disabled', true)
                        .removeAttr('required')
                        .addClass('bg-light text-muted')
                        .attr('title', 'Nonaktif untuk tipe WNA').each(function() {
                            $(this).closest('.form-group').find('.required-asterisk').hide();
                        });
                } else if (tipe === 'WNILN') {
                    $('#anggota_nomor_itas, #anggota_tempat_terbit_itas, #anggota_tgl_terbit_itas, #anggota_tgl_akhir_itas, #anggota_tempat_datang, #anggota_tgl_datang')
                        .prop('disabled', true)
                        .removeAttr('required')
                        .addClass('bg-light text-muted')
                        .attr('title', 'Nonaktif untuk tipe WNILN').each(function() {
                            $(this).closest('.form-group').find('.required-asterisk').hide();
                        });
                }
            }

            $('#tipe_kk').on('change', applyTipe).trigger('change');
        });

        function getAllAnggotaInputValues() {
            const data = {};
            $('#accordionAnggota').find('input, select, textarea').each(function() {
                const $el = $(this);
                if (!$el.prop('disabled')) {
                    data[$el.attr('id')] = $el.val();
                }
            });
            return data;
        }

        function validateAnggotaInputs() {
            let valid = true;
            $('#accordionAnggota').find('input, select, textarea').each(function() {
                const $el = $(this);
                const isRequired = $el.data('required') === true || $el.data('required') === 'true';
                const tag = $el.prop('tagName').toLowerCase();
                const type = $el.attr('type');

                if (!isRequired || $el.prop('disabled')) return;

                let value = $el.val();
                let isEmpty = false;

                if (tag === 'select') {
                    isEmpty = !value || value === '' || value === '-- Pilih --';
                } else if (type === 'date') {
                    isEmpty = !value || value === '';
                } else {
                    isEmpty = !value.trim();
                }

                if (isEmpty) {
                    valid = false;
                    $el.addClass('is-invalid');
                } else {
                    $el.removeClass('is-invalid');
                }
            });
            return valid;
        }

        let anggotaArray = [];
        let editIndex = null;

        function refreshTable() {
            const tbody = $('#anggotaTable').empty();
            anggotaArray.forEach((m, i) => {
                tbody.append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${m.anggota_nama || m.name ||''}</td>
                        <td>${m.anggota_jk || m.gender || ''}</td>
                        <td>${m.anggota_status_hubungan || m.status_relation || ''}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm btn-edit" data-index="${i}">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-index="${i}">Hapus</button>
                        </td>
                    </tr>
                `);
            });

            $('#anggota_json').val(JSON.stringify(anggotaArray));
        }

        $('#saveAnggota').click(function() {
            if (!validateAnggotaInputs()) {
                alert('Harap isi semua input wajib.');
                return;
            }
            const anggotaData = getAllAnggotaInputValues();
            if (editIndex !== null) {
                anggotaArray[editIndex] = anggotaData;
                editIndex = null; // reset ke mode tambah
            } else {
                anggotaArray.push(anggotaData);
            }
            refreshTable();
            $('#anggotaModal').modal('hide');
            resetAnggotaForm();
        });

        $('#anggotaTable').on('click', '.btn-edit', function() {
            const index = $(this).data('index');
            console.log(index) // 8 Sep 25
            const anggota = anggotaArray[index];
            // Isi form modal dengan data anggota
            for (const key in anggota) {
                $(`#${key}`).val(anggota[key]);
            }
            editIndex = index;
            $('#anggotaModal').modal('show');
        });

        $('#anggotaTable').on('click', '.btn-delete', function() {
            const index = $(this).data('index');
            anggotaArray.splice(index, 1);
            refreshTable();
        });

        function resetAnggotaForm() {
            $('#accordionAnggota').find('input, select, textarea').each(function() {
                if (!$(this).prop('disabled')) {
                    $(this).val('').removeClass('is-invalid');
                }
            });
        }

        $('#kkForm').on('submit', function(e) {
            // cek jumlah anggota di JSON
            if (anggotaArray.length === 0) {
                e.preventDefault();
                alert('Harap tambahkan minimal satu anggota keluarga sebelum menyimpan.');
                return false;
            }

            // cek apakah jumlah anggota sesuai input jumlah_anggota
            const jumlahInput = parseInt($('#jumlah_anggota').val(), 10);
            if (anggotaArray.length !== jumlahInput) {
                e.preventDefault();
                alert(
                    `Jumlah anggota yang dimasukkan (${anggotaArray.length}) tidak sesuai dengan jumlah yang Anda isikan di atas (${jumlahInput}).`
                );
                return false;
            }

            // validasi native form HTML
            if (!this.checkValidity()) {
                e.preventDefault();
                this.reportValidity();
                return false;
            }
        });

        function cariNoKk() {
            let no_kk = $("#no_kk").val();
            let url = '{{ route('kartu-keluarga.cari-no-kk-pemohon', ':no_kk') }}';
            url = url.replace(':no_kk', no_kk);
            $.ajax({
                url: url,
                type: 'GET',
                error: function(request, error) {
                    // alert("Silakan Diisi Secara manual atau Cek NIK dengan Teliti.")
                    $("#modal-alert").modal('show')
                    $("#modal-alert #modal-body").html(
                        'Maaf NIK Tidak Ditemukan. Silakan Diisi Secara manual atau Cek NIK dengan Teliti.')
                },
            }).then(function(res) {
                const anggotaData = res;
                if (editIndex !== null) {
                    anggotaArray[editIndex] = anggotaData;
                    editIndex = null; // reset ke mode tambah
                } else {
                    // langsung gabungkan isinya, bukan push array
                    anggotaArray.push(...anggotaData);
                }
                refreshTable();
                $('#anggotaModal').modal('hide');
                resetAnggotaForm();
            });

        }
    </script>
@endpush
