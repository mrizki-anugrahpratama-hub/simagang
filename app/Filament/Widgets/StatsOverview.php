<?php

namespace App\Filament\Widgets;

use App\Models\Intern;
use App\Models\Division;
use App\Models\Review;

use App\Filament\Resources\InternResource;
use App\Filament\Resources\DivisionResource;
use App\Filament\Resources\ReviewResource;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    // Agar widget ini update otomatis tiap beberapa detik (opsional, biar realtime)
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            // 1. STATISTIK PESERTA MAGANG
            Stat::make('Total Peserta', Intern::count())
                ->description('Total pendaftar masuk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Grafik mini hiasan
                ->url(InternResource::getUrl('index')) // Link ke menu Mahasiswa
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1', 
                ]),

            // 2. STATISTIK PESERTA AKTIF
            Stat::make('Peserta Aktif', Intern::where('status', 'aktif')->count())
                ->description('Aktif magang sekarang')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->url(InternResource::getUrl('index')) // Link ke menu Mahasiswa (bisa difilter via URL kalau mau advanced)
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1',
                ]),

            // 3. STATISTIK JUMLAH DIVISI
            Stat::make('Total Divisi', Division::count())
                ->description('Bidang magang tersedia')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info')
                ->url(DivisionResource::getUrl('index')) // Link ke menu Divisi
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1',
                ]),

            // 4. STATISTIK REVIEW (BARU)
            Stat::make('Ulasan Masuk', Review::count())
                ->description('Testimoni purna magang')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning')
                ->url(ReviewResource::getUrl('index')) // Link ke menu Review
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1',
                ]),
        ];
    }
}