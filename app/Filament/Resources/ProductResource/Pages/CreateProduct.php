<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): string
    {
        return 'Tambah Produk Baru';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Produk berhasil ditambahkan')
            ->body('Produk baru telah berhasil ditambahkan ke sistem.');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate SKU if not provided
        if (empty($data['sku'])) {
            $data['sku'] = 'PRD-' . strtoupper(substr($data['category'], 0, 3)) . '-' . time();
        }

        return $data;
    }
}