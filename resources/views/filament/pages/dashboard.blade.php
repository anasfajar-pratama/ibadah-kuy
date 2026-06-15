<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="fi-stats-overview-stat rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 p-6">
            <div class="fi-stats-overview-stat-icon-ctn flex items-center gap-4">
                <div class="rounded-full bg-amber-50 p-3">
                    <x-heroicon-o-users class="h-6 w-6 text-amber-500" />
                </div>
                <div>
                    <p class="text-sm text-gray-500">Selamat datang di</p>
                    <h2 class="text-xl font-bold text-amber-700">ibadah-Kuy CMS</h2>
                </div>
            </div>
            <p class="mt-3 text-sm text-gray-500">Panel admin untuk mengelola konten website dan data jamaah travel haji & umrah ibadah-Kuy.</p>
        </div>
    </div>

    @livewire(\App\Filament\Widgets\StatsOverviewWidget::class)
    @livewire(\App\Filament\Widgets\PaketChartWidget::class)
    @livewire(\App\Filament\Widgets\JamaahLatestWidget::class)
</x-filament-panels::page>
