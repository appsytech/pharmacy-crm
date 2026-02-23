<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Patient extends Authenticatable
{
    protected $guarded = ['id'];

    protected $table = 'patients';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
