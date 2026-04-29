<?php

namespace App\Mail;

use App\Models\Intern; // <--- JANGAN LUPA IMPORT MODEL INI
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateDeliveryMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Definisikan variable public agar bisa dibaca di view & build
    public $intern;

    /**
     * Create a new message instance.
     */
    // 2. Terima parameter $intern di sini
    public function __construct(Intern $intern)
    {
        $this->intern = $intern;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // 3. Pastikan view-nya benar (emails.certificate)
        $email = $this->subject('Terima Kasih - Dokumen Penyelesaian Magang')
                      ->view('emails.certificate'); 
    
        // Attach Sertifikat
        if ($this->intern->sertifikat_path) {
            $fullPath = storage_path('app/public/' . $this->intern->sertifikat_path);
            if(file_exists($fullPath)) {
                $email->attach($fullPath);
            }
        }
        
        // Attach Surat Pengembalian
        if ($this->intern->surat_pengembalian_path) {
            $fullPath = storage_path('app/public/' . $this->intern->surat_pengembalian_path);
            if(file_exists($fullPath)) {
                $email->attach($fullPath);
            }
        }
    
        return $email;
    }
}