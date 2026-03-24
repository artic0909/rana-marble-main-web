<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'order_number', 'status',
        'subtotal', 'shipping_fees', 'total',
        'pincode', 'shipping_address', 'shipping_city',
        'shipping_state', 'shipping_landmark', 'phone',
        'notes', 'confirmed_at', 'shipped_at', 'delivered_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'shipped_at'   => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Human readable status
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'Pending',
            'confirmed'  => 'Confirmed',
            'processing' => 'Processing',
            'shipped'    => 'Shipped',
            'delivered'  => 'Delivered',
            'cancelled'  => 'Cancelled',
            default      => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'    => '#f39c12',
            'confirmed'  => '#27ae60',
            'processing' => '#3498db',
            'shipped'    => '#8e44ad',
            'delivered'  => '#27ae60',
            'cancelled'  => '#e74c3c',
            default      => '#999',
        };
    }
}