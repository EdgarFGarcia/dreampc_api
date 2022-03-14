<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "user_roles";
    protected $fillable = [
        'id', 'position', 'updated_at', 'created_at', 'deleted_at'
    ];
}
