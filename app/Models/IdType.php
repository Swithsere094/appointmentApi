<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdType extends Model
{
    protected $table = "id_types";
    use HasFactory, SoftDeletes;
}
