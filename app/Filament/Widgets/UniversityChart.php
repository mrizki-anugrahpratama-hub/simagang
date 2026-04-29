<?php

namespace App\Filament\Widgets;

use App\Models\Intern;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UniversityChart extends ChartWidget
{
    // Tulisan di heading grafik
    protected ?string $heading = 'Statisitik Kampus Asal Peserta';

    protected int | string | array $columnSpan = '1';

    // Set tinggi maksimal biar ga terlalu panjang ke bawah
    // protected ?string $maxHeight = '300px';
    
    // Kita set sort-nya urutan ke-3 (setelah StatsOverview dan Grafik Status)
    protected static ?int $sort = 3;

    public function getDescription(): ?string
    {
        // Tampilkan teks deskripsi
        return "Top 5 Kampus Asal Peserta Magang";
    }

    protected function getData(): array
    {
        // Ambil 5 kampus dengan peserta terbanyak
        $data = Intern::query()
            ->select('asal_kampus', DB::raw('count(*) as total'))
            ->groupBy('asal_kampus')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'asal_kampus')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Mahasiswa',
                    'data' => array_values($data), // Ambil angkanya saja
                    'backgroundColor' => [
                        '#F59E0B', // Amber
                        '#10B981', // Emerald
                        '#3B82F6', // Blue
                        '#6366F1', // Indigo
                        '#EC4899', // Pink
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => array_keys($data), // Ambil nama kampusnya
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // Keren pakai donat buat data kategori
    }
}