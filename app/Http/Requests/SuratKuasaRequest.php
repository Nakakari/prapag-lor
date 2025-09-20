<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKuasaRequest extends FormRequest
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
            'id_sumber_dana'   => ['required', 'array', 'min:1'],
            'id_sumber_dana.*' => ['integer', 'exists:sumber_dana,id'],
            "nama_penerima_kuasa" => ['required'],
            "nama_pemberi_kuasa" => ['required'],
            "tanggal_surat" => ['required'],
            "nomor_surat" => ['required'],
            "nomor" => ['required'],
            "nik_pemberi_kuasa" => ['required'],
            "jabatan_pemberi_kuasa" => ['required'],
            "no_hp_pemberi_kuasa" => ['required'],
            "alamat_pemberi_kuasa" => ['required'],
            "nik_penerima_kuasa" => ['required'],
            "jabatan_penerima_kuasa" => ['required'],
            "no_hp_penerima_kuasa" => ['required'],
            "alamat_penerima_kuasa" => ['required'],
            "nominal" => ['required'],
            "start_date" => ['required'],
            "end_date" => ['required'],
        ];
    }
}
