<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Division;
use App\Models\Intern;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // 0. BUAT AKUN ADMIN UNTUK LOGIN
        User::create([
            'name' => 'Admin Bakorwil',
            'email' => 'admin@simagang.com',
            'password' => Hash::make('qwerty'),
        ]);

        // 1. SEEDER DIVISI (30 Data)
        $divisiNames = [
            'Pengembang Aplikasi', 'Administrasi Perkantoran', 'Pelayanan Publik', 
            'Manajemen Media Sosial', 'Administrasi Keuangan'
        ];

        $icons = ['admin', 'code', 'user', 'chat', 'dollar'];
        $colors = ['blue', 'purple', 'green', 'pink', 'orange'];

        foreach ($divisiNames as $name) {
            Division::create([
                'nama_divisi' => $name,
                'competency' => 'Kompetensi di bidang ' . $name,
                'icon_type' => $faker->randomElement($icons),
                'color_scheme' => $faker->randomElement($colors),
                'total_quota' => $faker->numberBetween(1, 10),
                'used_quota' => 0, // Akan terupdate otomatis via Model Intern
                'updated_date' => now(),
            ]);
        }

        // 2. SEEDER PESERTA MAGANG (30 Data)
        $universities = [
            'Universitas Brawijaya', 'Universitas Negeri Malang', 'UIN Maulana Malik Ibrahim Malang',
            'Politeknik Negeri Malang', 'Universitas Muhammadiyah Malang', 'Universitas Islam Malang',
            'Institut Teknologi Sepuluh Nopember', 'Universitas Airlangga', 'Universitas Gadjah Mada'
        ];

        $statuses = ['menunggu', 'aktif', 'selesai', 'ditolak'];
        $divisions = Division::all();

        for ($i = 0; $i < 30; $i++) {
            $startDate = Carbon::now()->addMonths($faker->numberBetween(-5, 2));
            $endDate = (clone $startDate)->addMonths($faker->numberBetween(1, 3));
            $status = $faker->randomElement($statuses);

            $intern = Intern::create([
                'nama_mahasiswa' => $faker->name(),
                'nim' => $faker->numerify('##########'),
                'asal_kampus' => $faker->randomElement($universities),
                'fakultas' => 'Fakultas ' . $faker->word(),
                'prodi' => 'Program Studi ' . $faker->word(),
                'email_peserta' => $faker->unique()->safeEmail(),
                'no_telp_peserta' => $faker->phoneNumber(),
                'nama_pembimbing' => $faker->name('male'),
                'nip' => $faker->numerify('19##########'),
                'no_telp_pembimbing' => $faker->phoneNumber(),
                'division_id' => $divisions->random()->id,
                'tgl_mulai' => $startDate,
                'tgl_berakhir' => $endDate,
                'status' => $status,
                'pasfoto_path' => null,
                'cv_path' => null,
                'ktm_path' => null,
                'proposal_path' => null,
                'surat_permohonan_path' => null,
            ]);

            // 3. SEEDER ULASAN (Hanya untuk yang statusnya 'selesai')
            // Minimal 30 ulasan total, jadi kita buat beberapa ulasan dummy 
            // Meskipun status intern tidak 'selesai' untuk simulasi presentasi.
            if ($status === 'selesai' || $i < 15) { 
                Review::create([
                    'intern_id' => $intern->id,
                    'nama_reviewer' => $intern->nama_mahasiswa,
                    'asal_kampus' => $intern->asal_kampus,
                    'tgl_review' => $endDate->addDays($faker->numberBetween(1, 5)),
                    'rating' => $faker->numberBetween(3, 5),
                    'content' => $faker->paragraph(rand(3, 5), true),
                    'is_visible' => $faker->boolean(80), // 80% tayang
                ]);
            }
        }
    }
}