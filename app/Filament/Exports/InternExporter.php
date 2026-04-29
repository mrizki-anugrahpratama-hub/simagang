<?php

namespace App\Filament\Exports;

use App\Models\Intern;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export; // <--- Pastikan ini Export, bukan Import
use Filament\Notifications\Notification;

class InternExporter extends Exporter
{
    protected static ?string $model = Intern::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('nama_mahasiswa')->label('Nama'),
            ExportColumn::make('nim')->label('NIM'),
            ExportColumn::make('asal_kampus'),
            ExportColumn::make('fakultas'),
            ExportColumn::make('prodi'),
            ExportColumn::make('email_peserta'),
            ExportColumn::make('no_telp_peserta'),
            ExportColumn::make('nama_pembimbing'),
            ExportColumn::make('nip'),
            ExportColumn::make('no_telp_pembimbing'),
            ExportColumn::make('division.nama_divisi')->label('Divisi'),
            ExportColumn::make('tgl_mulai'),
            ExportColumn::make('tgl_berakhir'),
            ExportColumn::make('status'),
            ExportColumn::make('pasfoto_path'),
            ExportColumn::make('cv_path'),
            ExportColumn::make('ktm_path'),
            ExportColumn::make('proposal_path'),
            ExportColumn::make('surat_permohonan_path'),
            ExportColumn::make('surat_balasan_magang_path'),
            ExportColumn::make('surat_pengembalian_path'),
            ExportColumn::make('sertifikat_path'),
            ExportColumn::make('form_penilaian_path'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    // PERBAIKAN DI SINI:
    // Gunakan (Export $export), BUKAN (Import $import)
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export selesai. ' . number_format($export->successful_rows) . ' baris berhasil.';
    
        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' gagal.';
        }
    
        $user = auth()->user();
        if ($user) {
            Notification::make()
                ->title('Export Data Magang Selesai')
                ->body($body)
                ->success()
                ->sendToDatabase($user);
        }
    
        return $body;
    }
}