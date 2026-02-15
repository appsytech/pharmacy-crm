<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $guarded = ['id'];
    protected $table = 'supplier_payments';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
