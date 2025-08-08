<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get first user (create one if doesn't exist)
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'phone' => '+6281384303654',
                'address' => 'jl.moh kahfi 1 jl.timbul rt07/04 no.44 kel.cipedek kec.jagakarsa,jaksel sekitaran choir expres,gg sebrang warung nasi pasundan'
            ]);
        }

        // Get some products
        $products = Product::take(3)->get();

        // Create sample orders
        $orders = [
            [
                'order_number' => 'ORD-20250707-0001',
                'status' => 'delivered',
                'payment_status' => 'paid',
                'payment_method' => 'bank_transfer',
                'total_amount' => 750000,
                'subtotal' => 700000,
                'shipping_amount' => 25000,
                'discount_amount' => 0,
                'notes' => 'Mohon dikemas dengan rapi',
                'delivered_at' => now()->subDays(2),
                'shipped_at' => now()->subDays(3),
            ],
            [
                'order_number' => 'ORD-20250707-0002',
                'status' => 'shipped',
                'payment_status' => 'paid',
                'payment_method' => 'e_wallet',
                'total_amount' => 520000,
                'subtotal' => 500000,
                'shipping_amount' => 20000,
                'discount_amount' => 0,
                'notes' => null,
                'shipped_at' => now()->subDays(1),
            ],
            [
                'order_number' => 'ORD-20250707-0003',
                'status' => 'processing',
                'payment_status' => 'paid',
                'payment_method' => 'bank_transfer',
                'total_amount' => 380000,
                'subtotal' => 350000,
                'shipping_amount' => 30000,
                'discount_amount' => 0,
                'notes' => 'Untuk hadiah ulang tahun',
            ],
            [
                'order_number' => 'ORD-20250707-0004',
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cod',
                'total_amount' => 305000,
                'subtotal' => 280000,
                'shipping_amount' => 20000,
                'discount_amount' => 0,
                'notes' => null,
            ],
        ];

        foreach ($orders as $index => $orderData) {
            $orderData['user_id'] = $user->id;
            $orderData['shipping_address'] = [
                'name' => $user->name,
                'phone' => $user->phone,
                'address' => $user->address,
                'city' => 'Jakarta',
                'postal_code' => '12345',
            ];
            $orderData['billing_address'] = $orderData['shipping_address'];

            $order = Order::create($orderData);

            // Add order items
            $itemCount = rand(1, 3);
            $usedProducts = [];
            
            for ($i = 0; $i < $itemCount; $i++) {
                $availableProducts = $products->whereNotIn('id', $usedProducts);
                if ($availableProducts->isEmpty()) {
                    break;
                }
                
                $product = $availableProducts->random();
                $usedProducts[] = $product->id;
                
                $quantity = rand(1, 2);
                $price = $product->sale_price ?: $product->price;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $price * $quantity,
                ]);
            }

            // Add tracking based on status
            $this->addTrackingForOrder($order);
        }
    }

    private function addTrackingForOrder($order)
    {
        $baseTime = $order->created_at;
        
        // Always add initial tracking
        $order->addTracking(
            'pending',
            'Pesanan Diterima',
            'Pesanan Anda telah diterima dan menunggu konfirmasi pembayaran.',
            null,
            null,
            $baseTime
        );

        if (in_array($order->status, ['processing', 'shipped', 'delivered'])) {
            $order->addTracking(
                'confirmed',
                'Pesanan Dikonfirmasi',
                'Pembayaran telah dikonfirmasi dan pesanan akan segera diproses.',
                null,
                null,
                $baseTime->addHours(2)
            );

            $order->addTracking(
                'processing',
                'Pesanan Sedang Diproses',
                'Tim kami sedang mempersiapkan pesanan Anda.',
                'Warehouse Jakarta',
                null,
                $baseTime->addHours(6)
            );
        }

        if (in_array($order->status, ['shipped', 'delivered'])) {
            $order->addTracking(
                'packed',
                'Pesanan Dikemas',
                'Pesanan Anda telah dikemas dan siap untuk dikirim.',
                'Warehouse Jakarta',
                null,
                $baseTime->addDay()
            );

            $order->addTracking(
                'shipped',
                'Pesanan Dikirim',
                'Pesanan Anda telah dikirim dan dalam perjalanan.',
                'Jakarta Distribution Center',
                ['courier' => 'JNE', 'tracking_number' => 'JNE' . rand(100000, 999999)],
                $order->shipped_at ?: $baseTime->addDay()->addHours(2)
            );
        }

        if ($order->status === 'delivered') {
            $order->addTracking(
                'out_for_delivery',
                'Dalam Perjalanan',
                'Pesanan Anda sedang dalam perjalanan untuk pengiriman.',
                'Jakarta Pusat',
                null,
                $order->delivered_at->subHours(2)
            );

            $order->addTracking(
                'delivered',
                'Pesanan Diterima',
                'Pesanan Anda telah berhasil diterima.',
                $order->shipping_address['address'],
                ['received_by' => $order->shipping_address['name']],
                $order->delivered_at
            );
        }
    }
}
