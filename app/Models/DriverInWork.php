<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverInWork extends Model
{
    use HasFactory;
    protected $table = 'driver_in_works';
    protected $primaryKey = 'dw_id';
    public $timestamps = false;
}
