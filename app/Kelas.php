<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    
    protected $table = 'kelas';

    protected $fillable = [
        'nama', 'id_sekolah'
    ];

    public function sekolah() {
        return $this->hasOne('App\Sekolah');
    }

    public function siswa() {
        return $this->hasMany('App\Siswa', 'id_kelas');
      }

}
