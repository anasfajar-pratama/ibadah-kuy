<?php

namespace App\Filament\Widgets;

use App\Models\Jamaah;
use App\Models\Paket;
use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalJamaah   = Jamaah::count();
        $jamaahBulanIni = Jamaah::whereMonth('created_at', now()->month)->count();
        $totalPaket    = Paket::aktif()->count();
        $totalBooking  = Booking::count();
        $bookingLunas  = Booking::where('status_pembayaran', 'lunas')->count();

        return [
            Stat::make('Total Jamaah', number_format($totalJamaah))
                ->description('+' . $jamaahBulanIni . ' bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-users'),

            Stat::make('Paket Aktif', $totalPaket)
                ->description('Paket haji & umrah tersedia')
                ->descriptionIcon('heroicon-m-gift')
                ->color('warning')
                ->icon('heroicon-o-gift'),

            Stat::make('Total Booking', number_format($totalBooking))
                ->description($bookingLunas . ' sudah lunas')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info')
                ->icon('heroicon-o-calendar'),
        ];
    }
}
