<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShuttleHasCategory extends Model
{
    use HasFactory;
    protected $table = 'shuttles_has_categories';
    protected $primaryKey = 'shc_id';
    public $timestamps = false;
}
