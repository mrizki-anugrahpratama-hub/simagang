<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan Magang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center font-sans py-10">

    <div class="w-full max-w-2xl px-4">
        
        <div class="text-center mb-8">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo-bakorwil-malang.png') }}" 
                     alt="Logo Bakorwil III Malang" 
                     class="h-16 w-auto drop-shadow-md">
            </div>

            <h2 class="text-3xl font-bold text-gray-900">Ulasan Magang</h2>
            <p class="text-gray-500 mt-2">Bagikan pengalaman Anda selama di Bakorwil III Malang.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" 
             x-data="reviewForm()">

            <div class="bg-gray-100 h-2 w-full">
                <div class="h-full bg-yellow-500 transition-all duration-500 ease-out"
                     :style="'width: ' + ((step / 2) * 100) + '%'"></div>
            </div>

            <form action="{{ route('review.store', $intern->id) }}" method="POST" class="p-8">
                @csrf

                <div x-show="step === 1" x-transition>
                    
                    <div class="bg-blue-50 p-4 rounded-xl mb-6 flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center text-blue-700 font-bold text-xl shrink-0">
                            {{ substr($intern->nama_mahasiswa, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">{{ $intern->nama_mahasiswa }}</h3>
                            <p class="text-sm text-gray-600">{{ $intern->division->nama_divisi ?? 'Divisi Magang' }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $intern->asal_kampus }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="text-center">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Berapa bintang untuk pengalaman ini?</label>
                            <div class="flex justify-center gap-2">
                                <template x-for="i in 5">
                                    <button type="button" 
                                        @click="setRating(i)" 
                                        @mouseenter="hoverRating = i" 
                                        @mouseleave="hoverRating = 0"
                                        class="focus:outline-none transition transform hover:scale-110 duration-200">
                                        <svg class="w-10 h-10" 
                                             :class="(hoverRating >= i || (hoverRating === 0 && formData.rating >= i)) ? 'text-yellow-400' : 'text-gray-300'"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <input type="hidden" name="rating" x-model="formData.rating" required>
                            <p class="text-sm text-red-500 mt-2 h-5" x-text="errorMsg"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ceritakan pengalamanmu</label>
                            <textarea name="content" x-model="formData.content" rows="5" 
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition"
                                placeholder="Apa yang Anda pelajari? Bagaimana lingkungan kerjanya?" required></textarea>
                            <div class="flex justify-end mt-1">
                                <span class="text-xs text-gray-400" :class="formData.content.length < 10 ? 'text-red-400' : 'text-green-600'">
                                    <span x-text="formData.content.length"></span> karakter (Min. 10)
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t flex justify-end">
                        <button type="button" @click="validateAndNext()" 
                            class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-200 transition flex items-center gap-2">
                            Lanjut ke Ringkasan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>

                <div x-show="step === 2" x-cloak x-transition>
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Cek Ulasan Anda</h3>
                        <p class="text-sm text-gray-500">Pastikan data sudah benar sebelum dikirim.</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-6">
                        <div class="flex items-center justify-center gap-1 mb-4 text-yellow-400">
                            <template x-for="i in formData.rating">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </template>
                        </div>
                        
                        <div class="relative">
                            <svg class="absolute top-0 left-0 text-gray-300 w-6 h-6 -mt-3 -ml-2 transform -scale-x-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9 14.9385 9.32555 14.0195 10.0305 13.2036C10.7075 12.4199 11.666 12.0076 12.6517 12L14.017 12V6.10174C14.017 5.56832 13.6262 5.10651 13.0976 5.04866C11.531 4.87737 9.87034 5.37834 8.74241 6.30234C7.57584 7.25805 6.94052 8.84758 7.00162 10.3541L7.00486 10.434L7.017 21H14.017ZM21.017 21L21.017 18C21.017 16.8954 20.1216 16 19.017 16H16C16 14.9385 16.3255 14.0195 17.0305 13.2036C17.7075 12.4199 18.666 12.0076 19.6517 12L21.017 12V6.10174C21.017 5.56832 20.6262 5.10651 20.0976 5.04866C18.531 4.87737 16.8703 5.37834 15.7424 6.30234C14.5758 7.25805 13.9405 8.84758 14.0016 10.3541L14.0049 10.434L14.017 21H21.017Z"/></svg>
                            <p class="text-gray-700 italic text-center px-4 leading-relaxed" x-text="formData.content"></p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-6 border-t">
                        <button type="button" @click="step = 1" 
                            class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                            Edit Kembali
                        </button>
                        <button type="submit" 
                            class="px-8 py-2.5 rounded-lg bg-green-600 text-white font-bold hover:bg-green-700 shadow-lg shadow-green-200 transform hover:scale-105 transition duration-200">
                            Kirim Ulasan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        function reviewForm() {
            return {
                step: 1,
                hoverRating: 0,
                errorMsg: '',
                formData: {
                    rating: 0,
                    content: ''
                },

                setRating(val) {
                    this.formData.rating = val;
                    this.errorMsg = '';
                },

                validateAndNext() {
                    // Validasi Rating
                    if (this.formData.rating === 0) {
                        this.errorMsg = 'Silakan pilih jumlah bintang terlebih dahulu.';
                        return;
                    }
                    // Validasi Konten (Minimal 10 karakter)
                    if (this.formData.content.trim().length < 10) {
                        alert('Mohon isi ulasan minimal 10 karakter agar lebih bermakna.');
                        return;
                    }

                    this.step = 2;
                    this.errorMsg = '';
                }
            }
        }
    </script>
</body>
</html>