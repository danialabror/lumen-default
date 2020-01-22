<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    
    protected $table = 'siswa';

    protected $fillable = [
        'nama','email','id_kelas','gender'
    ];

    public function kelas() {
        return $this->hasOne('App\Kelas','id','id_kelas');
    }
}
