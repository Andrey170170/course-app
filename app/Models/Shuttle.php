<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuttle extends Model
{
    use HasFactory;
    protected $table = 'shuttles';
    protected $primaryKey = 'sh_id';
    public $timestamps = false;
}
