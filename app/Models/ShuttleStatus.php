<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleStatus extends Model
{
    use HasFactory;
    protected $table = 'shuttle_statuses';
    protected $primaryKey = 'shs_id';
    public $timestamps = false;
}
