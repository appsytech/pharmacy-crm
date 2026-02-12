<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Staff extends Authenticatable
{

    protected $guarded = ['id'];

    protected $table = 'staffs';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
