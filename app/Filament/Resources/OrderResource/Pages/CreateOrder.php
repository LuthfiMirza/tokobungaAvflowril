<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    public function getTitle(): string
    {
        return 'Tambah Pesanan Baru';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Pesanan berhasil ditambahkan')
            ->body('Pesanan baru telah berhasil ditambahkan ke sistem.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate order number if not provided
        if (empty($data['order_number'])) {
            $data['order_number'] = 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        return $data;
    }
}