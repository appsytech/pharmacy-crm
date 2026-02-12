<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientAppoinment extends Model
{
    protected $guarded = ['id'];

    protected $table = 'patient_appointments';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
