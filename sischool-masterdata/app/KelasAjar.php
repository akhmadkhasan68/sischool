<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasAjar extends Model
{
    use SoftDeletes;
    protected $table = 'table_kelas_ajar';
    protected $dates = ['deleted_at'];
    protected $fillable = ['mapel_guru_id', 'kelas_id'];

    public function mapel_guru()
    {
        return $this->belongsTo('App\MapelGuru', 'mapel_guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas_id');
    }
}
