<?php

namespace App\Filament\Resources\Reviews\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReview extends CreateRecord
{
    protected static string $resource = ReviewResource::class;

    // // Mengubah tulisan "Create" di Breadcrumb
    // public function getBreadcrumb(): string
    // {
    //     return 'Tambah';
    // }

    // Pastikan juga judul halapannya sudah Bahasa Indonesia
    public function getTitle(): string
    {
        return 'Tambah Ulasan Magang';
    }

    // 1. Definisikan tombol di bagian atas (Header)
    protected function getHeaderActions(): array
    {
        return [
            // Tombol Create
            Actions\Action::make('create')
                ->label('Tambah Data')
                ->action('create') // Menjalankan fungsi create form
                ->color('primary'), // Warna kuning sesuai desainmu

            // Tombol Create & Create Another (Jika dibutuhkan)
            Actions\Action::make('createAnother')
                ->label('Tambah Data Banyak')
                ->action('createAnother')
                ->color('gray')
                ->outlined(),

            // Tombol Cancel
            Actions\Action::make('cancel')
                ->label('Batal')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    // 2. Sembunyikan tombol bawaan yang ada di bagian bawah
    protected function getFormActions(): array
    {
        return [];
    }

    // Tambahkan fungsi ini di agar kembali ke list
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
