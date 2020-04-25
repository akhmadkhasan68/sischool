<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;
    protected $table = 'table_mapel';
    protected $dates = ['deleted_at'];
    protected $fillable = ['kode_mapel', 'nama_mapel', 'kelompok_mapel'];
}
