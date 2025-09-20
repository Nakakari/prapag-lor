<?php

namespace App\Dtos;

class PendudukKartuKeluargaDto
{
    public $anggota_agama;
    public $anggota_akta_cerai;
    public $anggota_akta_perkawinan;
    public $anggota_gelar_belakang;
    public $anggota_gol_darah;
    public $anggota_jk;
    public $anggota_nama;
    public $anggota_nama_ayah;
    public $anggota_nama_ibu;
    public $anggota_nik_ayah;
    public $anggota_nomor_aktacerai;
    public $anggota_nomor_aktalahir;
    public $anggota_nomor_aktapernikahan;
    public $anggota_pekerjaan;
    public $anggota_pendidikan;
    public $anggota_status_hubungan;
    public $anggota_status_perkawinan;
    public $anggota_tempat_lahir;
    public $anggota_tgl_lahir;

    public function __construct(array $data)
    {
        $this->anggota_agama = $data['religion'] ?? null; // mapping di sini
        $this->anggota_akta_cerai = $data['divorce_certificate'] ?? null;
        $this->anggota_akta_perkawinan =  null;
        $this->anggota_gelar_belakang =  null;
        $this->anggota_gol_darah =  $data['blood_type'] ?? null;
        $this->anggota_jk =  $data['gender'] ?? null;
        $this->anggota_nama =  $data['name'] ?? null;
        $this->anggota_nama_ayah =  $data['father_name'] ?? null;
        $this->anggota_nama_ibu =  $data['mother_name'] ?? null;
        $this->anggota_nik_ayah =   null;
        $this->anggota_nomor_aktacerai = $data['divorce_certificate'] ?? null;
        $this->anggota_nomor_aktalahir = $data['birth_certificate'] ?? null;
        $this->anggota_nomor_aktapernikahan = $data['marriage_certificate'] ?? null;
        $this->anggota_pekerjaan = $data['occupation'] ?? null;
        $this->anggota_pendidikan = $data['degree'] ?? null;
        $this->anggota_status_hubungan = $data['status_relation'] ?? null;
        $this->anggota_status_perkawinan = $data['status_marital'] ?? null;
        $this->anggota_tempat_lahir = $data['birth_place'] ?? null;
        $this->anggota_tgl_lahir = $data['birth_date'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'anggota_agama' => $this->anggota_agama,
            'anggota_akta_cerai' => $this->anggota_akta_cerai,
            'anggota_akta_perkawinan' => null,
            'anggota_gelar_belakang' => null,
            'anggota_gelar_depan' => null,
            'anggota_gol_darah' => null,
            'anggota_jk' => $this->anggota_jk,
            'anggota_kelainan' => null,
            'anggota_kewarganegaraan' => null,
            'anggota_nama' => $this->anggota_nama,
            'anggota_nama_ayah' => $this->anggota_nama_ayah,
            'anggota_nama_ibu' => $this->anggota_nama_ibu,
            'anggota_nik_ayah' => $this->anggota_nik_ayah,
            'anggota_nik_ibu' => null,
            'anggota_nomor_aktacerai' => $this->anggota_nomor_aktacerai,
            'anggota_nomor_aktalahir' => $this->anggota_nomor_aktalahir,
            'anggota_nomor_aktapernikahan' => $this->anggota_nomor_aktapernikahan,
            'anggota_nomor_paspor' => null,
            'anggota_nomor_sk' => null,
            'anggota_organisasi' => null,
            'anggota_pekerjaan' => $this->anggota_pekerjaan,
            'anggota_pendidikan' => $this->anggota_pendidikan,
            'anggota_penyandang_cacat' => null,
            'anggota_status_hubungan' => $this->anggota_status_hubungan,
            'anggota_status_perkawinan' => $this->anggota_status_perkawinan,
            'anggota_tempat_lahir' => $this->anggota_tempat_lahir,
            'anggota_tgl_berakhir_paspor' => null,
            'anggota_tgl_lahir' => $this->anggota_tgl_lahir,
            'anggota_tgl_perceraian' => null,
            'anggota_tgl_perkawinan' => null,
        ];
    }
}
