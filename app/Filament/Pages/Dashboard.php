<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\InternStatusChart;
use App\Filament\Widgets\UniversityChart;
use App\Filament\Widgets\ReviewRatingChart;
use BackedEnum;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';
    
    // Logo samping nama menu
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-home';
    
    // Title di menu
    protected static ?string $title = 'Dasbor Admin';

    // Atur kolom widget grafik
    public function getColumns(): int
    {
        return 3;
    }

    // fungsi daftar widget ini
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,       // Widget Kartu (Total, Aktif, Divisi)
            InternStatusChart::class,   // Widget Grafik Status Intern (Bar)
            UniversityChart::class,     // Widget Grafik Kampus (Donut)
            ReviewRatingChart::class,   // Widget Grafik review (Horizontal Bar)
        ];
    }
}