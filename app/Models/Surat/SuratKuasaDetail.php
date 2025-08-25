<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKuasaDetail extends Model
{
    use HasFactory;
    protected $table = 'surat_kuasa_detail';
    protected $guarded = ['id'];

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'id_sumber_dana', 'id');
    }
}
