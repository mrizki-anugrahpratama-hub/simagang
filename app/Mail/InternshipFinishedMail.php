<?php

namespace App\Mail;

use App\Models\Intern;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class InternshipFinishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $intern;
    public $url;

    public function __construct(Intern $intern)
    {
        $this->intern = $intern;
        
        // Generate Link Review
        // Jika pakai route biasa: route('review.create', $intern->id)
        // Jika mau aman pakai Signed Route (Link kadaluarsa/unik):
        // $this->reviewUrl = URL::signedRoute('review.create', ['intern' => $intern->id]);
        
        // Kita pakai route biasa dulu sesuai setup kita sebelumnya:
        $this->url = route('review.create', $intern->id);
    }

    public function build()
    {
        return $this->subject('Masa Magang Berakhir - Silakan Isi Ulasan')
                    ->view('emails.finished'); // Kita buat view html-nya di langkah selanjutnya
    }
}