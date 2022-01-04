<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen_mutu extends Model
{
    protected $table = 'dokumen_mutu';

    public function User() {
        return $this->belongsTo('App\Models\User');
    }

    public function Hasil_kerja() {
        return $this->hasMany('App\Models\Hasil_kerja');
    }

    public function Penilaian_kinerja() {
        return $this->hasMany('App\Models\Penilaian_kinerja');
    }
}
