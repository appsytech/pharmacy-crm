<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = ['id'];

    protected $table = 'patients';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
