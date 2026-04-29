<?php

namespace App\Filament\Resources;

use Filament\Schemas\Components\Section as SchemaSection;
use App\Filament\Resources\Interns\Pages;
use App\Models\Intern;
use Filament\Forms;
use Filament\Schemas\Schema; // Wajib filament v4
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum; // Wajib untuk icon
use Illuminate\Support\Facades\Storage; // biar bisa ada matanya di list tabel dokumen
use Filament\Schemas\Components\Tabs;

use App\Filament\Exports\InternExporter;
use App\Filament\Imports\InternImporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Schemas\Components\Grid;
use Filament\Actions\ActionGroup;
use Filament\Facades\Filament;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Utilities\Get;

class InternResource extends Resource
{
    protected static ?string $model = Intern::class;

    // Menu
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-academic-cap'; // Icon Topi Wisuda

    protected static ?string $modelLabel = 'Peserta Magang';
    protected static ?string $pluralModelLabel = 'Peserta Magang';

    protected static ?string $navigationLabel = 'Peserta Magang';

    protected static ?string $recordTitleAttribute = 'nama_mahasiswa';

    // Menampilkan angka jumlah data yang statusnya 'menunggu'
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'menunggu')->count() ?: null;
    }

    // Memberikan warna pada badge (Warning/Kuning agar menarik perhatian)
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning'; 
    }

    // eager load
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['division']) // Eager load relasi 'division'
            ->withoutGlobalScopes(); // Opsional: jika ada scope yang berat
    }

    // Menggunakan Schema (Standard Filament v4)
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // Bungkus semua dalam Tabs
            Tabs::make('Data Peserta Magang')
                ->tabs([
                    // TAB 1: IDENTITAS (Data Pribadi & Kampus)
                    Tabs\Tab::make('Identitas Diri')
                        ->icon('heroicon-m-user')
                        ->schema([
                            SchemaSection::make()
                                ->schema([
                                    Grid::make(2)->schema([ // Grid 2 kolom biar rapi
                                        Forms\Components\FileUpload::make('pasfoto_path')
                                            ->label('Pasfoto Formal')
                                            ->image()->avatar()
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('pasfoto')
                                            ->columnSpanFull()->alignCenter()
                                            ->downloadable()->openable(),

                                        Forms\Components\TextInput::make('nama_mahasiswa')->label('Nama Mahasiswa')->required(),
                                        Forms\Components\TextInput::make('nim')->label('NIM')->required(),
                                        Forms\Components\TextInput::make('no_telp_peserta')->label('No.Telpon Aktif')->required(),
                                        Forms\Components\TextInput::make('email_peserta')->label('Email')->email()->required(),

                                        Forms\Components\TextInput::make('asal_kampus')->label('Asal Kampus')->required(),
                                        Forms\Components\TextInput::make('fakultas')->label('Fakultas')->required(),
                                        Forms\Components\TextInput::make('prodi')->label('Program Studi')->required()->columnSpanFull(),
                                    ]),
                                ]),
                        ]),     

                    // TAB 2: INFO MAGANG (Pembimbing & Status)
                    Tabs\Tab::make('Info Magang & Dosen')
                        ->icon('heroicon-m-briefcase')
                        ->schema([
                            Grid::make(2)->schema([
                                // Bagian Status & Divisi
                                SchemaSection::make('Tgl & Penempatan Magang')
                                    ->schema([
                                        Forms\Components\Select::make('division_id')
                                            ->label('Divisi / Bagian')
                                            ->relationship('division', 'nama_divisi')
                                            // 1. Menampilkan sisa kuota di label dropdown
                                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->nama_divisi} (Sisa: {$record->remaining_quota})") 
                                            // 2. Filter: Hanya tampilkan divisi yang masih punya kuota
                                            ->options(function () {
                                                return \App\Models\Division::all()
                                                    ->filter(fn ($div) => $div->remaining_quota > 0)
                                                    ->pluck('nama_divisi', 'id');
                                            })
                                            ->searchable()->preload()->required()->live(),
                                        Forms\Components\DatePicker::make('tgl_mulai')->label('Tgl.Mulai')->required(),
                                        Forms\Components\DatePicker::make('tgl_berakhir')->label('Tgl.Berakhir')->required(),
                                    ])->columnSpan(1),

                                // Bagian Dosen
                                SchemaSection::make('Dosen Pembimbing')
                                    ->schema([
                                        Forms\Components\TextInput::make('nama_pembimbing')->label('Nama Pembimbing')->required(),
                                        Forms\Components\TextInput::make('nip')->required()->label('NIP'),
                                        Forms\Components\TextInput::make('no_telp_pembimbing')->label('No.Telpon Dosen')->required(),
                                    ])->columnSpan(1),
                            ]),
                        ]),

                    // TAB 3: BERKAS PRA MAGANG
                    Tabs\Tab::make('Berkas Pra-Magang')
                        ->icon('heroicon-m-document-text')
                        ->schema([
                            SchemaSection::make()
                                ->schema([
                                    Grid::make(2)->schema([
                                        Forms\Components\FileUpload::make('cv_path')
                                            ->label('CV (Curriculum Vitae)')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('cv')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->downloadable()->openable()->previewable(),

                                        Forms\Components\FileUpload::make('ktm_path')
                                            ->label('Scan KTM')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('ktm')
                                            ->image()->openable(),

                                        Forms\Components\FileUpload::make('proposal_path')
                                            ->label('Proposal')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('proposal')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->downloadable()->openable(),

                                        Forms\Components\FileUpload::make('surat_permohonan_path')
                                            ->label('Surat Permohonan')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('surat-permohonan')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->downloadable()->openable(),
                                        ]),
                                    ]),
                        ]),

                    // TAB 4: BERKAS PASCA MAGANG
                    Tabs\Tab::make('Berkas Pasca-Magang')
                        ->icon('heroicon-m-document-check')
                        ->badge(fn ($record) => $record && $record->status === 'selesai' ? 'Wajib' : null)
                        ->schema([
                            SchemaSection::make()
                                ->schema([
                                    Grid::make(2)->schema([
                                        Forms\Components\Placeholder::make('progress_berkas')
                                            ->label('Kelengkapan Berkas')
                                            ->content(function ($record) {
                                                if (!$record) return '0%';
                                                $files = [$record->surat_balasan_magang_path, $record->surat_pengembalian_path, $record->sertifikat_path, $record->form_penilaian_path];
                                                $completed = count(array_filter($files));
                                                $percentage = ($completed / 4) * 100;
                                                return "{$percentage}% Selesai ($completed dari 4 berkas)";
                                            })
                                            ->columnSpanFull(),

                                        Forms\Components\FileUpload::make('surat_balasan_magang_path')
                                            ->label('Surat Balasan Magang')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('surat-balasan')
                                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                                            ->downloadable()->openable()->previewable(),

                                        Forms\Components\FileUpload::make('surat_pengembalian_path')
                                            ->label('Surat Pengembalian')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('surat-pengembalian')
                                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                                            ->downloadable()->openable(),
                                    
                                        Forms\Components\FileUpload::make('sertifikat_path')
                                            ->label('Sertifikat Magang')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('sertifikat')
                                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                                            ->downloadable()->openable(),

                                        Forms\Components\FileUpload::make('form_penilaian_path')
                                            ->label('Form Penilaian Magang')
                                            ->disk('public') // <--- TAMBAHKAN INI
                                            ->visibility('public') // <--- TAMBAHKAN INI
                                            ->directory('form-penilaian')
                                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                                            ->downloadable()->openable(),
                                    ]),
                                ]),
                        ]),

                    // TAB 5: STATUS MAGANG 
                    Tabs\Tab::make('Status Magang')
                        ->icon('heroicon-m-arrow-path')
                        ->schema([
                            Grid::make(2)->schema([
                                SchemaSection::make('Status Peserta Magang')
                                    ->schema([
                                        // Di dalam Tabs\Tab Status Magang
                                        Forms\Components\Select::make('status')
                                            ->options([
                                                'menunggu' => 'Menunggu',
                                                'aktif' => 'Aktif',
                                                'selesai' => 'Selesai',
                                                'ditolak' => 'Ditolak',
                                            ])
                                            ->label('Status Magang')
                                            ->required()
                                            ->live(), // Penting agar UI langsung merespon
                                        
                                        // Munculkan Pilihan Kategori Alasan
                                        Forms\Components\Select::make('alasan_ditolak')
                                            ->label('Kategori Penolakan')
                                            ->options([
                                                'pengunduran_diri' => 'Pengunduran Diri',
                                                'kuota_penuh' => 'Kuota Tidak Tersedia',
                                                'kompetensi_kurang' => 'Kompetensi Tidak Memenuhi',
                                                'berkas_tidak_valid' => 'Berkas Tidak Valid',
                                                'lainnya' => 'Lainnya',
                                            ])
                                            ->visible(fn (Get $get) => $get('status') === 'ditolak')
                                            ->required(fn (Get $get) => $get('status') === 'ditolak')
                                            ->live(),
                                        
                                        // Munculkan Detail Alasan (Textarea)
                                        Forms\Components\Textarea::make('catatan_admin')
                                            ->label('Detail Catatan / Alasan')
                                            ->placeholder('Masukkan detail tambahan jika diperlukan...')
                                            ->visible(fn (Get $get) => $get('status') === 'ditolak')
                                            ->columnSpanFull(),
                                    ])->columnSpanFull(),
                            ]),
                        ]),


                    
                ])
                ->columnSpanFull() // Agar Tabs memenuhi lebar layar
                ->activeTab(1) // Default buka tab pertama
                ->contained(false)
        ]);
    }

    // buat nampilin data table
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('row_number')->label('No')->rowIndex()->alignCenter(),
                Tables\Columns\TextColumn::make('nama_mahasiswa')->searchable()->sortable()->label('Nama'),
                // Tables\Columns\TextColumn::make('nim')->searchable()->label('NIM'),
                Tables\Columns\TextColumn::make('asal_kampus')->searchable()->label('Kampus'),
                // Tables\Columns\TextColumn::make('fakultas')->searchable()->label('Fakultas'),
                // Tables\Columns\TextColumn::make('prodi')->searchable()->label('Prodi'),
                Tables\Columns\TextColumn::make('division.nama_divisi')->sortable()->label('Divisi'), // sek belum nemu masalah e biar bisa sort dan nampilin divisi
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state, $record): string => match ($state) {
                        'menunggu' => 'gray',
                        'aktif' => 'success',
                        'selesai' => 'info',
                        'ditolak' => $record->alasan_ditolak === 'pengunduran_diri' ? 'black' : 'danger',
                    })
                    ->formatStateUsing(function (string $state, $record) {
                        if ($state === 'ditolak') {
                            // Jika alasannya adalah pengunduran diri, tampilkan "Undur Diri"
                            if ($record->alasan_ditolak === 'pengunduran_diri') {
                                return 'Undur Diri';
                            }
                            // Jika alasan lain, tetap tampilkan "Ditolak"
                            return 'Ditolak';
                        }
                        return ucwords($state);
                    }),
                // Tables\Columns\TextColumn::make('status')->sortable()
                //     ->badge()
                //     ->color(fn (string $state): string => match ($state) {
                //         'menunggu' => 'gray',
                //         'aktif' => 'success',
                //         'selesai' => 'info',
                //         'ditolak' => 'danger',
                //     }),
                    Tables\Columns\TextColumn::make('tgl_mulai')->date('d M Y'),
                    Tables\Columns\TextColumn::make('tgl_berakhir')->date('d M Y'),

                ])
                ->defaultSort('created_at', 'desc')
                ->recordUrl(null)
                ->searchPlaceholder('Cari terkait peserta...')
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
            // ->filters([
            //     // Tables\Filters\SelectFilter::make('division')->relationship('division', 'name'),
            //     // Tables\Filters\SelectFilter::make('status')

            //         Tables\Filters\SelectFilter::make('kampus')
            //             ->searchable()
            //             ->multiple() // Admin bisa pilih lebih dari satu kampus sekaligus
            //             ->label('Asal Kampus'),
                
            //         // Filter Divisi
            //         Tables\Filters\SelectFilter::make('divisi')
            //             ->options([
            //                 'pengembang_aplikasi' => 'Pengembang Aplikasi',
            //                 'admin_perkantoran' => 'Admin Perkantoran',
            //             ]),
            // ]);
            // ->actions([
            //     // Tables\Actions\EditAction::make(),
            //     // Tables\Actions\DeleteAction::make(), filament v3
            // ])
            //->bulkActions([
            //     // Tables\Actions\BulkActionGroup::make([
            //     //     Tables\Actions\DeleteBulkAction::make(), filament v3
            //     // ]),
            // ]);
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
            'index' => Pages\ListInterns::route('/'),
            'create' => Pages\CreateIntern::route('/create'),
            // 'view' => Pages\ViewIntern::route('/{record}'), // Tambahkan ini
            'edit' => Pages\EditIntern::route('/{record}/edit'),
        ];
    }
}