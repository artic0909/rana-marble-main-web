<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'customer_id',
        'rating',
        'name',
        'city',
        'state',
        'review',
        'media',
        'status',
    ];

    protected $casts = [
        'media'  => 'array',
        'rating' => 'integer',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // ── Scopes ────────────────────────────────────────────────

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}