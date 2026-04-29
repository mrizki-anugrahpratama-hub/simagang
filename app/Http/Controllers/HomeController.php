<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Intern; 
use App\Models\Division;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::published()
            ->latest()
            ->take(5) // ngambil 6 review terbaru
            ->get();

        // ==========================================
        // 1. DATA UNTUK TABEL & PENCARIAN
        // ==========================================
        
        // Filter Global: Hanya ambil data yang statusnya 'aktif' atau 'selesai'
        $query = Intern::with('division')
            ->whereIn('status', ['aktif', 'selesai']); // <--- KUNCINYA DI SINI

        // A. Logika Search (Nama, NIM, Kampus)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_mahasiswa', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('asal_kampus', 'like', "%{$search}%");
            });
        }

        // B. Logika Filter Status (Di Frontend)
        // Kita batasi opsi filternya biar user nggak iseng cari 'pending' lewat URL
        if ($request->has('filter_status') && in_array($request->filter_status, ['aktif', 'selesai'])) {
            $query->where('status', $request->filter_status);
        }

        // C. Logika Filter Divisi
        if ($request->has('filter_division') && $request->filter_division != '') {
            $query->where('division_id', $request->filter_division);
        }

        // D. Logika Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc': $query->orderBy('nama_mahasiswa', 'asc'); break;
                case 'name_desc': $query->orderBy('nama_mahasiswa', 'desc'); break;
                case 'date_newest': $query->orderBy('created_at', 'desc'); break;
                case 'date_oldest': $query->orderBy('created_at', 'asc'); break;
                default: $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // pagination
        $interns = $query->paginate(10)->withQueryString(); 
        $divisions = Division::all();

        // Ambil semua tahun yang ada di database (Unique)
        // Gunakan Raw SQL yang support SQLite/MySQL agar aman
        // $years = Intern::selectRaw('YEAR(tgl_mulai) as year')
        //     ->distinct()
        //     ->orderBy('year', 'asc') // Urutkan dari tahun lama ke baru
        //     ->pluck('year')
        //     ->toArray();

        // // Ambil data jumlah per tahun & status
        // $rawData = Intern::selectRaw('YEAR(tgl_mulai) as year, status, count(*) as total')
        //     ->whereIn('status', ['aktif', 'selesai'])
        //     ->groupBy('year', 'status')
        //     ->get();

        // 1. Tentukan string SQL untuk menghitung "Tahun Dominan" (Titik Tengah)
        // Rumus: Tahun dari (tgl_mulai + (selisih hari / 2))
        $dominantYearSql = "YEAR(DATE_ADD(tgl_mulai, INTERVAL DATEDIFF(tgl_berakhir, tgl_mulai) / 2 DAY))";

        // 2. Ambil semua daftar tahun dominan yang unik untuk label sumbu X
        $years = Intern::selectRaw("$dominantYearSql as year")
            ->whereIn('status', ['aktif', 'selesai'])
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year')
            ->toArray();

        // 3. Ambil data jumlah berdasarkan tahun dominan dan status
        $rawData = Intern::selectRaw("$dominantYearSql as year, status, count(*) as total")
            ->whereIn('status', ['aktif', 'selesai'])
            ->groupBy('year', 'status')
            ->get();

        // Siapkan Array Data untuk Chart.js
        $chartYearsLabels = $years; // Label Sumbu X (2023, 2024, ...)
        $dataAktif = [];
        $dataSelesai = [];

        foreach ($years as $year) {
            // Cari jumlah 'aktif' di tahun tersebut
            $aktif = $rawData->where('year', $year)->where('status', 'aktif')->first();
            $dataAktif[] = $aktif ? $aktif->total : 0;

            // Cari jumlah 'selesai' di tahun tersebut
            $selesai = $rawData->where('year', $year)->where('status', 'selesai')->first();
            $dataSelesai[] = $selesai ? $selesai->total : 0;
        }

        // Grafik Kampus: Ambil dari mahasiswa aktif/selesai saja
        $kampusStats = Intern::whereIn('status', ['aktif', 'selesai']) // <--- FILTER JUGA DI SINI
            ->select('asal_kampus', DB::raw('count(*) as total'))
            ->groupBy('asal_kampus')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'asal_kampus')
            ->toArray();

        $chartKampusLabels = array_keys($kampusStats);
        $chartKampusValues = array_values($kampusStats);

        return view('pages.home', compact(
            'reviews',
            'interns', 
            'divisions', 
            'chartYearsLabels', // Variable Baru
            'dataAktif',        // Variable Baru
            'dataSelesai',      // Variable Baru
            'chartKampusLabels',
            'chartKampusValues'
        ));
    }
}
