<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = ['id'];

    protected $table = 'suppliers';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
