<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'prod_id',
        'qty',
        'price',
    ];
    /**
     * Get the user that owns the orderitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(product::class, 'prod_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(order::class, 'order_id', 'id');
    }
}
