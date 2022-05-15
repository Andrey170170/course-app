<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteByStop extends Model
{
    use HasFactory;
    protected $table = 'route_by_stops';
    protected $primaryKey = 'rbs_id';
    public $timestamps = false;
}
