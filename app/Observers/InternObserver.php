<?php

namespace App\Observers;

use App\Models\Intern;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // <--- TAMBAHKAN BARIS INI BOLO!
use App\Mail\RegistrationReceivedMail;
use App\Mail\InternshipAcceptedMail;
use App\Mail\InternshipFinishedMail;
use App\Mail\InternshipRejectedMail;

class InternObserver
{
    public function created(Intern $intern)
    {
        if ($intern->email_peserta) {
            try {
                Mail::to($intern->email_peserta)->send(new RegistrationReceivedMail($intern));
            } catch (\Exception $e) {
                // Hapus backslash (\) di depan Log karena sudah di-import
                Log::error("Gagal kirim email pendaftaran: " . $e->getMessage()); 
            }
        }
    }

    public function updated(Intern $intern)
    {
        if ($intern->isDirty('status')) {
            
            $newStatus = $intern->status;
            $oldStatus = $intern->getOriginal('status');

            // 1. DITERIMA
            if ($newStatus === 'aktif' && $oldStatus !== 'aktif') {
                if ($intern->email_peserta) {
                    try {
                        Mail::to($intern->email_peserta)->send(new InternshipAcceptedMail($intern));
                    } catch (\Exception $e) {
                        Log::error("Gagal kirim email diterima: " . $e->getMessage());
                    }
                }
            }

            // 2. SELESAI
            if ($newStatus === 'selesai' && $oldStatus !== 'selesai') {
                if ($intern->email_peserta) {
                    try {
                        Mail::to($intern->email_peserta)->send(new InternshipFinishedMail($intern));
                    } catch (\Exception $e) {
                        Log::error("Gagal kirim email selesai: " . $e->getMessage());
                    }
                }
            }

            // 3: DITOLAK (Pending -> Ditolak)
            if ($newStatus === 'ditolak') {
                if ($intern->email_peserta) {
                    try {
                        Mail::to($intern->email_peserta)->send(new InternshipRejectedMail($intern));
                    } catch (\Exception $e) {
                        Log::error("Gagal kirim email ditolak: " . $e->getMessage());
                    }
                }
            }
        }
    }
}