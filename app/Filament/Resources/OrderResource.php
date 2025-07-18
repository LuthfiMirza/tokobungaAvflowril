<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Manajemen Pesanan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesanan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('order_number')
                                    ->label('Nomor Pesanan')
                                    ->required()
                                    ->unique(Order::class, 'order_number', ignoreRecord: true),

                                Select::make('user_id')
                                    ->label('Pelanggan')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->label('Status Pesanan')
                                    ->required()
                                    ->options([
                                        'pending' => 'Menunggu',
                                        'processing' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'delivered' => 'Terkirim',
                                        'cancelled' => 'Dibatalkan',
                                    ])
                                    ->default('pending'),

                                Select::make('payment_status')
                                    ->label('Status Pembayaran')
                                    ->required()
                                    ->options([
                                        'pending' => 'Menunggu',
                                        'paid' => 'Lunas',
                                        'failed' => 'Gagal',
                                        'refunded' => 'Dikembalikan',
                                    ])
                                    ->default('pending'),
                            ]),

                        TextInput::make('payment_method')
                            ->label('Metode Pembayaran'),

                        FileUpload::make('payment_proof')
                            ->label('Bukti Pembayaran')
                            ->directory('payment-proofs')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->maxSize(5120) // 5MB
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Detail Harga')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp'),

                                TextInput::make('tax_amount')
                                    ->label('Pajak')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('shipping_amount')
                                    ->label('Ongkos Kirim')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),

                                TextInput::make('discount_amount')
                                    ->label('Diskon')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->default(0),
                            ]),

                        TextInput::make('total_amount')
                            ->label('Total')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                    ]),

                Section::make('Tanggal Penting')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DateTimePicker::make('shipped_at')
                                    ->label('Tanggal Dikirim'),

                                DateTimePicker::make('delivered_at')
                                    ->label('Tanggal Terkirim'),
                            ]),
                    ]),

                Section::make('Catatan')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan Pesanan')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. Pesanan')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Guest'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'processing',
                        'primary' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Terkirim',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),

                BadgeColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                        'info' => 'refunded',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'paid' => 'Lunas',
                        'failed' => 'Gagal',
                        'refunded' => 'Dikembalikan',
                        default => $state,
                    }),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                BadgeColumn::make('payment_proof')
                    ->label('Bukti Bayar')
                    ->formatStateUsing(fn ($state): string => $state ? 'Ada' : 'Belum')
                    ->colors([
                        'success' => fn ($state): bool => !empty($state),
                        'warning' => fn ($state): bool => empty($state),
                    ])
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('orderItems_count')
                    ->label('Jumlah Item')
                    ->counts('orderItems')
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('shipped_at')
                    ->label('Tanggal Kirim')
                    ->dateTime('d M Y')
                    ->placeholder('Belum dikirim')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('delivered_at')
                    ->label('Tanggal Terkirim')
                    ->dateTime('d M Y')
                    ->placeholder('Belum terkirim')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'pending' => 'Menunggu',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Terkirim',
                        'cancelled' => 'Dibatalkan',
                    ]),

                SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Menunggu',
                        'paid' => 'Lunas',
                        'failed' => 'Gagal',
                        'refunded' => 'Dikembalikan',
                    ]),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                // Konfirmasi Pesanan Action
                Action::make('confirm_order')
                    ->label('Konfirmasi Pesanan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->status === 'pending' && $record->payment_status === 'paid')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin mengkonfirmasi pesanan ini? Status akan berubah menjadi "Diproses".')
                    ->modalSubmitActionLabel('Ya, Konfirmasi')
                    ->action(function (Order $record): void {
                        $record->update([
                            'status' => 'processing',
                        ]);
                        
                        Notification::make()
                            ->title('Pesanan Dikonfirmasi')
                            ->body("Pesanan {$record->order_number} berhasil dikonfirmasi.")
                            ->success()
                            ->send();
                    }),

                // Lihat Bukti Bayar Action
                Action::make('view_payment_proof')
                    ->label('Lihat Bukti Bayar')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->visible(fn (Order $record): bool => !empty($record->payment_proof))
                    ->modalHeading('Bukti Pembayaran')
                    ->modalContent(function (Order $record) {
                        if (empty($record->payment_proof)) {
                            return view('filament.modals.no-payment-proof');
                        }
                        
                        $fileExtension = pathinfo($record->payment_proof, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        
                        if ($isImage) {
                            return view('filament.modals.payment-proof-image', [
                                'imageUrl' => Storage::url($record->payment_proof),
                                'orderNumber' => $record->order_number
                            ]);
                        } else {
                            return view('filament.modals.payment-proof-file', [
                                'fileUrl' => Storage::url($record->payment_proof),
                                'fileName' => basename($record->payment_proof),
                                'orderNumber' => $record->order_number
                            ]);
                        }
                    })
                    ->modalWidth('lg'),

                // Progress Pesanan Action
                Action::make('update_progress')
                    ->label('Update Progress')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->visible(fn (Order $record): bool => in_array($record->status, ['pending', 'processing', 'shipped']))
                    ->form(function (Order $record) {
                        $statusOptions = [];
                        
                        // Dynamic status options based on current status
                        if ($record->status === 'pending') {
                            $statusOptions = [
                                'processing' => 'Diproses',
                                'cancelled' => 'Dibatalkan',
                            ];
                        } elseif ($record->status === 'processing') {
                            $statusOptions = [
                                'shipped' => 'Dikirim',
                                'cancelled' => 'Dibatalkan',
                            ];
                        } elseif ($record->status === 'shipped') {
                            $statusOptions = [
                                'delivered' => 'Terkirim',
                            ];
                        }
                        
                        return [
                            Select::make('status')
                                ->label('Status Pesanan')
                                ->options($statusOptions)
                                ->required(),
                            DateTimePicker::make('shipped_at')
                                ->label('Tanggal Dikirim')
                                ->visible(fn (callable $get) => $get('status') === 'shipped'),
                            DateTimePicker::make('delivered_at')
                                ->label('Tanggal Terkirim')
                                ->visible(fn (callable $get) => $get('status') === 'delivered'),
                        ];
                    })
                    ->action(function (Order $record, array $data): void {
                        $updateData = ['status' => $data['status']];
                        
                        if ($data['status'] === 'shipped' && isset($data['shipped_at'])) {
                            $updateData['shipped_at'] = $data['shipped_at'];
                        }
                        
                        if ($data['status'] === 'delivered' && isset($data['delivered_at'])) {
                            $updateData['delivered_at'] = $data['delivered_at'];
                        }
                        
                        $record->update($updateData);
                        
                        $statusLabel = match($data['status']) {
                            'processing' => 'Diproses',
                            'shipped' => 'Dikirim',
                            'delivered' => 'Terkirim',
                            default => $data['status']
                        };
                        
                        Notification::make()
                            ->title('Progress Diperbarui')
                            ->body("Status pesanan {$record->order_number} berhasil diubah menjadi {$statusLabel}.")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $pendingCount = static::getModel()::where('status', 'pending')->count();
        return $pendingCount > 0 ? 'warning' : 'success';
    }
}