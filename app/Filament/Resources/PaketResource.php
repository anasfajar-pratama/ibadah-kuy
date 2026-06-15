<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketResource\Pages;
use App\Models\Paket;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationLabel = 'Paket';
    protected static ?string $navigationGroup = 'Produk & Jadwal';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Paket';
    protected static ?string $pluralModelLabel = 'Daftar Paket';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([

                Forms\Components\Tabs\Tab::make('Informasi Utama')->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Paket')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('jenis')
                            ->label('Jenis Paket')
                            ->options([
                                'haji_reguler' => 'Haji Reguler',
                                'haji_plus' => 'Haji Plus',
                                'haji_furoda' => 'Haji Furoda',
                                'umrah_reguler' => 'Umrah Reguler',
                                'umrah_plus' => 'Umrah Plus',
                                'umrah_ramadan' => 'Umrah Ramadan',
                                'umrah_custom' => 'Umrah Custom',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('harga')
                            ->label('Harga (Rp)')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),
                    ]),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('durasi_hari')
                            ->label('Durasi (Hari)')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('kuota')
                            ->label('Kuota')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('sisa_kursi')
                            ->label('Sisa Kursi')
                            ->numeric(),
                    ]),
                    Forms\Components\Textarea::make('deskripsi')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->required(),
                    Forms\Components\RichEditor::make('detail')
                        ->label('Detail Paket')
                        ->columnSpanFull(),
                ]),

                Forms\Components\Tabs\Tab::make('Penerbangan & Hotel')->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('maskapai')->label('Maskapai'),
                        Forms\Components\Select::make('kelas_penerbangan')
                            ->label('Kelas')
                            ->options(['Economy' => 'Economy', 'Business' => 'Business', 'First' => 'First Class'])
                            ->default('Economy'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hotel_makkah')->label('Hotel Makkah'),
                        Forms\Components\Select::make('bintang_hotel_makkah')
                            ->label('Bintang Hotel Makkah')
                            ->options(['3' => '3 Bintang', '4' => '4 Bintang', '5' => '5 Bintang']),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('hotel_madinah')->label('Hotel Madinah'),
                        Forms\Components\Select::make('bintang_hotel_madinah')
                            ->label('Bintang Hotel Madinah')
                            ->options(['3' => '3 Bintang', '4' => '4 Bintang', '5' => '5 Bintang']),
                    ]),
                ]),

                Forms\Components\Tabs\Tab::make('Fasilitas & Program')->schema([
                    Forms\Components\Repeater::make('fasilitas')
                        ->label('Fasilitas')
                        ->schema([
                            Forms\Components\TextInput::make('item')->label('Fasilitas')->required(),
                        ])
                        ->addActionLabel('Tambah Fasilitas')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('program')
                        ->label('Program Perjalanan')
                        ->schema([
                            Forms\Components\TextInput::make('hari')->label('Hari ke-'),
                            Forms\Components\TextInput::make('kegiatan')->label('Kegiatan'),
                        ])
                        ->addActionLabel('Tambah Program')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('syarat')
                        ->label('Persyaratan')
                        ->schema([
                            Forms\Components\TextInput::make('item')->label('Syarat')->required(),
                        ])
                        ->addActionLabel('Tambah Syarat')
                        ->columnSpanFull(),
                ]),

                Forms\Components\Tabs\Tab::make('Gambar')->schema([
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Gambar Utama')
                        ->image()
                        ->directory('paket')
                        ->imageEditor()
                        ->maxSize(5120)
                        ->helperText('Maks 5MB. Gambar akan dikompres otomatis.')
                        ->saveUploadedFileUsing(function ($file) {
                            $service = app(ImageService::class);
                            $result = $service->uploadWithThumbnail($file, 'paket');
                            // Simpan thumbnail ke field terpisah via session trick
                            session(['last_thumbnail' => $result['gambar_thumbnail']]);
                            return $result['gambar'];
                        }),
                    Forms\Components\Hidden::make('gambar_thumbnail'),
                ]),

                Forms\Components\Tabs\Tab::make('Pengaturan')->schema([
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\Toggle::make('is_featured')->label('Tampilkan di Unggulan'),
                        Forms\Components\Toggle::make('is_aktif')->label('Aktif')->default(true),
                        Forms\Components\TextInput::make('urutan')->label('Urutan Tampil')->numeric()->default(0),
                    ]),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar_url')
                    ->label('Foto')
                    ->width(60)->height(45)
                    ->defaultImageUrl(asset('images/placeholder/paket-thumb.jpg')),
                Tables\Columns\TextColumn::make('nama')->label('Nama Paket')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('jenis')
                    ->label('Jenis')
                    ->colors([
                        'warning' => fn($state) => str_starts_with($state, 'haji'),
                        'success' => fn($state) => str_starts_with($state, 'umrah'),
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'haji_reguler' => 'Haji Reguler',
                        'haji_plus' => 'Haji Plus',
                        'haji_furoda' => 'Haji Furoda',
                        'umrah_reguler' => 'Umrah Reguler',
                        'umrah_plus' => 'Umrah Plus',
                        'umrah_ramadan' => 'Umrah Ramadan',
                        'umrah_custom' => 'Umrah Custom',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('durasi_hari')->label('Durasi')->suffix(' Hari')->sortable(),
                Tables\Columns\TextColumn::make('sisa_kursi')->label('Sisa Kursi')->sortable(),
                Tables\Columns\IconColumn::make('is_featured')->label('Unggulan')->boolean(),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')->label('Jenis Paket')
                    ->options([
                        'haji_reguler' => 'Haji Reguler',
                        'haji_plus' => 'Haji Plus',
                        'haji_furoda' => 'Haji Furoda',
                        'umrah_reguler' => 'Umrah Reguler',
                        'umrah_plus' => 'Umrah Plus',
                        'umrah_ramadan' => 'Umrah Ramadan',
                        'umrah_custom' => 'Umrah Custom',
                    ]),
                Tables\Filters\TernaryFilter::make('is_aktif')->label('Status Aktif'),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Unggulan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('urutan');
    }

    public static function getRelationsManagers(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPakets::route('/'),
            'create' => Pages\CreatePaket::route('/create'),
            'edit'   => Pages\EditPaket::route('/{record}/edit'),
        ];
    }
}
