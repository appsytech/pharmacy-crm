<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    protected $guarded = ['id'];

    protected $table = 'staffs';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
