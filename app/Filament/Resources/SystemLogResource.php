<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemLogResource\Pages;
use App\Models\SystemLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist; // Gunakan Infolist
use Filament\Infolists\Components; // Gunakan Infolist Components
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Filament\Actions\ViewAction;

class SystemLogResource extends Resource
{
    protected static ?string $model = SystemLog::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $modelLabel = 'Riwayat Perubahan';
    protected static ?string $pluralModelLabel = 'Riwayat Perubahan';
    
    protected static ?string $navigationLabel = 'Riwayat Perubahan';
    
    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }

    // PEMBARUAN: Menggunakan Infolist native Filament
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // SECTION 1: INFORMASI UMUM
                Section::make()
                    ->columns(1)
                    ->schema([
                        Grid::make(2)
                        ->schema([
                            Components\TextEntry::make('description')
                                ->label('Deskripsi Aktivitas')
                                ->columnSpanFull()
                                ->weight('bold'),
                            
                            Components\TextEntry::make('user.name')
                                ->label('Aktor (User)')
                                ->default('System')
                                ->icon('heroicon-m-user-circle'),
                            
                            Components\TextEntry::make('created_at')
                                ->label('Waktu Kejadian')
                                ->dateTime('d M Y, H:i:s')
                                ->timezone('Asia/Jakarta'),
    
                            Components\TextEntry::make('subject_type')
                                ->label('Target Data')
                                ->formatStateUsing(fn ($state) => Str::headline(class_basename($state)))
                                ->badge()
                                ->color('info'),
    
                            Components\TextEntry::make('action')
                                ->label('Aksi')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'create', 'import' => 'success',
                                    'update', 'export' => 'warning',
                                    'delete' => 'danger',
                                    default => 'gray',
                                })
                                ->formatStateUsing(fn ($state) => strtoupper($state)),
                            ])
                    ])
                    ->columnSpanFull(),

                // SECTION 2: PERBANDINGAN DATA (Replikasi Tabel Blade)
                Section::make('Detail Perubahan Atribut')
                    ->description('Perbandingan nilai lama dan nilai baru pada setiap kolom.')
                    ->schema([
                        // Gunakan TextEntry dengan formatStateUsing daripada RepeatableEntry
                        // agar PHP tidak terlalu berat melakukan mapping objek
                        Components\ViewEntry::make('changes')
                            ->label(false)
                            ->view('filament.pages.actions.log-details') 
                    ])
                    ->visible(fn ($record) => !empty($record->changes))
                    ->columnSpanFull(),                  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i')
                    ->timezone('Asia/Jakarta')
                    ->sortable()
                    ->color('gray'),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Aktor (User)')
                    ->icon('heroicon-m-user-circle')
                    ->default('System')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Target Data')
                    ->formatStateUsing(fn ($state) => Str::headline(class_basename($state)))
                    ->badge()
                    ->color('info'),
                
                Tables\Columns\TextColumn::make('action')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'create', 'import' => 'success',
                        'update', 'export' => 'warning',
                        'delete' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),

                Tables\Columns\TextColumn::make('description')
                    ->label('Keterangan')
                    ->searchable()
                    // ->limit(40),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null) // Tetap null agar baris tidak bisa diklik
            ->searchPlaceholder('Cari terkait log data...')
            ->actions([
                // PEMBARUAN: Menggunakan ViewAction standar yang memanggil infolist()
                ViewAction::make('view_details')
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->modalHeading('Detail Riwayat Perubahan')
                    ->modalWidth('5xl'), // Lebar modal disesuaikan agar perbandingan muat
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSystemLogs::route('/'),
        ];
    }
}