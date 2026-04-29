<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Magang - Bakorwil III Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-prov-jatim.png') }}" />
    <style>
        [x-cloak] { display: none !important; }
        /* Kustomisasi scrollbar untuk preview PDF */
        iframe::-webkit-scrollbar { width: 5px; }
    </style>
</head>
<body class="bg-gray-50 py-8 min-h-screen font-sans">
    <div class="w-full max-w-4xl mx-auto px-4">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo-bakorwil-malang.png') }}" 
                     alt="Logo Bakorwil III Malang" 
                     class="h-16 w-auto drop-shadow-md">
            </div>

            <h2 class="text-3xl font-extrabold text-gray-900">Formulir Pendaftaran Magang</h2>
            <p class="text-gray-500 mt-2">Lengkapi data di bawah ini dengan benar dan teliti.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" 
             x-data="registrationForm()">
            
            {{-- Progress Bar --}}
            <div class="bg-gray-100 h-2 w-full">
                <div class="h-full bg-blue-600 transition-all duration-500 ease-out"
                     :style="'width: ' + ((step / 4) * 100) + '%'"></div>
            </div>

            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf

                {{-- STEP 1: IDENTITAS DIRI --}}
                <div x-show="step === 1" x-transition>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span>
                        Identitas Pribadi & Akademik
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_mahasiswa" x-model="formData.nama_mahasiswa" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required placeholder="Sesuai KTP/KTM">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" name="nim" x-model="formData.nim" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. WhatsApp</label>
                            <input type="text" name="no_telp_peserta" x-model="formData.no_telp_peserta" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required placeholder="08...">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Email Aktif</label>
                            <input type="email" name="email_peserta" x-model="formData.email_peserta" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Asal Kampus</label>
                            <input type="text" name="asal_kampus" x-model="formData.asal_kampus" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fakultas</label>
                            <input type="text" name="fakultas" x-model="formData.fakultas" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <input type="text" name="prodi" x-model="formData.prodi" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                    </div>
                </div>

                {{-- STEP 2: POSISI & PEMBIMBING --}}
                <div x-show="step === 2" x-cloak x-transition>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">2</span>
                        Info Magang & Dosen
                    </h3>
                    <div class="space-y-4">
                         <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <label class="block text-sm font-medium text-blue-900 mb-1">Pilih Divisi Tujuan</label>
                            <select name="division_id" x-model="formData.division_id" @change="updateDivisionName($event)" class="w-full border p-2 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                                <option value="">-- Pilih Divisi --</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}">{{ $div->nama_divisi }} (Kuota: {{ $div->remaining_quota }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tgl Mulai</label>
                                <input type="date" name="tgl_mulai" x-model="formData.tgl_mulai" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tgl Selesai</label>
                                <input type="date" name="tgl_berakhir" x-model="formData.tgl_berakhir" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            </div>
                        </div>
                        
                        {{-- <div class="relative py-4">
                            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-300"></div></div>
                            <div class="relative flex justify-center"><span class="px-2 bg-white text-sm text-gray-500">Data Dosen Pembimbing</span></div>
                        </div> --}}

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                             <div class="md:col-span-2">
                                 <label class="block text-sm font-medium text-gray-700">Nama Dosen Pembimbing</label>
                                 <input type="text" name="nama_pembimbing" x-model="formData.nama_pembimbing" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-gray-700">NIP / NIDN</label>
                                 <input type="text" name="nip" x-model="formData.nip" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-gray-700">No. HP Dosen</label>
                                 <input type="text" name="no_telp_pembimbing" x-model="formData.no_telp_pembimbing" class="w-full border p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required placeholder="08...">
                             </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 3: UPLOAD BERKAS --}}
                <div x-show="step === 3" x-cloak x-transition>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">3</span>
                        Upload Berkas
                    </h3>
                    <p class="text-sm text-red-500 mb-6 bg-red-50 p-2 rounded border border-red-200">
                        * Maksimal ukuran setiap file adalah <strong>2MB</strong>.
                    </p>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pasfoto (Wajib)</label>
                                <div class="mb-3 h-40 flex items-center justify-center overflow-hidden bg-white rounded border border-gray-200">
                                    <template x-if="files.pasfoto.url">
                                        <img :src="files.pasfoto.url" class="h-full object-contain">
                                    </template>
                                    <template x-if="!files.pasfoto.url">
                                        <div class="text-center">
                                            <span class="text-gray-400 text-xs block">Preview Foto</span>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" name="pasfoto_path" accept="image/*" class="text-xs w-full" 
                                       @change="handleFile($event, 'pasfoto')" required>
                                <p x-show="files.pasfoto.error" x-text="files.pasfoto.error" class="text-xs text-red-600 mt-1"></p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Scan KTM (Wajib)</label>
                                <div class="mb-3 h-40 flex items-center justify-center overflow-hidden bg-white rounded border border-gray-200">
                                    <template x-if="files.ktm.url">
                                        <img :src="files.ktm.url" class="h-full object-contain">
                                    </template>
                                    <template x-if="!files.ktm.url">
                                        <div class="text-center">
                                            <span class="text-gray-400 text-xs block">Preview KTM</span>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" name="ktm_path" accept="image/*" class="text-xs w-full" 
                                       @change="handleFile($event, 'ktm')" required>
                                <p x-show="files.ktm.error" x-text="files.ktm.error" class="text-xs text-red-600 mt-1"></p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="border rounded-lg p-4 bg-gray-50">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Curriculum Vitae (PDF)</label>
                                <input type="file" name="cv_path" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-2" 
                                       @change="handleFile($event, 'cv')" required>
                                <p x-show="files.cv.error" x-text="files.cv.error" class="text-xs text-red-600 mb-2"></p>
                                
                                <template x-if="files.cv.url">
                                    <div class="mt-2 h-48 w-full border border-gray-200 bg-white rounded overflow-hidden relative group">
                                         <embed :src="files.cv.url" type="application/pdf" class="w-full h-full">
                                         <a :href="files.cv.url" target="_blank" class="absolute top-2 right-2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Buka Full</a>
                                    </div>
                                </template>
                            </div>

                            <div class="border rounded-lg p-4 bg-gray-50">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Proposal Magang (PDF)</label>
                                <input type="file" name="proposal_path" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-2" 
                                       @change="handleFile($event, 'proposal')" required>
                                <p x-show="files.proposal.error" x-text="files.proposal.error" class="text-xs text-red-600 mb-2"></p>
                                
                                <template x-if="files.proposal.url">
                                    <div class="mt-2 h-48 w-full border border-gray-200 bg-white rounded overflow-hidden relative group">
                                         <embed :src="files.proposal.url" type="application/pdf" class="w-full h-full">
                                    </div>
                                </template>
                            </div>

                            <div class="border rounded-lg p-4 bg-gray-50">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Surat Permohonan (PDF)</label>
                                <input type="file" name="surat_permohonan_path" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mb-2" 
                                       @change="handleFile($event, 'surat')" required>
                                <p x-show="files.surat.error" x-text="files.surat.error" class="text-xs text-red-600 mb-2"></p>
                                
                                <template x-if="files.surat.url">
                                    <div class="mt-2 h-48 w-full border border-gray-200 bg-white rounded overflow-hidden relative group">
                                         <embed :src="files.surat.url" type="application/pdf" class="w-full h-full">
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 4: CEK & KONFIRMASI (LENGKAP) --}}
                <div x-show="step === 4" x-cloak x-transition>
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-green-100 text-green-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">✓</span>
                        Cek & Konfirmasi
                    </h3>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 text-sm text-yellow-700">
                        Pastikan semua data sudah benar. Data tidak dapat diubah setelah dikirim.
                    </div>

                    <div class="space-y-6 text-sm">
                        
                        {{-- 1. Identitas --}}
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h4 class="font-bold text-gray-800 border-b pb-2 mb-3">I. Identitas Pribadi</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                                <div><span class="text-gray-500 block">Nama Lengkap</span><span class="font-medium text-gray-900" x-text="formData.nama_mahasiswa"></span></div>
                                <div><span class="text-gray-500 block">NIM</span><span class="font-medium text-gray-900" x-text="formData.nim"></span></div>
                                <div><span class="text-gray-500 block">Email</span><span class="font-medium text-gray-900" x-text="formData.email_peserta"></span></div>
                                <div><span class="text-gray-500 block">No. WhatsApp</span><span class="font-medium text-gray-900" x-text="formData.no_telp_peserta"></span></div>
                                <div><span class="text-gray-500 block">Kampus</span><span class="font-medium text-gray-900" x-text="formData.asal_kampus"></span></div>
                                <div><span class="text-gray-500 block">Fakultas / Prodi</span><span class="font-medium text-gray-900" x-text="formData.fakultas + ' / ' + formData.prodi"></span></div>
                            </div>
                        </div>

                        {{-- 2. Magang & Dosen --}}
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h4 class="font-bold text-gray-800 border-b pb-2 mb-3">II. Informasi Magang & Dosen</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                                <div class="col-span-2"><span class="text-gray-500 block">Divisi Tujuan</span><span class="font-bold text-blue-600" x-text="formData.nama_divisi"></span></div>
                                <div><span class="text-gray-500 block">Periode Magang</span><span class="font-medium text-gray-900" x-text="formatDate(formData.tgl_mulai) + ' s.d ' + formatDate(formData.tgl_berakhir)"></span></div>
                                <div><span class="text-gray-500 block">Nama Dosen</span><span class="font-medium text-gray-900" x-text="formData.nama_pembimbing"></span></div>
                                <div><span class="text-gray-500 block">NIP/NIDN</span><span class="font-medium text-gray-900" x-text="formData.nip"></span></div>
                                <div><span class="text-gray-500 block">No. HP Dosen</span><span class="font-medium text-gray-900" x-text="formData.no_telp_pembimbing"></span></div>
                            </div>
                        </div>

                        {{-- 3. Berkas --}}
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <h4 class="font-bold text-gray-800 border-b pb-2 mb-3">III. Kelengkapan Berkas</h4>
                            <ul class="space-y-2">
                                <template x-for="(file, key) in files" :key="key">
                                    <li class="flex justify-between items-center bg-white p-2 rounded border border-gray-100">
                                        <div class="flex items-center gap-2">
                                            <span class="text-green-500 font-bold">✓</span>
                                            <span class="capitalize text-gray-700" x-text="getFileLabel(key)"></span>
                                            <span class="text-xs text-gray-400" x-text="'(' + (file.name ? file.name : 'Belum upload') + ')'"></span>
                                        </div>
                                        <template x-if="file.url">
                                            <a :href="file.url" target="_blank" class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded hover:bg-blue-200">Lihat</a>
                                        </template>
                                    </li>
                                </template>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="mt-8 flex justify-between pt-6 border-t border-gray-100">
                    <button type="button" x-show="step > 1" @click="step--" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">Kembali</button>
                    <div x-show="step === 1"></div>
                    
                    <button type="button" x-show="step < 4" @click="validateAndNext()" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-md transition">Selanjutnya</button>
                    
                    <button type="submit" x-show="step === 4" class="px-8 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white font-bold rounded-lg hover:from-green-600 hover:to-green-700 shadow-lg transform hover:scale-105 transition flex items-center gap-2">
                        <span>Kirim Pendaftaran</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="text-center mt-6 text-gray-400 text-sm">
            &copy; {{ date('Y') }} Bakorwil III Malang. All rights reserved.
        </div>
    </div>

    <script>
        function registrationForm() {
            return {
                step: 1,
                // Struktur data file yang lebih lengkap untuk preview & validasi
                files: {
                    pasfoto: { url: null, name: null, type: null, error: null },
                    ktm: { url: null, name: null, type: null, error: null },
                    cv: { url: null, name: null, type: null, error: null },
                    proposal: { url: null, name: null, type: null, error: null },
                    surat: { url: null, name: null, type: null, error: null }
                },
                formData: {
                    nama_mahasiswa: '', nim: '', no_telp_peserta: '', email_peserta: '',
                    asal_kampus: '', fakultas: '', prodi: '',
                    division_id: '', nama_divisi: '-',
                    tgl_mulai: '', tgl_berakhir: '',
                    nama_pembimbing: '', nip: '', no_telp_pembimbing: ''
                },
                
                // Helper untuk mendapatkan nama divisi dari dropdown
                updateDivisionName(event) {
                    const select = event.target;
                    const text = select.options[select.selectedIndex].text;
                    // Hapus info kuota dari teks jika ada, misal "IT (Sisa: 2)" -> "IT"
                    this.formData.nama_divisi = text.split(' (')[0]; 
                },

                // 2. VALIDASI SIZE & 3. PREVIEW PDF/IMAGE
                handleFile(event, key) {
                    const file = event.target.files[0];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    // Reset state
                    this.files[key].error = null;
                    
                    if (file) {
                        // Cek Ukuran (4. Validasi Ukuran)
                        if (file.size > maxSize) {
                            this.files[key].error = 'Ukuran file terlalu besar (Max 2MB).';
                            this.files[key].url = null;
                            this.files[key].name = null;
                            event.target.value = ''; // Reset input file
                            return; 
                        }

                        // Set Data
                        this.files[key].name = file.name;
                        this.files[key].type = file.type;
                        this.files[key].url = URL.createObjectURL(file);
                    }
                },

                validateAndNext() {
                    let isValid = true;
                    // Ambil input pada step yang sedang aktif
                    const container = document.querySelector(`div[x-show="step === ${this.step}"]`);
                    if(!container) return;

                    const inputs = container.querySelectorAll('input, select');
                    
                    inputs.forEach(input => {
                        // Cek required html native
                        if (input.hasAttribute('required') && !input.value) {
                            isValid = false;
                            input.classList.add('border-red-500', 'ring-1', 'ring-red-500');
                        } else {
                            input.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
                        }
                    });

                    // Cek error file manual (jika ada file yang error size tapi user tetap klik next)
                    if (this.step === 3) {
                        for (const key in this.files) {
                            if (this.files[key].error) isValid = false;
                        }
                    }

                    if (isValid) {
                        this.step++;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } else {
                        alert('Mohon lengkapi data wajib dan pastikan tidak ada error pada file.');
                    }
                },

                // Helper Formatting
                formatDate(dateString) {
                    if (!dateString) return '-';
                    const options = { day: 'numeric', month: 'long', year: 'numeric' };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                },
                
                getFileLabel(key) {
                    const labels = {
                        pasfoto: 'Pasfoto',
                        ktm: 'Scan KTM',
                        cv: 'CV',
                        proposal: 'Proposal',
                        surat: 'Surat Permohonan'
                    };
                    return labels[key] || key;
                }
            }
        }
    </script>
</body>
</html>