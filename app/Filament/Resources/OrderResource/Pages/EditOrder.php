<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Lihat Detail')
                ->icon('heroicon-o-eye'),
            Actions\DeleteAction::make()
                ->label('Hapus Pesanan')
                ->icon('heroicon-o-trash'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Pesanan';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Pesanan berhasil diperbarui')
            ->body('Perubahan pesanan telah berhasil disimpan.');
    }
}