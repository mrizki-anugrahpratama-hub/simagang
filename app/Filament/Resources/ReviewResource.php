<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Reviews\Pages;
use App\Models\Review;
use App\Models\Intern; // Tambahkan import model Intern
use Filament\Forms;
// use Filament\Forms\Set; // Tambahkan import untuk closure Set
use Filament\Schemas\Schema; 
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use Filament\Schemas\Components\Utilities\Set;

use Filament\Schemas\Components\Grid;
use Filament\Actions\EditAction;

use Filament\Schemas\Components\Group;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-right'; 
    
    protected static ?string $modelLabel = 'Ulasan Magang';
    protected static ?string $pluralModelLabel = 'Ulasan Magang';
    
    protected static ?string $navigationLabel = 'Ulasan Magang';
    protected static ?string $recordTitleAttribute = 'nama_reviewer';

    // Menampilkan angka jumlah data yang statusnya 'menunggu'
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('created_at', '>=', now()->subDay())->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Grid utama yang membungkus seluruh konten
                Grid::make([
                    'default' => 1,
                    'lg' => 2, // Gunakan 2 kolom hanya pada layar besar (desktop)
                ])
                ->schema([

                    // BAGIAN KIRI: INFORMASI PENGULAS
                    Section::make('Informasi Pengulas')
                        ->description('Data ini akan otomatis terisi saat memilih Mahasiswa.')
                        ->schema([
                            Forms\Components\Select::make('intern_id')
                                ->label('Pilih Mahasiswa Magang')
                                ->relationship('intern', 'nama_mahasiswa')
                                ->searchable()
                                ->preload()
                                ->live()
                                ->afterStateUpdated(function ($state, Set $set) {
                                    if (blank($state)) {
                                        $set('nama_reviewer', null);
                                        $set('asal_kampus', null);
                                        return;
                                    }

                                    $intern = \App\Models\Intern::find($state);
                                    $set('nama_reviewer', $intern?->nama_mahasiswa);
                                    $set('asal_kampus', $intern?->asal_kampus);
                                })
                                ->required()
                                ->columnSpanFull(),

                            Forms\Components\TextInput::make('nama_reviewer')
                                ->label('Nama Pengulas')
                                ->required()
                                ->readOnly()
                                ->placeholder('Otomatis terisi...')
                                ->columnSpan(1),

                            Forms\Components\TextInput::make('asal_kampus')
                                ->label('Asal Kampus')
                                ->required()
                                ->readOnly()
                                ->placeholder('Otomatis terisi...')
                                ->columnSpan(1),

                            Forms\Components\DatePicker::make('tgl_review')
                                ->label('Tanggal Ulasan')
                                ->default(now())
                                ->required()
                                ->columnSpan(1),

                            Forms\Components\Select::make('rating')
                                ->label('Rating Kepuasan')
                                ->options([
                                    1 => '⭐ (Sangat Kurang)',
                                    2 => '⭐⭐ (Kurang)',
                                    3 => '⭐⭐⭐ (Cukup)',
                                    4 => '⭐⭐⭐⭐ (Baik)',
                                    5 => '⭐⭐⭐⭐⭐ (Sangat Baik)'
                                ])
                                ->required()
                                ->columnSpan(1),
                        ])
                        ->columns(2) // Mengatur grid internal seksi menjadi 2 kolom
                        ->columnSpan(1), // Mengambil 1 dari 2 kolom grid utama

                    // BAGIAN KANAN: KONTEN ULASAN
                    Section::make('Konten Ulasan')
                        ->description('Berikan ulasan mengenai pengalaman magang.')
                        ->schema([
                            Forms\Components\Textarea::make('content')
                                ->label('Isi Ulasan/Testimoni')
                                ->required()
                                ->rows(5) // Ditambah agar tingginya pas dengan seksi kiri
                                // ->extraInputAttributes(['style' => 'resize: none;']) // KUNCI: Mematikan fitur tarik-ulur (stretch)
                                ->columnSpanFull(),

                            Forms\Components\Toggle::make('is_visible')
                                ->label('Tampilkan di Halaman Web Utama')
                                ->helperText('Jika aktif, ulasan ini akan muncul di landing page.')
                                ->default(false)
                                ->columnSpanFull(),
                        ])
                        ->columns(1)
                        ->columnSpan(1), // Mengambil 1 dari 2 kolom grid utama
                ])
                ->columnSpanFull(), // KUNCI: Agar Grid memenuhi seluruh lebar container
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')->label('No')->rowIndex()->alignCenter(),

                Tables\Columns\TextColumn::make('nama_reviewer')
                    ->label('Nama Pengulas')
                    ->description(fn ($record) => $record->asal_kampus) // Menaruh kampus di bawah nama agar ringkas
                    ->searchable()
                    ->sortable(),

                // Tables\Columns\TextColumn::make('intern.division.nama_divisi')
                //     ->label('Divisi')
                //     ->placeholder('-')
                //     ->toggleable(), // Bisa disembunyikan admin jika tidak butuh

                Tables\Columns\TextColumn::make('content')
                    ->label('Isi Ulasan')
                    ->limit(40)
                    ->searchable()
                    ->tooltip(fn ($record): string => $record->content), // KUNCI: Munculkan teks lengkap saat hover cursor

                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state): string => str_repeat('⭐', $state)),
                    // ->alignCenter(),

                Tables\Columns\TextColumn::make('is_visible_label')
                    ->label('Status')
                    ->state(fn ($record): string => $record->is_visible ? 'Tayang' : 'Sembunyi') // Menentukan tulisan On/Off
                    ->badge()
                    ->color(fn ($state): string => $state === 'Tayang' ? 'success' : 'danger') // Warna hijau untuk On, merah untuk Off
                    ->alignCenter(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Status Tayang')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('tgl_review')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                // Fitur Filter Tayang
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Status Tayang')
                    ->placeholder('Semua Ulasan')
                    ->trueLabel('Sedang Tayang')
                    ->falseLabel('Tidak Tayang'),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null)
            ->searchPlaceholder('Cari terkait ulasan...')
            ->actions([
                // Menambahkan Action Group agar tombol Edit & Detail rapi dalam dropdown/sejajar
                // ActionGroup::make([
                    EditAction::make('view_details')
                        ->label('Detail')->color('primary')
                        ->label('Detail')
                        ->icon('heroicon-o-eye'),
                ]);;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}