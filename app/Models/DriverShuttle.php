<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverShuttle extends Model
{
    use HasFactory;
    protected $table = 'driver_shuttles';
    protected $primaryKey = 'ds_id';
    public $timestamps = false;
}
