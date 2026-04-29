<?php

namespace App\Filament\Exports;

use App\Models\Division;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Notification;

class DivisionExporter extends Exporter
{
    protected static ?string $model = Division::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('nama_divisi'),
            ExportColumn::make('icon_type'),
            ExportColumn::make('color_scheme'),
            ExportColumn::make('competency'),
            ExportColumn::make('total_quota'),
            ExportColumn::make('used_quota'),
            ExportColumn::make('updated_date'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ekspor divisi selesai. ' . number_format($export->successful_rows) . ' baris berhasil.';

        $user = auth()->user();
        if ($user) {
            Notification::make()
                ->title('Ekspor Data Divisi Selesai')
                ->body($body)
                ->success()
                ->sendToDatabase($user);
        }

        return $body;
    }
}