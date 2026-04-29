<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Divisions\Pages;
use App\Models\Division;
use Filament\Forms;
use Filament\Schemas\Schema; // Wajib filament v4
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum; // Wajib untuk mengatasi error type icon

use Filament\Actions\EditAction;

class DivisionResource extends Resource
{
    protected static ?string $model = Division::class;

    // Menu
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Divisi Magang';
    protected static ?string $pluralModelLabel = 'Divisi Magang';

    protected static ?string $navigationLabel = 'Divisi Magang';

    protected static ?string $recordTitleAttribute = 'nama_divisi';

    // Menggunakan Schema (Standard Filament v4)
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('nama_divisi')
                    ->required()
                    ->label('Nama Bagian / Bidang'),
                
                Forms\Components\TextInput::make('competency')
                    ->label('Kompetensi')
                    ->placeholder('e.g., Kompetensi Administrasi')
                    ->helperText('Deskripsi singkat kompetensi divisi'),

                Forms\Components\Select::make('icon_type')
                    ->label('Tipe Ikon')
                    ->options([
                        'admin' => 'Admin (Clipboard User)',
                        'code' => 'Code (Development)',
                        'user' => 'User (People)',
                        'chat' => 'Chat (Communication)',
                        'dollar' => 'Dollar (Finance)',
                    ])
                    ->default('admin')
                    ->required(),

                Forms\Components\Select::make('color_scheme')
                    ->label('Skema Warna')
                    ->options([
                        'blue' => 'Biru',
                        'purple' => 'Ungu',
                        'green' => 'Hijau',
                        'pink' => 'Pink',
                        'orange' => 'Oranye',
                    ])
                    ->default('blue')
                    ->required(),

                Forms\Components\TextInput::make('total_quota')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->label('Total Kuota Maksimal')
                    ->minValue(0),

                Forms\Components\TextInput::make('used_quota')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->label('Kuota Terpakai')
                    ->minValue(0)
                    ->helperText('Jumlah slot yang sudah terisi'),

                Forms\Components\DatePicker::make('updated_date')
                    ->label('Tanggal Diperbarui')
                    ->default(now())
                    ->displayFormat('d/m/Y')
                    ->helperText('Tanggal terakhir data kuota diperbarui'),
            ]);
    }

    // buat nampilin data table
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')
                    ->label('No')
                    ->rowIndex()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('nama_divisi')
                    ->label('Nama Divisi')
                    ->searchable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('competency')
                    ->label('Kompetensi')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->competency),
                
                // Tables\Columns\TextColumn::make('color_scheme')
                //     ->label('Warna')
                //     ->colors([
                //         'primary' => 'blue',
                //         'success' => 'green',
                //         'warning' => 'orange',
                //         'danger' => 'pink',
                //         'info' => 'purple',
                //     ]),
                
                Tables\Columns\TextColumn::make('remaining_quota')
                    ->label('Sisa Kuota')
                    ->getStateUsing(fn ($record) => $record->total_quota - $record->used_quota)
                    ->badge()
                    ->color(fn ($state) => $state > 5 ? 'success' : ($state > 0 ? 'warning' : 'danger'))
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('quota_info')
                    ->label('Total Kuota')
                    ->getStateUsing(fn ($record) => "{$record->used_quota} / {$record->total_quota}")
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->getStateUsing(function ($record) {
                        if ($record->total_quota == 0) return '0%';
                        $percentage = round(($record->used_quota / $record->total_quota) * 100);
                        return $percentage . '%';
                    })
                    ->badge()
                    ->color(function ($record) {
                        if ($record->total_quota == 0) return 'gray';
                        $percentage = ($record->used_quota / $record->total_quota) * 100;
                        if ($percentage >= 80) return 'danger';
                        if ($percentage >= 50) return 'warning';
                        return 'success';
                    })
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('updated_date')
                    ->label('Diperbarui')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordUrl(null)
            ->searchPlaceholder('Cari terkait divisi...')
            ->actions([
                // Menambahkan Action Group agar tombol Edit & Detail rapi dalam dropdown/sejajar
                // ActionGroup::make([
                    EditAction::make('view_details')
                        ->label('Detail')->color('primary')
                        ->label('Detail')
                        ->icon('heroicon-o-eye'),
                    // EditAction::make()->label('Ubah'),
                    // DeleteAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDivisions::route('/'),
            'create' => Pages\CreateDivision::route('/create'),
            'edit' => Pages\EditDivision::route('/{record}/edit'),
        ];
    }
}