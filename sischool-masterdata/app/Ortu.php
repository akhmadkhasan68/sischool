<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ortu extends Model
{
    use SoftDeletes;
    protected $table = 'table_siswa_ortu';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'siswa_nis',
        'nama_ortu',
        'jk_ortu',
        'no_ortu',
        'alamat_ortu',
        'kota_ortu',
        'pendidikan_ortu',
        'pekerjaan_ortu',
        'gaji_ortu',
        'status_hubungan',
        'id_user'
    ];
    
    public function siswa()
    {
        return $this->hasOne('App\Siswa', 'nis_siswa', 'siswa_nis');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
