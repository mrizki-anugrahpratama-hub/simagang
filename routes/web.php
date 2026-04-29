<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReviewController;

use App\Models\Intern;

// if (app()->environment('local')) {
//     Route::prefix('email-preview')->group(function () {
        
//         Route::get('/registration', function () {
//             // Ambil satu data dummy atau data asli dari database
//             $intern = new Intern([
//                 'nama_mahasiswa' => 'Budi Santoso',
//                 'nim' => '210411100001',
//                 'no_telp_peserta' => '08123456789',
//                 'email_peserta' => 'rizkiap997@gmail.com',
//                 'asal_kampus' => 'Universitas Brawijaya',
//                 'fakultas' => 'Teknik',
//                 'prodi' => 'Informatika',
//                 'tgl_mulai' => now(),
//                 'tgl_berakhir' => now()->addMonths(3),
//                 'nama_pembimbing' => 'Dr. Ir. Ahmad',
//                 'no_telp_pembimbing' => '08998877665',
//             ]);

//             return view('emails.registration', compact('intern')); // Sesuaikan path folder view Anda
//         });

//         Route::get('/accepted', function () {
//             $intern = Intern::first(); 
//             return view('emails.accepted', compact('intern'));
//         });

//         Route::get('/rejected', function () {
//             $intern = Intern::first();
//             return view('emails.rejected', compact('intern'));
//         });

//         Route::get('/finished', function () {
//             $intern = Intern::first();
//             $url = url('/review/1'); // Contoh URL review
//             return view('emails.finished', compact('intern', 'url'));
//         });

//         Route::get('/certificate', function () {
//             $intern = Intern::first();
//             return view('emails.certificate', compact('intern'));
//         });
//     });
// }

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route Pendaftaran
Route::get('/daftar', [RegistrationController::class, 'index'])->name('register.index');
Route::post('/daftar', [RegistrationController::class, 'store'])->name('register.store');

// Pendaftaran Berhasil
Route::get('/pendaftaran-berhasil', function () {
    return view('special_pages.success_register');
})->name('register.success');

// Route Review
Route::get('/review/{intern}', [ReviewController::class, 'create'])->name('review.create');
Route::post('/review/{intern}', [ReviewController::class, 'store'])->name('review.store');

// Review Berhasil
Route::get('/review-sukses/{intern}', [ReviewController::class, 'success'])->name('review.success');
