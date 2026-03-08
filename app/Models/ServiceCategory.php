<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $guarded = ['id'];
    protected $table = 'service_categories';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
