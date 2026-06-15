<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'FAQ';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('kategori')->label('Kategori')
                ->options(['umum' => 'Umum', 'haji' => 'Haji', 'umrah' => 'Umrah', 'pembayaran' => 'Pembayaran', 'dokumen' => 'Dokumen', 'lainnya' => 'Lainnya'])
                ->required(),
            Forms\Components\TextInput::make('pertanyaan')->label('Pertanyaan')->required(),
            Forms\Components\Textarea::make('jawaban')->label('Jawaban')->required()->rows(4),
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
                Tables\Columns\TextColumn::make('kategori')->label('Kategori')->badge(),
                Tables\Columns\TextColumn::make('pertanyaan')->label('Pertanyaan')->searchable()->limit(60),
                Tables\Columns\TextColumn::make('jawaban')->label('Jawaban')->limit(50),
                Tables\Columns\TextColumn::make('urutan')->label('Urutan')->sortable(),
                Tables\Columns\IconColumn::make('is_aktif')->label('Aktif')->boolean(),
            ])
            ->filters([Tables\Filters\SelectFilter::make('kategori')->options(['umum' => 'Umum', 'haji' => 'Haji', 'umrah' => 'Umrah', 'pembayaran' => 'Pembayaran', 'dokumen' => 'Dokumen'])])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('urutan');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit'   => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
