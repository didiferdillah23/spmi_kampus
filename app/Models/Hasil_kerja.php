<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_kerja extends Model
{
    protected $table = 'hasil_kerja';

    public function User() {
        return $this->belongsTo('App\Models\User');
    }

    public function Dokumen_mutu() {
        return $this->belongsTo('App\Models\Dokumen_mutu');
    }

    public function Penilaian_kinerja() {
        return $this->hasOne('App\Models\Penilaian_kinerja');
    }
}
