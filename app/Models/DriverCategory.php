<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCategory extends Model
{
    use HasFactory;
    protected $table = 'drivers_categories';
    protected $primaryKey = 'dc_id';
    public $timestamps = false;
}
