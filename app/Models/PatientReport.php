<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    protected $guarded = ['id'];

    protected $table = 'patient_reports';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
