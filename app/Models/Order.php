<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "orders";
    protected $fillable = [
        'id',
        'customer_name',
        'firstname',
        'lastname',
        'product_name',
        'manufacturer',
        'item_number',
        'quantity',
        'total',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'created_at'    =>  'datetime:M d, Y'
    ];

    public function get_category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
