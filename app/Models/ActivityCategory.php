<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $guarded = ["id"];
    protected $table = 'activity_categories';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
