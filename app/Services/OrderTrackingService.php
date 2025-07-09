<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Support\Facades\Log;

class OrderTrackingService
{
    /**
     * Auto-update order tracking based on payment status and time
     */
    public function autoUpdateTracking(Order $order)
    {
        try {
            $latestTracking = $order->tracking()->latest('tracked_at')->first();
            $currentStatus = $latestTracking ? $latestTracking->status : 'pending';
            
            // Auto-progression logic based on payment status and time
            switch ($currentStatus) {
                case 'pending':
                    if ($order->payment_status === 'paid') {
                        $this->addConfirmedTracking($order);
                    }
                    break;
                    
                case 'payment_uploaded':
                    // Auto-confirm payment after upload
                    $this->addConfirmedTracking($order);
                    break;
                    
                case 'confirmed':
                    // Auto-progress to processing after 1 hour
                    if ($latestTracking && $latestTracking->tracked_at->diffInHours(now()) >= 1) {
                        $this->addProcessingTracking($order);
                    }
                    break;
                    
                case 'processing':
                    // Auto-progress to packed after 2-4 hours
                    if ($latestTracking && $latestTracking->tracked_at->diffInHours(now()) >= 2) {
                        $this->addPackedTracking($order);
                    }
                    break;
                    
                case 'packed':
                    // Auto-progress to shipped after 1-2 hours
                    if ($latestTracking && $latestTracking->tracked_at->diffInHours(now()) >= 1) {
                        $this->addShippedTracking($order);
                    }
                    break;
                    
                case 'shipped':
                    // Auto-progress to out_for_delivery after 1-3 days
                    if ($latestTracking && $latestTracking->tracked_at->diffInDays(now()) >= 1) {
                        $this->addOutForDeliveryTracking($order);
                    }
                    break;
                    
                case 'out_for_delivery':
                    // Auto-progress to delivered after 2-6 hours
                    if ($latestTracking && $latestTracking->tracked_at->diffInHours(now()) >= 2) {
                        $this->addDeliveredTracking($order);
                    }
                    break;
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error('Auto tracking update failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
    
    /**
     * Add confirmed tracking
     */
    private function addConfirmedTracking(Order $order)
    {
        $order->updateStatus('confirmed', 'Pembayaran Dikonfirmasi', 'Pembayaran telah dikonfirmasi dan pesanan mulai diproses.');
        
        Log::info('Order confirmed automatically', ['order_id' => $order->id]);
    }
    
    /**
     * Add processing tracking
     */
    private function addProcessingTracking(Order $order)
    {
        $order->addTracking(
            'processing',
            'Pesanan Sedang Diproses',
            'Tim kami sedang menyiapkan pesanan Anda dengan teliti.',
            'Gudang Avflowril'
        );
        
        $order->update(['status' => 'processing']);
        
        Log::info('Order processing automatically', ['order_id' => $order->id]);
    }
    
    /**
     * Add packed tracking
     */
    private function addPackedTracking(Order $order)
    {
        $order->addTracking(
            'packed',
            'Pesanan Dikemas',
            'Pesanan Anda telah selesai dikemas dan siap untuk dikirim.',
            'Gudang Avflowril'
        );
        
        $order->update(['status' => 'packed']);
        
        Log::info('Order packed automatically', ['order_id' => $order->id]);
    }
    
    /**
     * Add shipped tracking
     */
    private function addShippedTracking(Order $order)
    {
        $courierServices = ['JNE', 'J&T Express', 'SiCepat', 'AnterAja', 'Ninja Express'];
        $selectedCourier = $courierServices[array_rand($courierServices)];
        $trackingNumber = $this->generateTrackingNumber();
        
        $order->addTracking(
            'shipped',
            'Pesanan Dikirim',
            "Pesanan Anda telah dikirim melalui {$selectedCourier} dengan nomor resi: {$trackingNumber}",
            'Sorting Center Jakarta',
            [
                'courier' => $selectedCourier,
                'tracking_number' => $trackingNumber,
                'estimated_delivery' => now()->addDays(rand(2, 5))->format('Y-m-d')
            ]
        );
        
        $order->update([
            'status' => 'shipped',
            'shipped_at' => now()
        ]);
        
        Log::info('Order shipped automatically', [
            'order_id' => $order->id,
            'courier' => $selectedCourier,
            'tracking_number' => $trackingNumber
        ]);
    }
    
    /**
     * Add out for delivery tracking
     */
    private function addOutForDeliveryTracking(Order $order)
    {
        $locations = [
            'Kantor Pos ' . $order->shipping_city,
            'Hub Terdekat ' . $order->shipping_city,
            'Delivery Center ' . $order->shipping_city
        ];
        
        $location = $locations[array_rand($locations)];
        
        $order->addTracking(
            'out_for_delivery',
            'Dalam Perjalanan',
            'Paket sedang dalam perjalanan menuju alamat tujuan. Kurir akan segera menghubungi Anda.',
            $location
        );
        
        $order->update(['status' => 'out_for_delivery']);
        
        Log::info('Order out for delivery automatically', ['order_id' => $order->id]);
    }
    
    /**
     * Add delivered tracking
     */
    private function addDeliveredTracking(Order $order)
    {
        $order->addTracking(
            'delivered',
            'Pesanan Diterima',
            'Pesanan telah berhasil diterima oleh penerima. Terima kasih telah berbelanja di Avflowril!',
            $order->shipping_address_string
        );
        
        $order->update([
            'status' => 'delivered',
            'delivered_at' => now()
        ]);
        
        Log::info('Order delivered automatically', ['order_id' => $order->id]);
    }
    
    /**
     * Generate random tracking number
     */
    private function generateTrackingNumber()
    {
        $prefixes = ['JNE', 'JT', 'SC', 'AA', 'NX'];
        $prefix = $prefixes[array_rand($prefixes)];
        $number = str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);
        
        return $prefix . $number;
    }
    
    /**
     * Get realistic tracking updates for existing orders
     */
    public function addRealisticTracking(Order $order)
    {
        // Clear existing tracking except the first one
        $firstTracking = $order->tracking()->oldest('tracked_at')->first();
        $order->tracking()->where('id', '!=', $firstTracking->id)->delete();
        
        $baseTime = $firstTracking->tracked_at;
        
        // Add payment uploaded tracking (if payment proof exists)
        if ($order->payment_proof) {
            $paymentTime = $baseTime->copy()->addMinutes(rand(5, 30));
            $order->addTracking(
                'payment_uploaded',
                'Bukti Pembayaran Diunggah',
                'Bukti pembayaran telah diunggah dan pembayaran dikonfirmasi.',
                null,
                null,
                $paymentTime
            );
            $baseTime = $paymentTime;
        }
        
        // Add confirmed tracking
        $confirmedTime = $baseTime->copy()->addMinutes(rand(10, 60));
        $order->addTracking(
            'confirmed',
            'Pembayaran Dikonfirmasi',
            'Pembayaran telah dikonfirmasi dan pesanan mulai diproses.',
            null,
            null,
            $confirmedTime
        );
        
        // Add processing tracking
        $processingTime = $confirmedTime->copy()->addHours(rand(1, 3));
        $order->addTracking(
            'processing',
            'Pesanan Sedang Diproses',
            'Tim kami sedang menyiapkan pesanan Anda dengan teliti.',
            'Gudang Avflowril',
            null,
            $processingTime
        );
        
        // Add packed tracking
        $packedTime = $processingTime->copy()->addHours(rand(2, 6));
        $order->addTracking(
            'packed',
            'Pesanan Dikemas',
            'Pesanan Anda telah selesai dikemas dan siap untuk dikirim.',
            'Gudang Avflowril',
            null,
            $packedTime
        );
        
        // Add shipped tracking
        $shippedTime = $packedTime->copy()->addHours(rand(1, 4));
        $courierServices = ['JNE', 'J&T Express', 'SiCepat', 'AnterAja'];
        $selectedCourier = $courierServices[array_rand($courierServices)];
        $trackingNumber = $this->generateTrackingNumber();
        
        $order->addTracking(
            'shipped',
            'Pesanan Dikirim',
            "Pesanan Anda telah dikirim melalui {$selectedCourier} dengan nomor resi: {$trackingNumber}",
            'Sorting Center Jakarta',
            [
                'courier' => $selectedCourier,
                'tracking_number' => $trackingNumber,
                'estimated_delivery' => $shippedTime->copy()->addDays(rand(2, 5))->format('Y-m-d')
            ],
            $shippedTime
        );
        
        // Update order status and timestamps
        $order->update([
            'status' => 'shipped',
            'shipped_at' => $shippedTime,
            'payment_status' => 'paid'
        ]);
        
        Log::info('Realistic tracking added for order', [
            'order_id' => $order->id,
            'order_number' => $order->order_number
        ]);
    }
}