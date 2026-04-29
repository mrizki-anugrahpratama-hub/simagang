<?php

namespace App\Filament\Resources\Interns\Pages;

use App\Filament\Resources\InternResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Intern;

use App\Filament\Exports\InternExporter;
use App\Filament\Imports\InternImporter;
use Filament\Actions\ActionGroup;

use Filament\Actions\Action;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;

use Filament\Schemas\Components\Tabs\Tab; 

class ListInterns extends ListRecords
{
    protected static string $resource = InternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('runAutoFinish')
            ->label('Cek Status Selesai')
            ->icon('heroicon-m-arrow-path')
            ->color('warning')
            ->requiresConfirmation() // Munculkan pop-up konfirmasi
            ->modalHeading('Jalankan Pengecekan Manual?')
            ->modalDescription('Sistem akan mencari pemagang yang tanggal berakhirnya sudah lewat dan mengubah statusnya menjadi "Selesai" secara otomatis.')
            ->action(function () {
                // Memanggil command intern:finish
                Artisan::call('intern:finish');
                
                // Berikan notifikasi sukses ke Admin
                Notification::make()
                    ->title('Pengecekan Selesai')
                    ->body('Status pemagang yang masa magangnya berakhir telah diperbarui.')
                    ->success()
                    ->send();
            }),

            // 1. Tombol Create (New Intern) bawaan
            Actions\CreateAction::make()
                ->icon('heroicon-m-user-plus')
                ->label('Peserta baru')
                ->color('primary'),

            ActionGroup::make([
                    
                // 2. Tombol Export (Pindah ke sini)
                Actions\ExportAction::make()
                    ->exporter(InternExporter::class)
                    ->icon('heroicon-m-arrow-down-tray')
                    ->label('Ekspor Excel')
                    ->color('success'), // Opsional: kasih warna biar beda

                // 3. Tombol Import (Pindah ke sini)
                Actions\ImportAction::make()
                    ->importer(InternImporter::class)
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

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(Intern::count())
                ->badgeColor('gray'),

            'menunggu' => Tab::make('Menunggu')
                ->icon('heroicon-m-clock')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'menunggu'))
                ->badge(Intern::query()->where('status', 'menunggu')->count())
                ->badgeColor('warning'),

            'aktif' => Tab::make('Aktif')
                ->icon('heroicon-m-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'aktif'))
                ->badge(Intern::query()->where('status', 'aktif')->count())
                ->badgeColor('success'),

            'selesai' => Tab::make('Selesai')
                ->icon('heroicon-m-academic-cap')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'selesai'))
                ->badge(Intern::query()->where('status', 'selesai')->count())
                ->badgeColor('info'),

            'ditolak' => Tab::make('Ditolak')
                ->icon('heroicon-m-x-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'ditolak'))
                ->badge(Intern::query()->where('status', 'ditolak')->count())
                ->badgeColor('danger'),
        ];
    }
}