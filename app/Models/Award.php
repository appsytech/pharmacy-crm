<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $guarded = ['id'];

    protected $table = 'awards';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
