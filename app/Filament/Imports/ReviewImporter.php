<?php

namespace App\Filament\Imports;

use App\Models\Review;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ReviewImporter extends Importer
{
    protected static ?string $model = Review::class;

    public static function getColumns(): array
    {
        return [
            // Memetakan Nama Mahasiswa di Excel ke intern_id di database
            ImportColumn::make('intern')
                ->relationship(resolveUsing: 'nama_mahasiswa')
                ->requiredMapping(),
            ImportColumn::make('nama_reviewer')->requiredMapping(),
            ImportColumn::make('asal_kampus'),
            ImportColumn::make('rating')->numeric()->rules(['integer', 'min:1', 'max:5']),
            ImportColumn::make('content'),
            ImportColumn::make('is_visible')->boolean(),
        ];
    }

    public function resolveRecord(): ?Review
    {
        return new Review(); // Selalu buat ulasan baru
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return 'Impor ulasan selesai. ' . number_format($import->successful_rows) . ' baris berhasil.';
    }
}