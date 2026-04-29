<?php

namespace App\Filament\Resources\Divisions\Pages;

use App\Filament\Resources\DivisionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivision extends EditRecord
{
    protected static string $resource = DivisionResource::class;

    // Tambahkan fungsi ini di agar kembali ke list
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // 1. Definisikan Tombol di Header (Atas)
    protected function getHeaderActions(): array
    {
        return [
            // Tombol Save Custom di Atas
            Actions\Action::make('save')
                ->label('Simpan Perubahan')
                ->action('save') // Memanggil fungsi save bawaan
                ->keyBindings(['mod+s']), // Shortcut Ctrl+S
            
            // Tombol Delete Bawaan
            Actions\DeleteAction::make()
                ->label('Hapus Data'),

            Actions\Action::make('cancel')
                ->label('Batal')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')), // Balik ke tabel utama
        ];
    }
    protected function getFormActions(): array
    {
        return [];
    }

}
