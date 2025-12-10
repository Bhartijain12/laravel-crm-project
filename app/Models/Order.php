<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;   // 👈 add this

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_name',
        'quantity',
        'price',
        'status'
    ];

    // ✅ Relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
