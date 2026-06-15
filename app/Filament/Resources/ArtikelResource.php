<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Models\Artikel;
use App\Services\ImageService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Artikel & Blog';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $pluralModelLabel = 'Artikel & Blog';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('judul')
                        ->label('Judul Artikel')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->label('Slug URL')->required()->unique(ignoreRecord: true),
                    Forms\Components\Select::make('kategori')
                        ->label('Kategori')
                        ->options([
                            'tips' => 'Tips & Trik',
                            'panduan' => 'Panduan Ibadah',
                            'info_visa' => 'Info Visa',
                            'info_kesehatan' => 'Info Kesehatan',
                            'berita' => 'Berita',
                            'lainnya' => 'Lainnya',
                        ])
                        ->required(),
                    Forms\Components\Textarea::make('ringkasan')->label('Ringkasan')->rows(3),
                    Forms\Components\RichEditor::make('konten')->label('Isi Artikel')->required()->columnSpanFull(),
                ])->columnSpan(2),

                Forms\Components\Section::make('Publikasi')->schema([
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options(['draft' => 'Draft', 'publish' => 'Publish'])
                        ->default('draft'),
                    Forms\Components\DateTimePicker::make('published_at')->label('Tanggal Publish'),
                    Forms\Components\TextInput::make('penulis')->label('Penulis'),
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Gambar Utama')
                        ->image()
                        ->directory('artikel')
                        ->imageEditor()
                        ->maxSize(5120)
                        ->helperText('Maks 5MB. Dikompres otomatis.')
                        ->saveUploadedFileUsing(function ($file) {
                            $result = app(ImageService::class)->uploadWithThumbnail($file, 'artikel');
                            session(['last_thumbnail' => $result['gambar_thumbnail']]);
                            return $result['gambar'];
                        }),
                    Forms\Components\Hidden::make('gambar_thumbnail'),
                ])->columnSpan(1),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar_url')->label('Gambar')->width(60)->height(45)
                    ->defaultImageUrl(asset('images/placeholder/artikel-thumb.jpg')),
                Tables\Columns\TextColumn::make('judul')->label('Judul')->searchable()->limit(50),
                Tables\Columns\BadgeColumn::make('kategori')->label('Kategori')
                    ->formatStateUsing(fn($s) => match($s) {
                        'tips' => 'Tips', 'panduan' => 'Panduan', 'info_visa' => 'Visa',
                        'info_kesehatan' => 'Kesehatan', 'berita' => 'Berita', default => 'Lainnya'
                    }),
                Tables\Columns\BadgeColumn::make('status')->label('Status')
                    ->colors(['warning' => 'draft', 'success' => 'publish']),
                Tables\Columns\TextColumn::make('published_at')->label('Tanggal Publish')->dateTime('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('views')->label('Views')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(['draft' => 'Draft', 'publish' => 'Publish']),
                Tables\Filters\SelectFilter::make('kategori')->options([
                    'tips' => 'Tips', 'panduan' => 'Panduan', 'info_visa' => 'Info Visa',
                    'info_kesehatan' => 'Info Kesehatan', 'berita' => 'Berita', 'lainnya' => 'Lainnya',
                ]),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit'   => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
