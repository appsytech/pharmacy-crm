<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $guarded = ['id'];

    protected $table = 'manufacturers';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
