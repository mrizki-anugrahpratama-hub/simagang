<?php

namespace App\Filament\Imports;

use App\Models\Division;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Notifications\Notification;

class DivisionImporter extends Importer
{
    protected static ?string $model = Division::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama_divisi')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('competency'),
            ImportColumn::make('total_quota')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('used_quota')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?Division
    {
        // Mencari berdasarkan nama divisi agar tidak duplikat
        return Division::firstOrNew([
            'nama_divisi' => $this->data['nama_divisi'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Impor divisi selesai. ' . number_format($import->successful_rows) . ' baris berhasil.';

        $user = auth()->user();
        if ($user) {
            Notification::make()
                ->title('Impor Data Divisi Selesai')
                ->body($body)
                ->success()
                ->sendToDatabase($user);
        }

        return $body;
    }
}