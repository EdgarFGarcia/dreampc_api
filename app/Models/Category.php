<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "categories";
    protected $fillable = [
        'id',
        'name',
        'price',
        'updated_at',
        'created_at',
        'deleted_at'
    ];
}
