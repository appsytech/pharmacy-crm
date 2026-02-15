<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyBranch extends Model
{
    protected $guarded = ['id'];
    protected $table = 'pharmacy_branches';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
