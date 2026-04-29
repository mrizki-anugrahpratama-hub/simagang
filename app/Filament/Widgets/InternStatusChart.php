<?php

namespace App\Filament\Widgets;

use App\Models\Intern;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InternStatusChart extends ChartWidget
{
    // Tulisan di heading grafik
    protected ?string $heading = 'Statistik Status Magang';
    
    protected int | string | array $columnSpan = '1';

    // Set tinggi maksimal biar ga terlalu panjang ke bawah
    // protected ?string $maxHeight = '300px';

    public function getDescription(): ?string
    {
        // Tampilkan teks deskripsi
        return "Persebaran Peserta Magang";
    }

    // PERBAIKAN: Menggunakan PHP Collection agar support SQLite & MySQL
    protected function getFilters(): ?array
    {
        $years = Intern::query()
            ->select('tgl_mulai')
            ->whereNotNull('tgl_mulai')
            ->get()
            ->map(fn ($intern) => Carbon::parse($intern->tgl_mulai)->format('Y')) // Ambil tahun pakai Carbon
            ->unique()
            ->sortDesc()
            ->mapWithKeys(fn ($year) => [$year => $year]) // Format jadi ['2025' => '2025']
            ->toArray();

        // Jika data kosong, default ke tahun sekarang
        return $years ?: [date('Y') => date('Y')];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        if (! $activeFilter) {
            $activeFilter = date('Y');
        }

        // Query ini aman karena whereYear sudah otomatis support SQLite & MySQL
        $data = Intern::query()
            ->whereYear('tgl_mulai', $activeFilter) 
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Peserta Tahun ' . $activeFilter,
                    'data' => [
                        $data['menunggu'] ?? 0,
                        $data['aktif'] ?? 0,
                        $data['selesai'] ?? 0,
                        $data['ditolak'] ?? 0,
                    ],
                    'backgroundColor' => [
                        '#9CA3AF', // Pending - Abu
                        '#22C55E', // Aktif - Hijau
                        '#3B82F6', // Selesai - Biru
                        '#EF4444', // Ditolak - Merah
                    ],
                    'borderColor' => '#FFFFFF',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Pending', 'Aktif', 'Selesai', 'Ditolak'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}