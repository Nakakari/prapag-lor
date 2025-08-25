<?php

namespace App\Models\Surat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKuasa extends Model
{
    use HasFactory;
    protected $table = 'surat_kuasa';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'id_sumber_dana', 'id');
    }

    public function suratKuasaDetail()
    {
        return $this->hasMany(SuratKuasaDetail::class, 'id_surat_kuasa', 'id');
    }
}
