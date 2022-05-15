<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleOnRoute extends Model
{
    use HasFactory;
    protected $table = 'shuttle_on_routes';
    protected $primaryKey = 'sor_id';
    public $timestamps = false;
}
