<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembimbingResource\Pages;
use App\Models\Pembimbing;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PembimbingResource extends Resource
{
    protected static ?string $model = Pembimbing::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Pembimbing';
    protected static ?string $navigationGroup = 'Produk & Jadwal';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('nama')->label('Nama')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')->label('Slug')->unique(ignoreRecord: true),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('gelar')->label('Gelar (Ust./Dr./dll)'),
                Forms\Components\TextInput::make('jabatan')->label('Jabatan'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('pengalaman_tahun')->label('Pengalaman (Tahun)')->numeric(),
                Forms\Components\TextInput::make('total_jamaah')->label('Total Jamaah Dibimbing')->numeric(),
            ]),
            Forms\Components\Textarea::make('bio')->label('Bio / Profil')->rows(3),
            Forms\Components\Textarea::make('keahlian')->label('Keahlian')->rows(2),
            Forms\Components\FileUpload::make('foto')
                ->label('Foto')->image()->directory('pembimbing')->imageEditor()->maxSize(3072)
                ->saveUploadedFileUsing(function ($file) {
                    $result = app(ImageService::class)->uploadWithThumbnail($file, 'pembimbing');
                    session(['last_thumbnail' => $result['gambar_thumbnail']]);
                    return $result['gambar'];
                }),
            Forms\Components\Hidden::make('foto_thumbnail'),
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
                Tables\Columns\ImageColumn::make('foto_url')->label('Foto')->circular()
                    ->defaultImageUrl(asset('images/placeholder/pembimbing-thumb.jpg')),
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('jabatan')->label('Jabatan'),
                Tables\Columns\TextColumn::make('pengalaman_tahun')->label('Pengalaman')->suffix(' tahun'),
                Tables\Columns\TextColumn::make('total_jamaah')->label('Jml. Jamaah'),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPembimbings::route('/'),
            'create' => Pages\CreatePembimbing::route('/create'),
            'edit'   => Pages\EditPembimbing::route('/{record}/edit'),
        ];
    }
}
