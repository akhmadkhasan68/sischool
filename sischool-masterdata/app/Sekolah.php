<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'conf_sekolah';
    protected $guarded = ['created_at', 'updated_at'];
}
