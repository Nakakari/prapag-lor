<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataKematianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "nik" => ['required', 'max:16'],
            "nama" => ['required',],
            "tanggal_lahir" => ['required',],
            "jenis_kelamin_id" => ['required',],
            "alamat" => ['required',],
            "rw_id" => ['required',],
            "rt_id" => ['required',],
            "tahun" => ['required',],
            "tanggal_pemakaman" => ['required',],
            "tempat_tanggal_meninggal" => ['required',],
            "nama_ayah" => ['required',],
            "nama_ibu" => ['required',],
            "penyebab_kematian" => ['required',],
            "nama_pelapor" => ['required',],
            "nik_pelapor" => ['required',],
            "nama_pelapor_2" => ['required',],
            "nik_pelapor_2" => ['required',],
            "keterangan" => ['nullable',],
        ];
    }
}
