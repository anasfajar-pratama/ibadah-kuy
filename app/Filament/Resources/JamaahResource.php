<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JamaahResource\Pages;
use App\Models\Jamaah;
use App\Models\Paket;
use App\Models\Jadwal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Data Jamaah';
    protected static ?string $navigationGroup = 'Jamaah & Booking';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Jamaah';
    protected static ?string $pluralModelLabel = 'Data Jamaah';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([

                Forms\Components\Tabs\Tab::make('Data Pribadi')->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('nama_lengkap')->label('Nama Lengkap')->required(),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                            ->required(),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('nik')->label('NIK')->maxLength(20),
                        Forms\Components\TextInput::make('no_paspor')->label('No. Paspor'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('tempat_lahir')->label('Tempat Lahir'),
                        Forms\Components\DatePicker::make('tgl_lahir')->label('Tanggal Lahir'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('no_hp')->label('No. HP')->required(),
                        Forms\Components\TextInput::make('email')->label('Email')->email(),
                    ]),
                    Forms\Components\Textarea::make('alamat')->label('Alamat Lengkap'),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('kota')->label('Kota'),
                        Forms\Components\TextInput::make('provinsi')->label('Provinsi'),
                    ]),
                ]),

                Forms\Components\Tabs\Tab::make('Paket & Status')->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('paket_id')
                            ->label('Paket')
                            ->options(Paket::aktif()->pluck('nama', 'id'))
                            ->searchable(),
                        Forms\Components\Select::make('jadwal_id')
                            ->label('Jadwal')
                            ->options(fn(Forms\Get $get) =>
                                Jadwal::where('paket_id', $get('paket_id'))
                                    ->get()
                                    ->mapWithKeys(fn($j) => [$j->id => $j->tanggal_berangkat->format('d M Y') . ' - ' . $j->tanggal_kembali->format('d M Y')])
                            )
                            ->searchable(),
                    ]),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'daftar' => 'Mendaftar',
                                'konfirmasi' => 'Dikonfirmasi',
                                'berangkat' => 'Berangkat',
                                'selesai' => 'Selesai',
                                'batal' => 'Dibatalkan',
                            ])
                            ->default('daftar'),
                        Forms\Components\Select::make('status_dokumen')
                            ->label('Status Dokumen')
                            ->options([
                                'belum_lengkap' => 'Belum Lengkap',
                                'proses' => 'Sedang Diproses',
                                'lengkap' => 'Lengkap',
                            ])
                            ->default('belum_lengkap'),
                        Forms\Components\Select::make('status_pembayaran')
                            ->label('Status Pembayaran')
                            ->options([
                                'belum_bayar' => 'Belum Bayar',
                                'dp' => 'DP',
                                'cicilan' => 'Cicilan',
                                'lunas' => 'Lunas',
                            ])
                            ->default('belum_bayar'),
                    ]),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('total_biaya')->label('Total Biaya')->numeric()->prefix('Rp'),
                        Forms\Components\TextInput::make('total_bayar')->label('Total Sudah Bayar')->numeric()->prefix('Rp'),
                    ]),
                    Forms\Components\Textarea::make('catatan')->label('Catatan'),
                ]),

                Forms\Components\Tabs\Tab::make('Kontak Darurat')->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('kontak_darurat_nama')->label('Nama Kontak Darurat'),
                        Forms\Components\TextInput::make('kontak_darurat_hp')->label('No. HP Kontak Darurat'),
                    ]),
                    Forms\Components\TextInput::make('hubungan_kontak_darurat')->label('Hubungan'),
                ]),

                Forms\Components\Tabs\Tab::make('Dokumen')->schema([
                    Forms\Components\FileUpload::make('foto_ktp')
                        ->label('Foto KTP')
                        ->image()
                        ->directory('jamaah/ktp')
                        ->maxSize(2048),
                    Forms\Components\FileUpload::make('foto_paspor')
                        ->label('Foto Paspor')
                        ->image()
                        ->directory('jamaah/paspor')
                        ->maxSize(2048),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_registrasi')->label('No. Reg')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('no_hp')->label('No. HP')->searchable(),
                Tables\Columns\TextColumn::make('paket.nama')->label('Paket')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'secondary' => 'daftar',
                        'warning' => 'konfirmasi',
                        'success' => fn($s) => in_array($s, ['berangkat', 'selesai']),
                        'danger' => 'batal',
                    ])
                    ->formatStateUsing(fn($s) => match($s) {
                        'daftar' => 'Mendaftar', 'konfirmasi' => 'Dikonfirmasi',
                        'berangkat' => 'Berangkat', 'selesai' => 'Selesai', 'batal' => 'Batal', default => $s
                    }),
                Tables\Columns\BadgeColumn::make('status_pembayaran')
                    ->label('Pembayaran')
                    ->colors(['danger' => 'belum_bayar', 'warning' => 'dp', 'info' => 'cicilan', 'success' => 'lunas'])
                    ->formatStateUsing(fn($s) => match($s) {
                        'belum_bayar' => 'Belum Bayar', 'dp' => 'DP', 'cicilan' => 'Cicilan', 'lunas' => 'Lunas', default => $s
                    }),
                Tables\Columns\BadgeColumn::make('status_dokumen')
                    ->label('Dokumen')
                    ->colors(['danger' => 'belum_lengkap', 'warning' => 'proses', 'success' => 'lengkap'])
                    ->formatStateUsing(fn($s) => match($s) {
                        'belum_lengkap' => 'Belum Lengkap', 'proses' => 'Proses', 'lengkap' => 'Lengkap', default => $s
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Status')
                    ->options(['daftar' => 'Mendaftar', 'konfirmasi' => 'Dikonfirmasi', 'berangkat' => 'Berangkat', 'selesai' => 'Selesai', 'batal' => 'Batal']),
                Tables\Filters\SelectFilter::make('status_pembayaran')->label('Pembayaran')
                    ->options(['belum_bayar' => 'Belum Bayar', 'dp' => 'DP', 'cicilan' => 'Cicilan', 'lunas' => 'Lunas']),
                Tables\Filters\SelectFilter::make('paket_id')->label('Paket')
                    ->options(Paket::pluck('nama', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListJamaahs::route('/'),
            'create' => Pages\CreateJamaah::route('/create'),
            'edit'   => Pages\EditJamaah::route('/{record}/edit'),
        ];
    }
}
