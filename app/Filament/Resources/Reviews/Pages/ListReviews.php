<?php

namespace App\Filament\Resources\Reviews\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Review;

use App\Filament\Exports\ReviewExporter;
use App\Filament\Imports\ReviewImporter;
use Filament\Actions\ActionGroup;


class ListReviews extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 1. Tombol Create (New Review) bawaan
            Actions\CreateAction::make()
                ->icon('heroicon-m-chat-bubble-left-ellipsis')
                ->label('Ulasan baru')
                ->color('primary'),

            ActionGroup::make([
                    
                // 2. Tombol Export (Pindah ke sini)
                Actions\ExportAction::make()
                    ->exporter(ReviewExporter::class)
                    ->icon('heroicon-m-arrow-down-tray')
                    ->label('Ekspor Excel')
                    ->color('success'), // Opsional: kasih warna biar beda

                // 3. Tombol Import (Pindah ke sini)
                Actions\ImportAction::make()
                    ->importer(ReviewImporter::class)
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