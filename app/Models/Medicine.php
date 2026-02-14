<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = ['id'];

    protected $table = 'medicines';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
