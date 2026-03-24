<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'customer_id', 'name', 'email',
        'mobile', 'inquiry_about', 'message', 'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}