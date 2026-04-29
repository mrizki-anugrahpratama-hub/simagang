<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ReviewRatingChart extends ChartWidget
{
    // Tulisan di heading grafik
    protected ?string $heading = 'Distribusi Rating Ulasan';
    
    protected int | string | array $columnSpan = '1';

    // Set tinggi maksimal biar ga terlalu panjang ke bawah
    // protected static ?string $maxHeight = '250px';

    // Kita set urutan ke-4 (setelah grafik kampus)
    protected static ?int $sort = 4;
    
    // TAMBAHKAN KODE INI (Untuk Menampilkan Rata-rata)
    public function getDescription(): ?string
    {
        // Hitung rata-rata dari database
        $average = Review::avg('rating') ?? 0;
        
        // Format angka (misal: 4.5)
        $formatted = number_format($average, 1);
        
        // Tampilkan teks deskripsi
        return "Rata-rata Kepuasan: {$formatted} / 5.0 ⭐";

        // Hitung rata-rata
        // $average = Review::avg('rating') ?? 0;
        // return "Rata-rata Kepuasan: " . number_format($average, 1) . " / 5.0 ⭐";
    }

    protected function getData(): array
    {
        // ... (Kodingan getData yang lama biarkan saja) ...
        $data = Review::query()
            ->select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Ulasan',
                    'data' => [
                        $data[5] ?? 0,
                        $data[4] ?? 0,
                        $data[3] ?? 0,
                        $data[2] ?? 0,
                        $data[1] ?? 0,
                    ],
                    'backgroundColor' => [
                        '#22C55E', // 5 - Hijau Tua
                        '#84CC16', // 4 - Hijau Muda
                        '#EAB308', // 3 - Kuning
                        '#F97316', // 2 - Oranye
                        '#EF4444', // 1 - Merah
                    ],
                    'borderRadius' => 5,
                    'barThickness' => 20,
                ],
            ],
            'labels' => [
                '⭐⭐⭐⭐⭐ (5)', 
                '⭐⭐⭐⭐ (4)', 
                '⭐⭐⭐ (3)', 
                '⭐⭐ (2)', 
                '⭐ (1)'
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}