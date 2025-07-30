<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Pesanan')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Daftar Pesanan';
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge($this->getModel()::count()),
            
            'pending' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge($this->getModel()::where('status', 'pending')->count())
                ->badgeColor('warning'),
            
            'processing' => Tab::make('Diproses')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'processing'))
                ->badge($this->getModel()::where('status', 'processing')->count())
                ->badgeColor('info'),
            
            'shipped' => Tab::make('Dikirim')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'shipped'))
                ->badge($this->getModel()::where('status', 'shipped')->count())
                ->badgeColor('primary'),
            
            'delivered' => Tab::make('Diterima')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'delivered'))
                ->badge($this->getModel()::where('status', 'delivered')->count())
                ->badgeColor('success'),
            
            'cancelled' => Tab::make('Dibatalkan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'cancelled'))
                ->badge($this->getModel()::where('status', 'cancelled')->count())
                ->badgeColor('danger'),
        ];
    }
}