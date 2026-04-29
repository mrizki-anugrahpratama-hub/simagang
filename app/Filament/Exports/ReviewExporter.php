<?php

namespace App\Filament\Exports;

use App\Models\Review;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ReviewExporter extends Exporter
{
    protected static ?string $model = Review::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('intern.nama_mahasiswa')->label('Nama Peserta'),
            ExportColumn::make('nama_reviewer'),
            ExportColumn::make('asal_kampus'),
            ExportColumn::make('tgl_review'),
            ExportColumn::make('rating'),
            ExportColumn::make('content')->label('Ulasan'),
            ExportColumn::make('is_visible')->label('Ditampilkan'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Ekspor ulasan selesai. ' . number_format($export->successful_rows) . ' baris berhasil.';
    }
}