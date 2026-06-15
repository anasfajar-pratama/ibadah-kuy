<?php

namespace App\Filament\Widgets;

use App\Models\Paket;
use Filament\Widgets\ChartWidget;

class PaketChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Paket';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Paket::aktif()
            ->selectRaw('jenis, count(*) as total')
            ->groupBy('jenis')
            ->pluck('total', 'jenis');

        $labels = [
            'haji_reguler' => 'Haji Reguler',
            'haji_plus' => 'Haji Plus',
            'haji_furoda' => 'Haji Furoda',
            'umrah_reguler' => 'Umrah Reguler',
            'umrah_plus' => 'Umrah Plus',
            'umrah_ramadan' => 'Umrah Ramadan',
            'umrah_custom' => 'Umrah Custom',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Paket',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => ['#D4A017', '#C8860A', '#B8730A', '#1a7a4a', '#15623b', '#0d4a2c', '#0a3d24'],
                ],
            ],
            'labels' => $data->keys()->map(fn($k) => $labels[$k] ?? $k)->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
