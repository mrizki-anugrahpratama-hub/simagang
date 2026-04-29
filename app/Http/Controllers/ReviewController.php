<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Review;
use App\Mail\CertificateDeliveryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // <--- TAMBAHKAN INI WAJIB

class ReviewController extends Controller
{
    // Halaman Form Review
    public function create(Intern $intern)
    {
        if ($intern->status !== 'selesai') {
            return redirect('/')->with('error', 'Program magang belum selesai.');
        }

        // Gunakan pengecekan yang sama dengan method success
        $existing = Review::where('intern_id', $intern->id)->exists();
        if ($existing) {
             return redirect()->route('review.success', $intern->id);
        }

        return view('special_pages.review', compact('intern'));
    }

    // Simpan Data
    public function store(Request $request, Intern $intern)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        Review::create([
            'intern_id'     => $intern->id,
            'nama_reviewer' => $intern->nama_mahasiswa, // Autofill
            'asal_kampus'   => $intern->asal_kampus,    // Autofill
            'tgl_review'    => now(),
            'rating'        => $validated['rating'],
            'content'       => $validated['content'],
            'foto_profil'   => $intern->pasfoto_path,   
            'is_visible'    => true
        ]);

        // Kirim Email Sertifikat
        Mail::to($intern->email_peserta)->send(new CertificateDeliveryMail($intern));

        // Redirect ke halaman sukses khusus review
        return redirect()->route('review.success', $intern->id);
    }

    // Halaman Sukses & Download
    public function success(Intern $intern)
    {
        // Gunakan exists() untuk memastikan data benar-benar ada di tabel reviews
        $hasReview = Review::where('intern_id', $intern->id)->exists();
        
        if (!$hasReview) {
            return redirect()->route('review.create', $intern->id);
        }
    
        return view('special_pages.success_review', compact('intern'));
    }
}