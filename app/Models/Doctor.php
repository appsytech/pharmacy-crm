<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Doctor extends Authenticatable
{
    protected $guarded = ['id'];

    protected $table = 'doctors';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
