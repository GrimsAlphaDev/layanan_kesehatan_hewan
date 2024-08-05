<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faksin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kriteria()
    {
        return $this->belongsTo(KriteriaPenyakitMenular::class, 'kriteria_penyakit_menular_id');
    }
}
