<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Division;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        // Ambil divisi yang kuotanya masih ada
        // (Asumsi di model Division ada accessor remaining_quota, jika tidak, pakai raw query)
        $divisions = Division::whereRaw('used_quota < total_quota')->get(); 
        return view('special_pages.register', compact('divisions'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Sesuai kolom di tabel interns)
        $validated = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim'            => 'required|string|max:50',
            'asal_kampus'    => 'required|string|max:255',
            'fakultas'       => 'required|string',
            'prodi'          => 'required|string',
            'email_peserta'  => 'required|email',
            'no_telp_peserta'=> 'required|numeric',
            
            // Data Pembimbing
            'nama_pembimbing'      => 'required|string',
            'nip'                  => 'required|string',
            'no_telp_pembimbing'   => 'required|numeric',
            
            // Magang
            'division_id'    => 'required|exists:divisions,id',
            'tgl_mulai'      => 'required|date',
            'tgl_berakhir'   => 'required|date|after:tgl_mulai',
            
            // File Upload (Validasi PDF/Image max 2MB)
            'pasfoto_path'   => 'required|image|max:2048',
            'cv_path'        => 'required|file|mimes:pdf|max:2048',
            'ktm_path'       => 'required|image|max:2048',
            'proposal_path'  => 'required|file|mimes:pdf|max:5120', // Proposal mungkin agak besar
            'surat_permohonan_path' => 'required|file|mimes:pdf|max:2048',
        ]);

        // 2. Upload File (Simpan di public storage sesuai direktori Filament)
        $files = ['pasfoto_path', 'cv_path', 'ktm_path', 'proposal_path', 'surat_permohonan_path'];
        
        // Mapping nama folder agar rapi (sesuai InternResource)
        $folders = [
            'pasfoto_path' => 'pasfoto',
            'cv_path' => 'cv',
            'ktm_path' => 'ktm',
            'proposal_path' => 'proposal',
            'surat_permohonan_path' => 'surat-permohonan'
        ];

        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $validated[$fileKey] = $request->file($fileKey)->store($folders[$fileKey], 'public');
            }
        }

        // 3. Set Status Default
        $validated['status'] = 'menunggu';

        // 4. ... kode simpan data ...
        Intern::create($validated);

        // 5. Redirect ke halaman sukses dengan membawa nama
        return redirect()->route('register.success', ['nama' => $validated['nama_mahasiswa']]);
    }
}