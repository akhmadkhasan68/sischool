<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;
    protected $table = 'table_siswa';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nis_siswa', 'nisn_siswa', 'nama_siswa', 'kelas_id', 'agama_siswa', 'jk_siswa', 'no_siswa', 'alamat_siswa', 'kota_siswa', 'tempat_lahir_siswa', 'tgl_lahir_siswa', 'foto_siswa', 'user_id'];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
