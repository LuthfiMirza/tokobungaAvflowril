<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $lowStockProducts = Product::where('stock_quantity', '<=', 10)->count();

        return [
            Stat::make('Total Pesanan', $totalOrders)
                ->description('Semua pesanan')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Dari pesanan yang sudah dibayar')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Pesanan Menunggu', $pendingOrders)
                ->description('Perlu diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Total Produk', $totalProducts)
                ->description('Produk aktif')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),

            Stat::make('Stok Rendah', $lowStockProducts)
                ->description('Produk dengan stok ≤ 10')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStockProducts > 0 ? 'danger' : 'success'),
        ];
    }
}