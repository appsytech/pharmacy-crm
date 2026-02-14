<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffSalary extends Model
{
     protected $guarded = ['id'];

    protected $table = 'staff_salary';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
