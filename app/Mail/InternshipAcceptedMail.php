<?php

namespace App\Mail;

use App\Models\Intern;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage; // Penting

class InternshipAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $intern;

    public function __construct(Intern $intern)
    {
        $this->intern = $intern;
    }

    public function build()
    {
        $email = $this->subject('Selamat! Anda Diterima Magang di Bakorwil III Malang')
                      ->view('emails.accepted'); // Nanti kita buat view ini

        // Cek apakah Admin sudah upload surat balasan
        if ($this->intern->surat_balasan_magang_path) {
            // Ambil full path file di storage
            $fullPath = storage_path('app/public/' . $this->intern->surat_balasan_magang_path);

            // Validasi file fisik ada atau tidak
            if (file_exists($fullPath)) {
                $email->attach($fullPath, [
                    'as' => 'Surat_Balasan_Resmi.pdf', // Nama file saat didownload user
                    'mime' => 'application/pdf',
                ]);
            }
        }

        return $email;
    }
}