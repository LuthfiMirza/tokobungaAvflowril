<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    use HasFactory;

    protected $table = 'order_tracking';

    protected $fillable = [
        'order_id',
        'status',
        'title',
        'description',
        'location',
        'metadata',
        'tracked_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'tracked_at' => 'datetime',
    ];

    // Relations
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Scopes
    public function scopeForOrder($query, $orderId)
    {
        return $query->where('order_id', $orderId);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('tracked_at', 'desc');
    }

    // Accessors
    public function getFormattedDateAttribute()
    {
        return $this->tracked_at->format('d M Y, H:i');
    }

    public function getStatusIconAttribute()
    {
        return match($this->status) {
            'pending' => 'fa-clock',
            'payment_uploaded' => 'fa-upload',
            'confirmed' => 'fa-check-circle',
            'processing' => 'fa-cogs',
            'packed' => 'fa-box',
            'shipped' => 'fa-truck',
            'out_for_delivery' => 'fa-shipping-fast',
            'delivered' => 'fa-check-double',
            'cancelled' => 'fa-times-circle',
            default => 'fa-info-circle'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'payment_uploaded' => 'info',
            'confirmed' => 'success',
            'processing' => 'primary',
            'packed' => 'secondary',
            'shipped' => 'info',
            'out_for_delivery' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function getMetadataStringAttribute()
    {
        if (is_array($this->metadata)) {
            return json_encode($this->metadata);
        }
        return $this->metadata ?? '';
    }
}