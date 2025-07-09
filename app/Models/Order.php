<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'subtotal',
        'tax_amount',
        'shipping_amount',
        'discount_amount',
        'payment_status',
        'payment_method',
        'payment_proof',
        'shipping_address',
        'billing_address',
        'notes',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tracking()
    {
        return $this->hasMany(OrderTracking::class)->orderBy('tracked_at', 'desc');
    }

    public function latestTracking()
    {
        return $this->hasOne(OrderTracking::class)->latestOfMany('tracked_at');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function scopeShipped($query)
    {
        return $query->where('status', 'shipped');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // Accessors
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Terkirim',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($this->status)
        };
    }

    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getFormattedShippingCostAttribute()
    {
        return 'Rp ' . number_format($this->shipping_amount, 0, ',', '.');
    }

    public function getFormattedDiscountAttribute()
    {
        return 'Rp ' . number_format($this->discount_amount, 0, ',', '.');
    }

    public function getShippingNameAttribute()
    {
        if (is_array($this->shipping_address)) {
            return $this->shipping_address['name'] ?? '';
        }
        return '';
    }

    public function getShippingPhoneAttribute()
    {
        if (is_array($this->shipping_address)) {
            return $this->shipping_address['phone'] ?? '';
        }
        return '';
    }

    public function getShippingAddressStringAttribute()
    {
        if (is_array($this->shipping_address)) {
            return $this->shipping_address['address'] ?? '';
        }
        return $this->shipping_address ?? '';
    }

    public function getShippingCityAttribute()
    {
        if (is_array($this->shipping_address)) {
            return $this->shipping_address['city'] ?? '';
        }
        return '';
    }

    public function getShippingPostalCodeAttribute()
    {
        if (is_array($this->shipping_address)) {
            return $this->shipping_address['postal_code'] ?? '';
        }
        return '';
    }

    public function getShippingNotesAttribute()
    {
        if (is_array($this->shipping_address)) {
            return $this->shipping_address['notes'] ?? '';
        }
        return $this->notes ?? '';
    }

    public function getPaymentStatusLabelAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Pembayaran Gagal',
            'refunded' => 'Dikembalikan',
            default => 'Menunggu Pembayaran'
        };
    }

    // Methods
    public function generateOrderNumber()
    {
        $this->order_number = 'ORD-' . date('Ymd') . '-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
        $this->save();
    }

    public function addTracking($status, $title, $description = null, $location = null, $metadata = null, $trackedAt = null)
    {
        return $this->tracking()->create([
            'status' => $status,
            'title' => $title,
            'description' => $description,
            'location' => $location,
            'metadata' => $metadata,
            'tracked_at' => $trackedAt ?: now(),
        ]);
    }

    public function updateStatus($newStatus, $trackingTitle = null, $trackingDescription = null)
    {
        $this->update(['status' => $newStatus]);
        
        // Add tracking entry
        $title = $trackingTitle ?: $this->getDefaultTrackingTitle($newStatus);
        $description = $trackingDescription ?: $this->getDefaultTrackingDescription($newStatus);
        
        $this->addTracking($newStatus, $title, $description);
        
        // Update timestamps for specific statuses
        if ($newStatus === 'shipped') {
            $this->update(['shipped_at' => now()]);
        } elseif ($newStatus === 'delivered') {
            $this->update(['delivered_at' => now()]);
        }
    }

    private function getDefaultTrackingTitle($status)
    {
        return match($status) {
            'pending' => 'Pesanan Diterima',
            'confirmed' => 'Pesanan Dikonfirmasi',
            'processing' => 'Pesanan Sedang Diproses',
            'packed' => 'Pesanan Dikemas',
            'shipped' => 'Pesanan Dikirim',
            'out_for_delivery' => 'Dalam Perjalanan',
            'delivered' => 'Pesanan Terkirim',
            'cancelled' => 'Pesanan Dibatalkan',
            default => 'Update Status'
        };
    }

    private function getDefaultTrackingDescription($status)
    {
        return match($status) {
            'pending' => 'Pesanan Anda telah diterima dan menunggu konfirmasi.',
            'confirmed' => 'Pesanan Anda telah dikonfirmasi dan akan segera diproses.',
            'processing' => 'Pesanan Anda sedang diproses oleh tim kami.',
            'packed' => 'Pesanan Anda telah dikemas dan siap untuk dikirim.',
            'shipped' => 'Pesanan Anda telah dikirim dan dalam perjalanan.',
            'out_for_delivery' => 'Pesanan Anda sedang dalam perjalanan untuk pengiriman.',
            'delivered' => 'Pesanan Anda telah berhasil terkirim.',
            'cancelled' => 'Pesanan Anda telah dibatalkan.',
            default => 'Status pesanan telah diperbarui.'
        };
    }
}