<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use SoftDeletes;
    protected $table = 'table_jurusan';
    protected $dates = ['deleted_at'];
    protected $fillable = ['kode_jurusan', 'nama_jurusan'];
}
