<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kriteria_penyakit_menular()
    {
        return $this->belongsTo(KriteriaPenyakitMenular::class);
    }

    public function faksin()
    {
        return $this->belongsTo(Faksin::class);
    }
}
