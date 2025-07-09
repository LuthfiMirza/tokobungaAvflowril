<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Services\OrderTrackingService;

class UpdateOrderTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-tracking {--order-number= : Specific order number to update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto-update order tracking status based on time and payment status';

    protected $trackingService;

    public function __construct(OrderTrackingService $trackingService)
    {
        parent::__construct();
        $this->trackingService = $trackingService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orderNumber = $this->option('order-number');
        
        if ($orderNumber) {
            // Update specific order
            $order = Order::where('order_number', $orderNumber)->first();
            
            if (!$order) {
                $this->error("Order {$orderNumber} not found.");
                return 1;
            }
            
            $this->info("Updating tracking for order: {$orderNumber}");
            $this->trackingService->autoUpdateTracking($order);
            $this->info("Tracking updated successfully.");
            
        } else {
            // Update all active orders
            $orders = Order::whereNotIn('status', ['delivered', 'cancelled'])
                          ->with('tracking')
                          ->get();
            
            $this->info("Found {$orders->count()} orders to update.");
            
            $progressBar = $this->output->createProgressBar($orders->count());
            $progressBar->start();
            
            foreach ($orders as $order) {
                $this->trackingService->autoUpdateTracking($order);
                $progressBar->advance();
            }
            
            $progressBar->finish();
            $this->newLine();
            $this->info("All order tracking updated successfully.");
        }
        
        return 0;
    }
}