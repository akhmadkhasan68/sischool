<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;
    protected $table = 'table_guru';
    protected $dates = ['deleted_at'];
    protected $fillable = [''];
}
