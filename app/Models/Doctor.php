<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $guarded = ['id'];

    protected $table = 'doctors';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
