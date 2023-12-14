<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KetuaRt extends Model
{
    protected $table = 'ketua_rts';
    protected $fillable = ['rt','rw','name','nik','description','user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
}
