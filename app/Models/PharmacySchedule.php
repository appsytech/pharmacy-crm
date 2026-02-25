<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacySchedule extends Model
{
    protected $guarded = ['id'];
    protected $table = 'pharmacy_schedule';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
