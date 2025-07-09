<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Services\OrderTrackingService;

class AddRealisticTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:add-realistic-tracking {order-number : Order number to add realistic tracking}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add realistic tracking data to an existing order';

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
        $orderNumber = $this->argument('order-number');
        
        $order = Order::where('order_number', $orderNumber)->first();
        
        if (!$order) {
            $this->error("Order {$orderNumber} not found.");
            return 1;
        }
        
        $this->info("Adding realistic tracking data for order: {$orderNumber}");
        
        // Confirm before proceeding
        if (!$this->confirm('This will replace existing tracking data. Continue?')) {
            $this->info('Operation cancelled.');
            return 0;
        }
        
        $this->trackingService->addRealisticTracking($order);
        
        $this->info("Realistic tracking data added successfully!");
        $this->info("Order status: {$order->fresh()->status}");
        $this->info("Tracking entries: {$order->fresh()->tracking()->count()}");
        
        return 0;
    }
}