{{-- testimonial.blade.php --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section id="testimonial" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-4xl font-extrabold text-gray-900 mb-2">
                Testimoni
                <span class="bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] bg-clip-text text-transparent">
                    Mahasiswa
                </span>
            </h2>
            <p class="text-md text-gray-600 max-w-3xl mx-auto">
                Apa kata mereka yang telah melakukan magang di Bakorwil III Malang
            </p>
        </div>

        {{-- SWIPER CONTAINER --}}
        <div class="swiper mySwiper pb-12 px-4">
            <div class="swiper-wrapper">
                @forelse ($reviews as $review)
                    <div class="swiper-slide h-auto pt-4 pb-8 px-2">
                        {{-- 1. h-full: Agar kartu memanjang ke bawah mengikuti konten tertinggi --}}
                        {{-- 2. justify-between: Agar header di atas, dan tombol 'baca' mentok di bawah --}}
                        <div class="h-full bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 border border-blue-100 flex flex-col justify-between">

                            {{-- BAGIAN ATAS (Header + Teks) --}}
                            <div>
                                {{-- User Info --}}
                                <div class="flex items-center mb-6">
                                    @if($review->foto_profil)
                                        <img src="{{ asset('storage/' . $review->foto_profil) }}"
                                             alt="{{ $review->nama_reviewer }}"
                                             class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm shrink-0">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-[#1A8EC4] to-[#0D6EAD] rounded-full flex items-center justify-center text-white text-2xl font-bold shadow-sm shrink-0">
                                            {{ substr($review->nama_reviewer, 0, 1) }}
                                        </div>
                                    @endif

                                    <div class="ml-4">
                                        <h4 class="font-bold text-gray-900 text-lg line-clamp-1" title="{{ $review->nama_reviewer }}">
                                            {{ $review->nama_reviewer }}
                                        </h4>
                                        <p class="text-sm text-gray-600 line-clamp-1">{{ $review->asal_kampus }}</p>
                                    </div>
                                </div>

                                {{-- Rating --}}
                                <div class="flex mb-4">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>

                                {{-- Review Content with Fixed Height --}}
                                <div class="mb-4 h-20 overflow-hidden">
                                    <p class="text-gray-700 italic leading-relaxed line-clamp-3">
                                        "{{ $review->content }}"
                                    </p>
                                </div>
                            </div>

                            {{-- BAGIAN BAWAH (Tombol) --}}
                            {{-- mt-auto: Memastikan div ini selalu didorong ke posisi paling bawah --}}
                            <div class="mt-auto pt-4 border-t border-blue-100 min-h-[40px] flex items-center">
                                @if(strlen($review->content) > 150)
                                    <button
                                        onclick="openReviewModal('{{ addslashes($review->nama_reviewer) }}', '{{ addslashes($review->asal_kampus) }}', '{{ $review->rating }}', `{{ $review->content }}`)"
                                        class="text-[#0D6EAD] text-sm font-semibold hover:text-[#1A8EC4] transition-colors flex items-center gap-1 cursor-pointer">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="swiper-slide">
                        <div class="text-center p-10 bg-gray-50 rounded-2xl border border-gray-200">
                            <p class="text-gray-500">Belum ada testimoni.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

{{-- MODAL COMPONENT --}}
{{-- ID diganti jadi reviewModalContainer agar unik --}}
<div id="reviewModalContainer" class="fixed inset-0 z-[60] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-opacity-50 transition-opacity backdrop-blur-sm" onclick="closeReviewModal()"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">

                <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        {{-- ID unik: review-modal-name --}}
                        <h3 class="text-lg font-bold leading-6 text-gray-900" id="review-modal-name">Nama Reviewer</h3>
                        <p class="text-sm text-[#0D6EAD]" id="review-modal-kampus">Asal Kampus</p>
                    </div>
                    {{-- Fungsi close diganti jadi closeReviewModal --}}
                    <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-6">
                    <div id="review-modal-stars" class="flex mb-4 text-yellow-400"></div>
                    <div class="mt-2">
                        <p class="text-gray-600 text-base leading-relaxed italic" id="review-modal-content">
                            </p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeReviewModal()" class="inline-flex w-full justify-center rounded-lg bg-[#0D6EAD] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#1A8EC4] sm:w-auto transition-colors cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Swiper Config (Tidak berubah)
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 24 },
            1024: { slidesPerView: 3, spaceBetween: 32 },
        },
    });

    // === PERBAIKAN DI SINI ===
    // Nama variabel & ID elemen dibedakan dari intern.blade.php
    const reviewModal = document.getElementById('reviewModalContainer');
    const reviewName = document.getElementById('review-modal-name');
    const reviewKampus = document.getElementById('review-modal-kampus');
    const reviewContent = document.getElementById('review-modal-content');
    const reviewStars = document.getElementById('review-modal-stars');

    // Fungsi OPEN khusus review
    function openReviewModal(name, kampus, rating, content) {
        reviewName.textContent = name;
        reviewKampus.textContent = kampus;
        reviewContent.textContent = '"' + content + '"';

        let starsHtml = '';
        for(let i=1; i<=5; i++) {
            if(i <= rating) {
                starsHtml += `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`;
            } else {
                starsHtml += `<svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>`;
            }
        }
        reviewStars.innerHTML = starsHtml;

        reviewModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Fungsi CLOSE khusus review
    function closeReviewModal() {
        reviewModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Event Listener Escape Key khusus review
    document.addEventListener('keydown', function(event) {
        if(event.key === "Escape" && !reviewModal.classList.contains('hidden')) {
            closeReviewModal();
        }
    });
</script>
