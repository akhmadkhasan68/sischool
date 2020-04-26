<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MapelGuru extends Model
{
    use SoftDeletes;
    protected $table = 'table_mapel_guru';
    protected $dates = ['deleted_at'];
    protected $fillable = ['guru_id', 'mapel_id', 'kkm'];

    public function guru()
    {
        return $this->belongsTo('App\Guru', 'guru_id');
    }

    public function mapel()
    {
        return $this->belongsTo('App\Mapel', 'mapel_id');
    }
}
