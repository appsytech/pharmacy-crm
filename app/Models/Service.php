<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    protected $table = 'services';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
