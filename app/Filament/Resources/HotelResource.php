<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Models\Hotel;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Hotel';
    protected static ?string $navigationGroup = 'Produk & Jadwal';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Hotel')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')->label('Slug')->required()->unique(ignoreRecord: true),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Select::make('lokasi')->label('Lokasi')
                    ->options(['makkah' => 'Makkah Al-Mukarramah', 'madinah' => 'Madinah Al-Munawwarah'])->required(),
                Forms\Components\Select::make('bintang')->label('Bintang')
                    ->options([3 => '3 Bintang', 4 => '4 Bintang', 5 => '5 Bintang'])->default(3),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('jarak_ke_masjid')->label('Jarak ke Masjid')->required(),
                Forms\Components\TextInput::make('alamat')->label('Alamat'),
            ]),
            Forms\Components\Textarea::make('deskripsi')->label('Deskripsi')->rows(3),
            Forms\Components\Repeater::make('fasilitas')->label('Fasilitas Hotel')
                ->schema([Forms\Components\TextInput::make('item')->label('Fasilitas')->required()])
                ->addActionLabel('Tambah Fasilitas'),
            Forms\Components\FileUpload::make('gambar')
                ->label('Foto Utama')->image()->directory('hotel')->imageEditor()->maxSize(5120)
                ->helperText('Dikompres otomatis.')
                ->saveUploadedFileUsing(function ($file) {
                    $result = app(ImageService::class)->uploadWithThumbnail($file, 'hotel');
                    session(['last_thumbnail' => $result['gambar_thumbnail']]);
                    return $result['gambar'];
                }),
            Forms\Components\Hidden::make('gambar_thumbnail'),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Toggle::make('is_aktif')->label('Aktif')->default(true),
                Forms\Components\TextInput::make('urutan')->label('Urutan')->numeric()->default(0),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar_url')->label('Foto')->width(60)->height(45)
                    ->defaultImageUrl(asset('images/placeholder/hotel-thumb.jpg')),
                Tables\Columns\TextColumn::make('nama')->label('Nama Hotel')->searchable(),
                Tables\Columns\BadgeColumn::make('lokasi')->label('Lokasi')
                    ->colors(['warning' => 'makkah', 'success' => 'madinah'])
                    ->formatStateUsing(fn($s) => $s === 'makkah' ? 'Makkah' : 'Madinah'),
                Tables\Columns\TextColumn::make('bintang')->label('Bintang')->formatStateUsing(fn($s) => str_repeat('★', $s)),
                Tables\Columns\TextColumn::make('jarak_ke_masjid')->label('Jarak ke Masjid'),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('lokasi')->options(['makkah' => 'Makkah', 'madinah' => 'Madinah']),
                Tables\Filters\SelectFilter::make('bintang')->options([3 => '3 Bintang', 4 => '4 Bintang', 5 => '5 Bintang']),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit'   => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
