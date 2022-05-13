<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleHasRoute extends Model
{
    use HasFactory;
    protected $table = 'shuttle_has_routes';
    protected $primaryKey = 'shr_id';
    public $timestamps = false;
}
