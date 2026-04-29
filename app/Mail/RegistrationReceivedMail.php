<?php

namespace App\Mail;

use App\Models\Intern;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $intern; // Variabel ini nanti dibaca di HTML

    public function __construct(Intern $intern)
    {
        $this->intern = $intern;
    }

    // public function build()
    // {
    //     return $this->subject('Pendaftaran Magang Berhasil - Menunggu Verifikasi')
    //                 ->view('emails.registration'); // Kita akan buat file view ini nanti
    // }

    // // app/Mail/RegistrationReceivedMail.php

    public function build()
    {
        $email = $this->subject('Salinan Pendaftaran Magang - Bakorwil III Malang')
                      ->view('emails.registration');

        // Daftar field berkas yang ingin dikirim balik ke user
        $files = [
            'cv_path' => 'CV_Lengkap.pdf',
            'ktm_path' => 'Scan_KTM.png',
            'proposal_path' => 'Proposal_Magang.pdf',
            'surat_permohonan_path' => 'Surat_Permohonan.pdf'
        ];

        foreach ($files as $field => $filename) {
            if ($this->intern->$field) {
                $path = storage_path('app/public/' . $this->intern->$field);

                if (file_exists($path)) {
                    $email->attach($path, [
                        'as' => $filename,
                    ]);
                }
            }
        }

        return $email;
    }
}