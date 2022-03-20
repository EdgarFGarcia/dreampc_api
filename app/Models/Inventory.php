<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "inventory";
    protected $fillable = [
        'id',
        'product_name',
        'item_no',
        'manufacturer',
        'price',
        'condition_id',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function condition(){
        return $this->hasOne(Condition::class, 'id', 'condition_id');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
