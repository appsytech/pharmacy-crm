<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = ['id'];
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
