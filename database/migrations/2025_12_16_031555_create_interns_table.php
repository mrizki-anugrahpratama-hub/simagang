<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // fungsi untuk buat table database
    public function up(): void
    {
        Schema::create('interns', function (Blueprint $table) {
            $table->string('id', 20)->primary();

            // Identitas peserta
            $table->string('nama_mahasiswa');
            $table->string('nim');
            $table->string('asal_kampus');                              // Asal Kampus
            $table->string('fakultas')->nullable();                     // Fakultas
            $table->string('prodi')->nullable();                        // Prodi
            $table->string('email_peserta');
            $table->string('no_telp_peserta');  

            // Identitas pembimbing
            $table->string('nama_pembimbing');
            $table->string('nip');
            $table->string('no_telp_pembimbing');  
            
            // Status Magang
            $table->string('division_id', 20)->nullable()->index();      // Relasi ke Divisi
            $table->date('tgl_mulai');
            $table->date('tgl_berakhir');
            $table->string('status')->default('pending');               // pending, aktif, selesai, ditolak
            $table->string('alasan_ditolak')->nullable();
            $table->text('catatan_admin')->nullable();
            
            // File Dokumen Pra Magang
            $table->string('pasfoto_path')->nullable();                 // Foto Profil
            $table->string('cv_path')->nullable();                      // CV
            $table->string('ktm_path')->nullable();                     // KTM
            $table->string('proposal_path')->nullable();                // Proposal
            $table->string('surat_permohonan_path')->nullable();        // Surat Permohonan

            // File Dokumen Pasca Magang
            $table->string('surat_balasan_magang_path')->nullable();    // Surat Balasan
            $table->string('surat_pengembalian_path')->nullable();      // Surat Pengembalian
            $table->string('sertifikat_path')->nullable();              // Sertifikat
            $table->string('form_penilaian_path')->nullable();          // Form Penilaian
            
            $table->timestamps();

            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
