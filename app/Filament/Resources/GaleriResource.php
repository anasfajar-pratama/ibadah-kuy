<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Models\Galeri;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Galeri Foto';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('judul')->label('Judul')->required(),
                Forms\Components\Select::make('kategori')->label('Kategori')
                    ->options([
                        'ibadah' => 'Ibadah',
                        'hotel' => 'Hotel',
                        'transportasi' => 'Transportasi',
                        'kuliner' => 'Kuliner',
                        'wisata' => 'Wisata',
                        'lainnya' => 'Lainnya',
                    ])->required(),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('lokasi')->label('Lokasi'),
                Forms\Components\TextInput::make('tahun')->label('Tahun')->numeric(),
            ]),
            Forms\Components\Textarea::make('deskripsi')->label('Deskripsi'),
            Forms\Components\FileUpload::make('gambar')
                ->label('Foto')
                ->image()
                ->directory('galeri')
                ->imageEditor()
                ->maxSize(5120)
                ->helperText('Maks 5MB. Dikompres otomatis.')
                ->saveUploadedFileUsing(function ($file) {
                    $result = app(ImageService::class)->uploadWithThumbnail($file, 'galeri');
                    session(['last_thumbnail' => $result['gambar_thumbnail']]);
                    return $result['gambar'];
                }),
            Forms\Components\Hidden::make('gambar_thumbnail'),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\Toggle::make('is_featured')->label('Featured'),
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
                    ->defaultImageUrl(asset('images/placeholder/galeri-thumb.jpg')),
                Tables\Columns\TextColumn::make('judul')->label('Judul')->searchable(),
                Tables\Columns\BadgeColumn::make('kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('lokasi')->label('Lokasi'),
                Tables\Columns\TextColumn::make('tahun')->label('Tahun'),
                Tables\Columns\IconColumn::make('is_featured')->label('Featured')->boolean(),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')->options([
                    'ibadah' => 'Ibadah', 'hotel' => 'Hotel', 'transportasi' => 'Transportasi',
                    'kuliner' => 'Kuliner', 'wisata' => 'Wisata', 'lainnya' => 'Lainnya',
                ]),
                Tables\Filters\TernaryFilter::make('is_aktif')->label('Aktif'),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit'   => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}
