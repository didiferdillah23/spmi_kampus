<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'nama',
        'username',
        'password',
        'level',
    ];

    public function Dokumen_mutu() {
        return $this->hasMany('App\Models\Dokumen_mutu');
    }

    public function Hasil_kerja() {
        return $this->hasMany('App\Models\Hasil_kerja');
    }

    public function Penilaian_kinerja() {
        return $this->hasMany('App\Models\Penilaian_kinerja');
    }

}
