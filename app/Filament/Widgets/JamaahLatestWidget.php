<?php

namespace App\Filament\Widgets;

use App\Models\Jamaah;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class JamaahLatestWidget extends BaseWidget
{
    protected static ?string $heading = 'Jamaah Terbaru';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Jamaah::query()->latest()->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('no_registrasi')->label('No. Reg'),
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama'),
                Tables\Columns\TextColumn::make('no_hp')->label('No. HP'),
                Tables\Columns\TextColumn::make('paket.nama')->label('Paket'),
                Tables\Columns\BadgeColumn::make('status')->label('Status')
                    ->colors(['secondary' => 'daftar', 'warning' => 'konfirmasi', 'success' => 'berangkat', 'danger' => 'batal'])
                    ->formatStateUsing(fn($s) => match($s) {
                        'daftar' => 'Mendaftar', 'konfirmasi' => 'Konfirmasi',
                        'berangkat' => 'Berangkat', 'selesai' => 'Selesai', 'batal' => 'Batal', default => $s
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Daftar')->dateTime('d M Y'),
            ]);
    }
}
