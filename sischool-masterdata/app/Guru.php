<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;
    protected $table = 'table_guru';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nama_guru', 'nip_guru', 'jk_guru', 'no_guru', 'alamat_guru', 'kecamatan_guru', 'kota_guru', 'foto_guru', 'id_user'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
