<?php

namespace App\Filament\Imports;

use App\Models\Intern;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Notifications\Notification;

class InternImporter extends Importer
{
    protected static ?string $model = Intern::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama_mahasiswa')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            
            ImportColumn::make('nim')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            
            // LOGIKA PENTING: Mengubah Nama Divisi di CSV menjadi ID di Database
            ImportColumn::make('division')
                ->relationship(resolveUsing: 'nama_divisi') 
                ->label('Divisi (Nama Sesuai Database)')
                ->requiredMapping(),

            ImportColumn::make('asal_kampus')->requiredMapping(),
            ImportColumn::make('fakultas'),
            ImportColumn::make('prodi'),
            
            ImportColumn::make('email_peserta')
                ->rules(['email', 'max:255']),
            
            ImportColumn::make('no_telp_peserta'),
            
            ImportColumn::make('nama_pembimbing'),
            ImportColumn::make('nip'),
            ImportColumn::make('no_telp_pembimbing'),

            ImportColumn::make('tgl_mulai')->rules(['date']),
            ImportColumn::make('tgl_berakhir')->rules(['date']),
            
            ImportColumn::make('status')
                ->rules(['in:pending,aktif,selesai,ditolak'])
                ->example('pending, aktif, selesai, atau ditolak'),
        ];
    }

    public function resolveRecord(): ?Intern
    {
        // Menggunakan NIM sebagai kunci unik agar data tidak duplikat saat diimport ulang (Opsional)
        // Jika ingin selalu buat baru, return new Intern();
        
        return Intern::firstOrNew([
            'nim' => $this->data['nim'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import selesai. ' . number_format($import->successful_rows) . ' baris berhasil.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' gagal.';
        }

        // Kirim notifikasi persisten ke Admin yang sedang login
        $user = auth()->user();
        if ($user) {
            Notification::make()
                ->title('Import Data Magang Selesai')
                ->body($body)
                ->success()
                ->sendToDatabase($user); // <--- INI YANG MENGIRIM KE LONCENG
        }

        return $body;
    }
}
