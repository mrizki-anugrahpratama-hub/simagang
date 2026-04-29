<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Hide native select */
    .hidden-select { position: absolute; opacity: 0; pointer-events: none; }
    /* Custom select wrapper */
    .custom-select-wrapper { position: relative; width: 100%; }
    /* Custom select container */
    .custom-select { position: relative; width: 100%; }
    /* Custom select trigger */
    .custom-select-trigger { display: flex; align-items: center; justify-content: space-between; padding: 0.5rem 0.75rem; background-color: white; border: 1px solid #d1d5db; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; min-height: 42px; }
    .custom-select-trigger:hover { border-color: #60a5fa; }
    .custom-select.open .custom-select-trigger { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    .custom-select-trigger span { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 0.875rem; color: #374151; }
    .custom-select-trigger svg { flex-shrink: 0; margin-left: 0.5rem; color: #6b7280; transition: transform 0.2s; }
    .custom-select.open .custom-select-trigger svg { transform: rotate(180deg); }
    /* Custom options dropdown */
    .custom-options { position: absolute; top: calc(100% + 4px); left: 0; right: 0; background-color: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); max-height: 250px; overflow-y: auto; z-index: 50; display: none; animation: slideDown 0.2s ease-out; }
    .custom-select.open .custom-options { display: block; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    /* Custom option item */
    .custom-option { padding: 0.75rem 1rem; cursor: pointer; transition: all 0.15s; font-size: 0.875rem; color: #1f2937; }
    .custom-option:hover { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
    .custom-option.selected { background-color: #eff6ff; color: #3b82f6; font-weight: 500; }
    .custom-option.selected:hover { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
    .custom-option:first-child { border-top-left-radius: 0.75rem; border-top-right-radius: 0.75rem; }
    .custom-option:last-child { border-bottom-left-radius: 0.75rem; border-bottom-right-radius: 0.75rem; }
    /* Scrollbar styling */
    .custom-options::-webkit-scrollbar { width: 6px; }
    .custom-options::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 0.75rem; }
    .custom-options::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 0.75rem; }
    .custom-options::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

<section id="internship" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-4xl font-extrabold text-gray-900 mb-2">
                Mahasiswa <span class="bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] bg-clip-text text-transparent">Magang</span>
            </h2>
            <p class="text-md text-gray-600 max-w-3xl mx-auto">
                Data sebaran dan daftar mahasiswa magang di Bakorwil III Malang
            </p>
        </div>

        {{-- AREA GRAFIK--}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
             <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Statistik Status</h3>
                <div class="relative h-64 w-full"><canvas id="statusChart"></canvas></div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Top 5 Asal Kampus</h3>
                <div class="relative h-64 w-full flex justify-center"><canvas id="kampusChart"></canvas></div>
            </div>
        </div>

        {{-- SECTION DATA TABLE --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-6">

            {{-- 1. FORM SEARCH & FILTER --}}
            <form method="GET" action="{{ url('/') }}" id="searchForm" class="mb-6 grid grid-cols-1 md:grid-cols-6 gap-4">
                <input type="hidden" name="scrollTo" value="information">

                {{-- Search Box --}}
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Nama / NIM / Kampus..."
                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none p-2.5 transition-all duration-200"
                        onkeypress="if(event.key === 'Enter') { event.preventDefault(); submitFormAndStay(); }">
                </div>

                {{-- Filter Divisi --}}
                <div class="custom-select-wrapper">
                    <select name="filter_division" id="filter_division" class="hidden-select">
                        <option value="">Semua Divisi</option>
                        @foreach($divisions as $div)
                            <option value="{{ $div->id }}" {{ request('filter_division') == $div->id ? 'selected' : '' }}>
                                {{ $div->nama_divisi ?? $div->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>{{ request('filter_division') ? $divisions->find(request('filter_division'))->nama_divisi : 'Semua Divisi' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option" data-value="">Semua Divisi</div>
                            @foreach($divisions as $div)
                                <div class="custom-option {{ request('filter_division') == $div->id ? 'selected' : '' }}" data-value="{{ $div->id }}">
                                    {{ $div->nama_divisi ?? $div->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Filter Status --}}
                <div class="custom-select-wrapper">
                    <select name="filter_status" id="filter_status" class="hidden-select">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('filter_status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ request('filter_status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>{{ request('filter_status') ? ucfirst(request('filter_status')) : 'Semua Status' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option" data-value="">Semua Status</div>
                            <div class="custom-option {{ request('filter_status') == 'aktif' ? 'selected' : '' }}" data-value="aktif">Aktif</div>
                            <div class="custom-option {{ request('filter_status') == 'selesai' ? 'selected' : '' }}" data-value="selesai">Selesai</div>
                        </div>
                    </div>
                </div>

                {{-- Sorting --}}
                <div class="custom-select-wrapper">
                    <select name="sort" id="sort" class="hidden-select">
                        <option value="date_newest" {{ request('sort') == 'date_newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="date_oldest" {{ request('sort') == 'date_oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                    <div class="custom-select">
                        <div class="custom-select-trigger">
                            <span>
                                @if(request('sort') == 'date_oldest') Terlama
                                @elseif(request('sort') == 'name_asc') Nama (A-Z)
                                @elseif(request('sort') == 'name_desc') Nama (Z-A)
                                @else Terbaru
                                @endif
                            </span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="custom-options">
                            <div class="custom-option {{ request('sort') == 'date_newest' || !request('sort') ? 'selected' : '' }}" data-value="date_newest">Terbaru</div>
                            <div class="custom-option {{ request('sort') == 'date_oldest' ? 'selected' : '' }}" data-value="date_oldest">Terlama</div>
                            <div class="custom-option {{ request('sort') == 'name_asc' ? 'selected' : '' }}" data-value="name_asc">Nama (A-Z)</div>
                            <div class="custom-option {{ request('sort') == 'name_desc' ? 'selected' : '' }}" data-value="name_desc">Nama (Z-A)</div>
                        </div>
                    </div>
                </div>

                {{-- Search Button --}}
                <button type="button" onclick="submitFormAndStay()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium shadow-sm flex items-center justify-center gap-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </form>

            {{-- 2. TABEL --}}
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 text-center">Nama & NIM</th>
                            <th class="px-6 py-4 text-center">Asal Kampus</th>
                            <th class="px-6 py-4 text-center">Divisi</th>
                            <th class="px-6 py-4 text-center">Periode</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($interns as $index => $intern)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            {{-- Nama & NIM --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold shrink-0">
                                        {{ substr($intern->nama_mahasiswa, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $intern->nama_mahasiswa }}</div>
                                        <div class="text-xs text-gray-500">{{ $intern->nim }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">{{ $intern->asal_kampus }}</td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $intern->division->nama_divisi ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($intern->tgl_mulai)->format('d M Y') }} - <br>
                                {{ \Carbon\Carbon::parse($intern->tgl_berakhir)->format('d M Y') }}
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusColor = match($intern->status) {
                                        'aktif' => 'bg-green-100 text-green-800 border-green-200',
                                        'selesai' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                        default => 'bg-gray-100 text-gray-800 border-gray-200'
                                    };
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusColor }}">
                                    {{ ucfirst($intern->status) }}
                                </span>
                            </td>

                            {{-- TOMBOL DETAIL (MODAL TRIGGER) --}}
                            <td class="px-6 py-4 text-center">
                                <button onclick="openModal(this)"
                                    data-nama="{{ $intern->nama_mahasiswa }}"
                                    data-nim="{{ $intern->nim }}"
                                    data-kampus="{{ $intern->asal_kampus }}"
                                    data-fakultas="{{ $intern->fakultas ?? '-' }}"
                                    data-prodi="{{ $intern->prodi ?? '-' }}"
                                    data-divisi="{{ $intern->division->nama_divisi ?? '-' }}"
                                    data-status="{{ ucfirst($intern->status) }}"
                                    data-status-raw="{{ $intern->status }}"
                                    data-mulai="{{ \Carbon\Carbon::parse($intern->tgl_mulai)->format('d M Y') }}"
                                    data-akhir="{{ \Carbon\Carbon::parse($intern->tgl_berakhir)->format('d M Y') }}"

                                    {{-- Link Berkas (Menggunakan Ternary agar tidak error jika null) --}}
                                    data-surat-balasan="{{ $intern->surat_balasan_magang_path ? Storage::url($intern->surat_balasan_magang_path) : '' }}"
                                    data-surat-pengembalian="{{ $intern->surat_pengembalian_path ? Storage::url($intern->surat_pengembalian_path) : '' }}"
                                    data-sertifikat="{{ $intern->sertifikat_path ? Storage::url($intern->sertifikat_path) : '' }}"
                                    data-penilaian="{{ $intern->form_penilaian_path ? Storage::url($intern->form_penilaian_path) : '' }}"

                                    class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded-md text-xs font-medium shadow-sm transition-all cursor-pointer">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500 italic">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 3. PAGINATION LINKS --}}
            <div class="mt-6">
                {{ $interns->fragment('internship')->links('vendor.pagination.custom_pagination') }}
            </div>

        </div>

        {{-- MODAL STRUCTURE --}}
        <div id="internModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 backdrop-blur-lg transition-opacity" onclick="closeModal()"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">

                    {{-- Header Modal --}}
                    <div class="bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white" id="modal-nama">Nama Mahasiswa</h3>
                        <button onclick="closeModal()" class="text-white hover:text-gray-200 cursor-pointer">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Body Modal --}}
                    <div class="px-6 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Kolom Kiri: Data Diri --}}
                            <div>
                                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Informasi Akademik</h4>
                                <div class="space-y-3">
                                    <div><p class="text-xs text-gray-500">NIM</p><p class="font-medium text-gray-900" id="modal-nim">-</p></div>
                                    <div><p class="text-xs text-gray-500">Asal Kampus</p><p class="font-medium text-gray-900" id="modal-kampus">-</p></div>
                                    <div><p class="text-xs text-gray-500">Fakultas / Prodi</p><p class="font-medium text-gray-900"><span id="modal-fakultas"></span> - <span id="modal-prodi"></span></p></div>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Data Magang --}}
                            <div>
                                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Detail Magang</h4>
                                <div class="space-y-3">
                                    <div><p class="text-xs text-gray-500">Divisi</p><p class="font-medium text-blue-600" id="modal-divisi">-</p></div>
                                    <div><p class="text-xs text-gray-500">Periode</p><p class="font-medium text-gray-900"><span id="modal-mulai"></span> s/d <span id="modal-akhir"></span></p></div>
                                    <div>
                                        <p class="text-xs text-gray-500">Status</p>
                                        <span id="modal-status" class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium bg-gray-100 text-gray-600">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Berkas (Grid Layout Rapi) --}}
                        <div class="mt-8 border-t pt-6">
                            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 text-center">Berkas & Dokumen</h4>
                            
                            {{-- Grid Container untuk Tombol --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="modal-documents">
                                {{-- Tombol akan dirender otomatis oleh JS --}}
                                <a id="btn-balasan" class="hidden"></a>
                                <a id="btn-pengembalian" class="hidden"></a>
                                <a id="btn-sertifikat" class="hidden"></a>
                                <a id="btn-penilaian" class="hidden"></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- JAVASCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- 1. CONFIG DROPDOWN CUSTOM ---
        const customSelects = document.querySelectorAll('.custom-select');
        customSelects.forEach(select => {
            const trigger = select.querySelector('.custom-select-trigger');
            const options = select.querySelectorAll('.custom-option');
            const hiddenSelect = select.closest('.custom-select-wrapper').querySelector('.hidden-select');
            
            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                customSelects.forEach(s => { if (s !== select) s.classList.remove('open'); });
                select.classList.toggle('open');
            });

            options.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const value = this.getAttribute('data-value');
                    trigger.querySelector('span').textContent = this.textContent;
                    hiddenSelect.value = value;
                    options.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    select.classList.remove('open');
                });
            });
        });
        document.addEventListener('click', function() { customSelects.forEach(select => select.classList.remove('open')); });

        // --- 2. LOGIKA CHARTS ---
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartYearsLabels) !!},
                datasets: [
                    { label: 'Peserta Aktif', data: {!! json_encode($dataAktif) !!}, backgroundColor: '#22C55E', borderRadius: 4 },
                    { label: 'Peserta Selesai', data: {!! json_encode($dataSelesai) !!}, backgroundColor: '#3B82F6', borderRadius: 4 }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: true, position: 'top' } }, scales: { y: { beginAtZero: true, grid: { borderDash: [2, 4] } }, x: { grid: { display: false } } } }
        });

        const ctxKampus = document.getElementById('kampusChart').getContext('2d');
        new Chart(ctxKampus, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartKampusLabels) !!},
                datasets: [{ data: {!! json_encode($chartKampusValues) !!}, backgroundColor: ['#F59E0B', '#10B981', '#3B82F6', '#6366F1', '#EC4899'], borderWidth: 0 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        // --- 3. LOGIKA SMART SCROLL (PAGINATION & SEARCH) ---
        const urlParams = new URLSearchParams(window.location.search);
        const savedScroll = sessionStorage.getItem('keepScrollPosition');

        // Skenario A: Jika pindah halaman via Pagination (Mendeteksi #internship)
        if (window.location.hash === '#internship') {
            const target = document.getElementById('internship');
            if (target) {
                setTimeout(() => {
                    window.scrollTo({
                        top: target.offsetTop - 20,
                        behavior: 'smooth'
                    });
                }, 100);
            }
        } 
        // Skenario B: Jika menggunakan Filter/Search (Mendeteksi parameter scrollTo)
        else if (savedScroll !== null && urlParams.has('scrollTo')) {
            const target = document.getElementById('searchForm');
            if (target) {
                window.scrollTo({ 
                    top: target.offsetTop + parseInt(savedScroll), 
                    behavior: 'instant' 
                });
            }
            sessionStorage.removeItem('keepScrollPosition');
        }
    });

    // Fungsi submit untuk menjaga posisi scroll saat filter/cari
    function submitFormAndStay() {
        const target = document.getElementById('searchForm');
        const currentScrollPos = window.pageYOffset;
        const targetTop = target ? target.offsetTop : 0;
        
        // Simpan selisih jarak scroll agar presisi saat halaman muat ulang
        sessionStorage.setItem('keepScrollPosition', currentScrollPos - targetTop);
        document.getElementById('searchForm').submit();
    }

    // --- 4. LOGIKA MODAL DETAIL ---
    function openModal(button) {
        const data = button.dataset;

        // 1. Isi Data Teks
        document.getElementById('modal-nama').textContent = data.nama;
        document.getElementById('modal-nim').textContent = data.nim;
        document.getElementById('modal-kampus').textContent = data.kampus;
        document.getElementById('modal-fakultas').textContent = data.fakultas;
        document.getElementById('modal-prodi').textContent = data.prodi;
        document.getElementById('modal-divisi').textContent = data.divisi;
        document.getElementById('modal-mulai').textContent = data.mulai;
        document.getElementById('modal-akhir').textContent = data.akhir;

        // 2. Isi Status dengan Warna
        const statusEl = document.getElementById('modal-status');
        statusEl.textContent = data.status;
        statusEl.className = 'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium border';
        
        if(data.statusRaw === 'aktif') statusEl.classList.add('bg-green-100', 'text-green-800', 'border-green-200');
        else if(data.statusRaw === 'selesai') statusEl.classList.add('bg-blue-100', 'text-blue-800', 'border-blue-200');
        else if(data.statusRaw === 'ditolak') statusEl.classList.add('bg-red-100', 'text-red-800', 'border-red-200');
        else statusEl.classList.add('bg-gray-100', 'text-gray-800', 'border-gray-200');

        // 3. LOGIKA BERKAS (Revisi: View Only & Simple State)
        
        // A. Surat Balasan
        renderDocButton(
            'btn-balasan', 
            data.suratBalasan, 
            'Surat Balasan', 
            'bg-blue-50 text-blue-700 hover:bg-blue-100 border-blue-200', 
            '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'
        );

        // B. Surat Pengembalian
        renderDocButton(
            'btn-pengembalian', 
            data.suratPengembalian, 
            'Surat Pengembalian', 
            'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border-emerald-200', 
            '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
        );

        // C. Sertifikat
        renderDocButton(
            'btn-sertifikat', 
            data.sertifikat, 
            'Sertifikat Magang', 
            'bg-amber-50 text-amber-700 hover:bg-amber-100 border-amber-200', 
            '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>'
        );

        // D. Penilaian Magang (BARU)
        renderDocButton(
            'btn-penilaian', 
            data.penilaian, 
            'Penilaian Magang', 
            'bg-purple-50 text-purple-700 hover:bg-purple-100 border-purple-200', 
            '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>'
        );

        // Show Modal
        document.getElementById('internModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('internModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // --- HELPER UNTUK RENDER TOMBOL BERKAS ---
    function renderDocButton(elementId, url, label, colorClasses, iconSvg) {
        const el = document.getElementById(elementId);
        
        // Reset Kelas Dasar
        el.className = 'flex items-center gap-3 px-4 py-3 rounded-lg border text-sm font-medium transition-all shadow-sm';

        if (url && url.trim() !== "") {
            // STATE 1: BERKAS TERSEDIA (Berwarna, Bisa Diklik, View Only)
            el.href = url;
            el.target = '_blank'; // Membuka di tab baru (View Only logic)
            el.innerHTML = iconSvg + `<span>Lihat ${label}</span>`;
            
            // Tambahkan kelas warna custom + hover effect
            const classes = colorClasses.split(' ');
            el.classList.add(...classes);
            el.classList.remove('cursor-not-allowed', 'opacity-60', 'bg-gray-50', 'text-gray-400', 'border-gray-200');
            
        } else {
            // STATE 2: BERKAS TIDAK TERSEDIA (Abu-abu, Mati)
            el.removeAttribute('href');
            el.removeAttribute('target');
            
            // Ikon Gembok / Silang kecil untuk state disabled
            const disabledIcon = '<svg class="w-5 h-5 flex-shrink-0 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>';
            
            el.innerHTML = disabledIcon + `<span>${label} (Belum Tersedia)</span>`;
            
            // Tambahkan kelas abu-abu
            el.classList.add('bg-gray-50', 'text-gray-400', 'border-gray-200', 'cursor-not-allowed');
        }
        
        // Pastikan elemen terlihat (remove hidden class jika ada sisa)
        el.classList.remove('hidden');
    }

    // Close on ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") closeModal();
    });
</script>