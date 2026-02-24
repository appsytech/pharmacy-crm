<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = ['id'];

    protected $table = 'galleries';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
