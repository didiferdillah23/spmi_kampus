<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian_kinerja extends Model
{
    protected $table = 'penilaian_kinerja';

    public function Dokumen_mutu() {
        return $this->belongsTo('App\Models\Dokumen_mutu');
    }

    public function Hasil_kerja() {
        return $this->belongsTo('App\Models\Hasil_kerja');
    }

    public function User() {
        return $this->belongsTo('App\Models\User');
    }
}
