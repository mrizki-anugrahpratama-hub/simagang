<?php

namespace App\Filament\Resources\Divisions\Pages;

use App\Filament\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Exports\DivisionExporter;
use App\Filament\Imports\DivisionImporter;
use Filament\Actions\ActionGroup;

class ListDivisions extends ListRecords
{
    protected static string $resource = DivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 1. Tombol Create (New Division) bawaan
            Actions\CreateAction::make()
                ->icon('heroicon-m-squares-plus')
                ->label('Divisi baru')
                ->color('primary'),

            ActionGroup::make([
                    
                // 2. Tombol Export (Pindah ke sini)
                Actions\ExportAction::make()
                    ->exporter(DivisionExporter::class)
                    ->icon('heroicon-m-arrow-down-tray')
                    ->label('Ekspor Excel')
                    ->color('success'), // Opsional: kasih warna biar beda

                // 3. Tombol Import (Pindah ke sini)
                Actions\ImportAction::make()
                    ->importer(DivisionImporter::class)
                    ->icon('heroicon-m-arrow-up-tray')
                    ->label('Impor Excel')
                    ->color('info') // Opsional: kasih warna biar beda
                    ->maxRows(500),
            ])
            ->label('Lainnya') // Nama tombol utamanya
            ->icon('heroicon-m-ellipsis-vertical') // Ikon titik tiga
            ->color('gray')
            ->button()
        ];
    }
}
