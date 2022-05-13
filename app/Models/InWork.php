<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InWork extends Model
{
    use HasFactory;
    protected $table = 'in_work';
    protected $primaryKey = 'iw_id';
    public $timestamps = false;
}
