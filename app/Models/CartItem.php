<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
    'cart_id',
    'user_id',
    'service_id',
    'quantity',
    'total_price',
    'status',
];





    /**
     * The cart this item belongs to.
     */

    /**
     * The service associated with this cart item.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }


}
