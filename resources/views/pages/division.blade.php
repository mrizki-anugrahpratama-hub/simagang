{{-- Kuota Divisi Section - Dynamic Version --}}
<section id="division" class="py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-2">
                <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-2 rounded-full">
                    Periode Aktif
                </span>
            </div>
            <h2 class="text-4xl sm:text-4xl font-extrabold text-gray-900 mb-2">
                Kuota
                <span class="bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] bg-clip-text text-transparent">
                    Divisi
                </span>
            </h2>
            <p class="text-md text-gray-600 max-w-3xl mx-auto">
                Informasi ketersediaan kuota untuk setiap divisi dalam periode ini
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @php
                $colorConfig = [
                    'blue' => [
                        'gradient' => 'from-blue-400 via-blue-500 to-blue-600',
                        'border' => 'border-blue-100 hover:border-blue-300',
                        'icon_bg' => 'from-blue-500 to-blue-600',
                        'text' => 'text-blue-600',
                        'bg' => 'bg-blue-50',
                        'hover' => 'group-hover:text-blue-600'
                    ],
                    'purple' => [
                        'gradient' => 'from-purple-400 via-purple-500 to-purple-600',
                        'border' => 'border-purple-100 hover:border-purple-300',
                        'icon_bg' => 'from-purple-500 to-purple-600',
                        'text' => 'text-purple-600',
                        'bg' => 'bg-purple-50',
                        'hover' => 'group-hover:text-purple-600'
                    ],
                    'green' => [
                        'gradient' => 'from-green-400 via-green-500 to-green-600',
                        'border' => 'border-green-100 hover:border-green-300',
                        'icon_bg' => 'from-green-500 to-green-600',
                        'text' => 'text-green-600',
                        'bg' => 'bg-green-50',
                        'hover' => 'group-hover:text-green-600'
                    ],
                    'pink' => [
                        'gradient' => 'from-pink-400 via-pink-500 to-pink-600',
                        'border' => 'border-pink-100 hover:border-pink-300',
                        'icon_bg' => 'from-pink-500 to-pink-600',
                        'text' => 'text-pink-600',
                        'bg' => 'bg-pink-50',
                        'hover' => 'group-hover:text-pink-600'
                    ],
                    'orange' => [
                        'gradient' => 'from-orange-400 via-orange-500 to-orange-600',
                        'border' => 'border-orange-200 hover:border-orange-400',
                        'icon_bg' => 'from-orange-500 to-orange-600',
                        'text' => 'text-orange-600',
                        'bg' => 'bg-orange-50',
                        'hover' => 'group-hover:text-orange-600'
                    ],
                ];

                $iconSvgs = [
                    'admin' => '<path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 4c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1.4c0-2 4-3.1 6-3.1s6 1.1 6 3.1V19z"/>',
                    'code' => '<path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/>',
                    'user' => '<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>',
                    'chat' => '<path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>',
                    'dollar' => '<path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>',
                ];
            @endphp

            @foreach($divisions as $index => $division)
                @php
                    $color = $colorConfig[$division->color_scheme] ?? $colorConfig['blue'];
                    $remaining = $division->total_quota - $division->used_quota;
                    $progress = $division->total_quota > 0 ? ($division->used_quota / $division->total_quota) * 100 : 0;
                    $iconSvg = $iconSvgs[$division->icon_type] ?? $iconSvgs['admin'];
                    $isLastOdd = ($divisions->count() % 2 != 0) && ($index == $divisions->count() - 1);
                @endphp

                <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 p-8 border {{ $color['border'] }} hover:-translate-y-2 relative overflow-hidden {{ $isLastOdd ? 'md:col-span-2' : '' }}">
                    {{-- Gradient Accent --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r {{ $color['gradient'] }}"></div>

                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 {{ $color['hover'] }} transition-colors">
                                {{ $division->nama_divisi }}
                            </h3>
                            <p class="text-sm text-gray-500 mb-3">{{ $division->competency }}</p>
                            <div class="flex items-center text-xs text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.2 3.2.8-1.3-4.5-2.7V7z"/>
                                </svg>
                                <span>Diperbarui: {{ $division->updated_date ? $division->updated_date->format('d M Y') : 'Belum diperbarui' }}</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br {{ $color['icon_bg'] }} rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                                {!! $iconSvg !!}
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Kuota Tersedia</span>
                            <span class="text-2xl font-bold {{ $color['text'] }}">{{ $remaining }} <span class="text-sm text-gray-400">/ {{ $division->total_quota }}</span></span>
                        </div>
                        <div class="relative w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="absolute inset-0 bg-gradient-to-r {{ $color['gradient'] }} h-4 rounded-full transition-all duration-1000 ease-out shadow-lg" style="width: {{ $progress }}%">
                                <div class="absolute inset-0 bg-white opacity-20 animate-pulse"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500">Progress</span>
                            <span class="font-semibold {{ $color['text'] }} {{ $color['bg'] }} px-2 py-1 rounded-full">{{ number_format($progress, 0) }}% terisi</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Enhanced Info Note --}}
        <div class="mt-12 bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-6 rounded-2xl shadow-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 bg-blue-500 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-base font-bold text-blue-900 mb-2">Informasi Penting</p>
                    <p class="text-sm text-blue-800 leading-relaxed">
                        Kuota yang ditampilkan adalah kuota tersisa untuk periode ini. Data diperbarui secara berkala.
                        <span class="font-semibold">Segera daftarkan diri Anda sebelum kuota penuh!</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</section>
