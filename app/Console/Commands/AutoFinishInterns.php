<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Intern;
use Illuminate\Support\Facades\Log;

class AutoFinishInterns extends Command
{
    /**
     * Nama perintah yang nanti diketik di terminal.
     */
    protected $signature = 'intern:finish';

    /**
     * Penjelasan singkat command ini.
     */
    protected $description = 'Otomatis mengubah status peserta magang menjadi selesai jika tanggal berakhir sudah lewat';

    /**
     * Logic utama robot ada di sini.
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');
        
        $this->info("Menjalankan pengecekan magang berakhir pada tanggal: $today");

        // Cari mahasiswa yang status 'aktif' TAPI tgl_berakhir-nya kurang dari hari ini
        // Artinya kemarin adalah hari terakhir mereka.
        $interns = Intern::where('status', 'aktif')
                         ->where('tgl_berakhir', '<', $today)
                         ->get();

        if ($interns->isEmpty()) {
            $this->info('Tidak ada peserta magang yang selesai hari ini.');
            return;
        }

        $count = 0;
        foreach ($interns as $intern) {
            // Kita update statusnya jadi 'selesai'.
            // MAGIC HAPPENS HERE:
            // Saat update(), InternObserver akan mendeteksi perubahan status
            // dan OTOMATIS mengirim email 'InternshipFinishedMail' (Link Review).
            $intern->update(['status' => 'selesai']);
            
            $this->info("Berhasil update status: {$intern->nama_mahasiswa}");
            $count++;
        }

        // Catat di Log biar admin tau robotnya kerja
        Log::info("Scheduler: Berhasil menyelesaikan masa magang $count peserta.");
        $this->info("Selesai! Total $count peserta telah diupdate.");
    }
}