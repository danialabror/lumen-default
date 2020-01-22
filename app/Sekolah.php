<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    
    protected $table = 'sekolah';

    protected $fillable = [
        'nama'
    ];

    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'id_sekolah');
    }

}
