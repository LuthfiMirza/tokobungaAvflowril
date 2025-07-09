<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderTestSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create a test user if none exists
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Create test orders with different statuses
        $orders = [
            [
                'order_number' => 'ORD-' . date('Ymd') . '-0001',
                'user_id' => $user->id,
                'status' => 'pending',
                'payment_status' => 'paid',
                'total_amount' => 150000,
                'subtotal' => 150000,
                'payment_method' => 'Bank Transfer',
                'payment_proof' => 'payment-proofs/sample-payment-proof.jpg',
                'notes' => 'Test order with payment proof',
            ],
            [
                'order_number' => 'ORD-' . date('Ymd') . '-0002',
                'user_id' => $user->id,
                'status' => 'processing',
                'payment_status' => 'paid',
                'total_amount' => 250000,
                'subtotal' => 250000,
                'payment_method' => 'E-Wallet',
                'notes' => 'Test order in processing',
            ],
            [
                'order_number' => 'ORD-' . date('Ymd') . '-0003',
                'user_id' => $user->id,
                'status' => 'shipped',
                'payment_status' => 'paid',
                'total_amount' => 350000,
                'subtotal' => 350000,
                'payment_method' => 'Credit Card',
                'shipped_at' => now()->subDays(1),
                'notes' => 'Test order shipped',
            ],
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }

        $this->command->info('Test orders created successfully!');
    }
}