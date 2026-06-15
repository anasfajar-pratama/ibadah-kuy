<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Banner / Slider';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('judul')->label('Judul Banner')->required(),
            Forms\Components\Textarea::make('subjudul')->label('Sub Judul')->rows(2),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('link')->label('Link URL'),
                Forms\Components\TextInput::make('teks_tombol')->label('Teks Tombol'),
            ]),
            Forms\Components\FileUpload::make('gambar')
                ->label('Gambar Banner')
                ->image()
                ->directory('banner')
                ->imageEditor()
                ->maxSize(5120)
                ->helperText('Rekomendasi: 1920x600px. Maks 5MB. Dikompres otomatis.')
                ->saveUploadedFileUsing(function ($file) {
                    $result = app(ImageService::class)->uploadWithThumbnail($file, 'banner');
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
                Tables\Columns\ImageColumn::make('gambar_url')->label('Gambar')->width(100)->height(40)
                    ->defaultImageUrl(asset('images/placeholder/banner-default.jpg')),
                Tables\Columns\TextColumn::make('judul')->label('Judul')->searchable(),
                Tables\Columns\TextColumn::make('teks_tombol')->label('Tombol'),
                Tables\Columns\TextColumn::make('urutan')->label('Urutan')->sortable(),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->reorderable('urutan')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('urutan');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit'   => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
