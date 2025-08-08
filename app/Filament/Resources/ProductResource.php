<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Manajemen Produk';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Produk')
                    ->description('Masukkan detail dasar produk')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', \Illuminate\Support\Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Product::class, 'slug', ignoreRecord: true)
                                    ->rules(['alpha_dash']),
                            ]),

                        RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),

                        Textarea::make('short_description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Harga & Stok')
                    ->description('Atur harga dan stok produk')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Harga Normal')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->step(1000),

                                TextInput::make('sale_price')
                                    ->label('Harga Diskon')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->step(1000)
                                    ->lte('price'),

                                TextInput::make('stock_quantity')
                                    ->label('Stok')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->unique(Product::class, 'sku', ignoreRecord: true)
                                    ->maxLength(100),

                                TextInput::make('weight')
                                    ->label('Berat (gram)')
                                    ->numeric()
                                    ->suffix('gram'),
                            ]),
                    ]),

                Section::make('Kategori & Status')
                    ->description('Pilih kategori dan status produk')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('category')
                                    ->label('Kategori')
                                    ->required()
                                    ->options([
                                        'satin' => 'Bucket Satin',
                                        'money' => 'Bucket Money',
                                        'kawat' => 'Bucket Kawat',
                                        'glitter' => 'Bucket Glitter',
                                        'custom' => 'Bucket Custom',
                                        'special' => 'Bucket Special',
                                    ]),

                                Select::make('status')
                                    ->label('Status')
                                    ->required()
                                    ->options([
                                        'active' => 'Aktif',
                                        'inactive' => 'Tidak Aktif',
                                        'draft' => 'Draft',
                                    ])
                                    ->default('active'),

                                Toggle::make('featured')
                                    ->label('Produk Unggulan')
                                    ->default(false),
                            ]),
                    ]),

                Section::make('Gambar Produk')
                    ->description('Upload gambar produk (maksimal 5 gambar)')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Gambar')
                            ->image()
                            ->multiple()
                            ->maxFiles(5)
                            ->directory('products')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),

                Section::make('SEO')
                    ->description('Optimasi untuk mesin pencari')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->rows(3),

                        TextInput::make('dimensions')
                            ->label('Dimensi (PxLxT)')
                            ->placeholder('25cm x 30cm x 15cm'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image')
                    ->label('Gambar')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('/assets/images/product/default.jpg'))
                    ->getStateUsing(function (Product $record): ?string {
                        if ($record->images && is_array($record->images) && count($record->images) > 0) {
                            $imagePath = $record->images[0];
                            
                            // Handle different image path formats
                            if (str_starts_with($imagePath, 'products/')) {
                                // Filament uploaded images
                                return url('storage/' . $imagePath);
                            } elseif (str_starts_with($imagePath, 'assets/')) {
                                // Seeded images with full path
                                return url($imagePath);
                            } elseif (str_starts_with($imagePath, 'images/')) {
                                // Seeded images with partial path
                                return url('assets/' . $imagePath);
                            } else {
                                // Fallback for other formats
                                return url('storage/' . $imagePath);
                            }
                        }
                        return null;
                    }),

                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'satin' => 'info',
                        'money' => 'success',
                        'kawat' => 'warning',
                        'glitter' => 'danger',
                        'custom' => 'primary',
                        'special' => 'secondary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'satin' => 'Bucket Satin',
                        'money' => 'Bucket Money',
                        'kawat' => 'Bucket Kawat',
                        'glitter' => 'Bucket Glitter',
                        'custom' => 'Bucket Custom',
                        'special' => 'Bucket Special',
                        default => $state,
                    }),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('sale_price')
                    ->label('Harga Diskon')
                    ->money('IDR')
                    ->placeholder('Tidak ada diskon'),

                TextColumn::make('stock_quantity')
                    ->label('Stok')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'draft',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'draft' => 'Draft',
                        default => $state,
                    }),

                BooleanColumn::make('featured')
                    ->label('Unggulan')
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'satin' => 'Bucket Satin',
                        'money' => 'Bucket Money',
                        'kawat' => 'Bucket Kawat',
                        'glitter' => 'Bucket Glitter',
                        'custom' => 'Bucket Custom',
                        'special' => 'Bucket Special',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'draft' => 'Draft',
                    ]),

                TernaryFilter::make('featured')
                    ->label('Produk Unggulan')
                    ->placeholder('Semua produk')
                    ->trueLabel('Hanya unggulan')
                    ->falseLabel('Bukan unggulan'),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }
}