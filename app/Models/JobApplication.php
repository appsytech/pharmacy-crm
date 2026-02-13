<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $guarded = ['id'];

    protected $table = 'job_applications';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
