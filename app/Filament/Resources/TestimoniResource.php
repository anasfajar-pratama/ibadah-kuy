<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimoniResource\Pages;
use App\Models\Paket;
use App\Models\Testimoni;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimoniResource extends Resource
{
    protected static ?string $model = Testimoni::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Testimoni';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('nama')->label('Nama Jamaah')->required(),
                Forms\Components\TextInput::make('asal_kota')->label('Asal Kota'),
            ]),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Select::make('paket_id')->label('Paket')
                    ->options(Paket::aktif()->pluck('nama', 'id'))->nullable(),
                Forms\Components\Select::make('rating')->label('Rating')
                    ->options([1 => '1 Bintang', 2 => '2 Bintang', 3 => '3 Bintang', 4 => '4 Bintang', 5 => '5 Bintang'])
                    ->default(5),
            ]),
            Forms\Components\Textarea::make('isi')->label('Isi Testimoni')->required()->rows(4),
            Forms\Components\FileUpload::make('foto')->label('Foto Jamaah')->image()->directory('testimoni')->maxSize(2048),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('tahun')->label('Tahun')->numeric(),
                Forms\Components\Toggle::make('is_featured')->label('Featured'),
                Forms\Components\Toggle::make('is_aktif')->label('Aktif')->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto_url')->label('Foto')->circular()
                    ->defaultImageUrl(asset('images/placeholder/testimoni-default.jpg')),
                Tables\Columns\TextColumn::make('nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('asal_kota')->label('Kota'),
                Tables\Columns\TextColumn::make('paket.nama')->label('Paket'),
                Tables\Columns\TextColumn::make('rating')->label('Rating')->formatStateUsing(fn($s) => str_repeat('★', $s)),
                Tables\Columns\TextColumn::make('isi')->label('Testimoni')->limit(60),
                Tables\Columns\IconColumn::make('is_featured')->label('Featured')->boolean(),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTestimonis::route('/'),
            'create' => Pages\CreateTestimoni::route('/create'),
            'edit'   => Pages\EditTestimoni::route('/{record}/edit'),
        ];
    }
}
