<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverStatus extends Model
{
    use HasFactory;
    protected $table = 'driver_statuses';
    protected $primaryKey = 'ds_id';
    public $timestamps = false;
}
