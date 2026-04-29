{{-- Footer Section --}}
<footer
    class="relative bg-gradient-to-br from-[#0D4A6B] via-[#1A8EC4] to-[#0D6EAD] text-white overflow-hidden"
>
    {{-- Decorative Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 right-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        <div
            class="absolute bottom-20 left-10 w-80 h-80 bg-[#FFC107]/10 rounded-full blur-3xl"
        ></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            {{-- Left Section: Logo & Branding --}}
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        <img
                            src="{{ asset('logo-prov-jatim.png') }}"
                            alt="Logo Provinsi Jawa Timur"
                            class="w-16 h-16 lg:w-20 lg:h-20 object-contain drop-shadow-lg"
                        />
                    </div>

                    {{-- Brand Text --}}
                    <div class="flex-1">
                        <a href="/">
                            <h3
                                class="text-2xl lg:text-3xl font-extrabold mb-1"
                                style="font-family: 'Poppins', sans-serif"
                            >
                                <span
                                    class="bg-gradient-to-r from-[#FFC107] to-[#5CB3E0] bg-clip-text text-transparent hover:scale-105 transition-transform duration-300 cursor-pointer"
                                >
                                    SIMAGANG
                                </span>
                            </h3>
                            <p
                                class="text-sm lg:text-base font-semibold text-blue-100 leading-tight"
                            >
                                BAKORWIL III MALANG PROV JATIM
                            </p>
                        </a>
                    </div>
                </div>

                <p class="text-sm lg:text-base text-blue-100 leading-relaxed">
                    Sistem Informasi Magang Badan Koordinasi Wilayah III Malang, Provinsi Jawa Timur
                </p>
            </div>

            {{-- Middle Section: Contact Information --}}
            <div class="space-y-4">
                <h4 class="text-xl lg:text-2xl font-bold mb-4 flex items-center">
                    CONTACT
                </h4>

                {{-- Address --}}
                <div
                    class="flex items-start space-x-3 group hover:translate-x-1 transition-transform duration-300"
                >
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-5 h-5 text-[#FFC107]" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm lg:text-base text-blue-100 leading-relaxed">
                            Jl. Simpang Ijen No.2, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa
                            Timur 65119
                        </p>
                    </div>
                </div>

                {{-- Email --}}
                <div
                    class="flex items-center space-x-3 group hover:translate-x-1 transition-transform duration-300"
                >
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-[#FFC107]" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"
                            />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <a
                        href="mailto:bakorwilmalang@jatimprov.go.id"
                        class="text-sm lg:text-base text-blue-100 hover:text-[#FFC107] transition-colors duration-300"
                    >
                        bakorwilmalang@jatimprov.go.id
                    </a>
                </div>

                {{-- Phone --}}
                <div
                    class="flex items-center space-x-3 group hover:translate-x-1 transition-transform duration-300"
                >
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-[#FFC107]" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"
                            />
                        </svg>
                    </div>
                    <a
                        href="tel:0341555366"
                        class="text-sm lg:text-base text-blue-100 hover:text-[#FFC107] transition-colors duration-300"
                    >
                        (0341) 555-366
                    </a>
                </div>

                {{-- Social Media --}}
                <div class="pt-4">
                    <div class="flex items-center space-x-3">
                        {{-- YouTube --}}
                        <a
                            href="https://www.youtube.com/@bakorwiliiimalang5279"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center hover:bg-[#FFC107] hover:scale-110 transform transition-all duration-300 group"
                        >
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>

                        {{-- Twitter/X --}}
                        <a
                            href="https://x.com/bakorwil3malang"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center hover:bg-[#FFC107] hover:scale-110 transform transition-all duration-300 group"
                        >
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>

                        {{-- Facebook --}}
                        <a
                            href="https://www.facebook.com/bakorwilmalangprovjatim"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center hover:bg-[#FFC107] hover:scale-110 transform transition-all duration-300 group"
                        >
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        {{-- Instagram --}}
                        <a
                            href="https://www.instagram.com/bakorwilmalang"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center hover:bg-[#FFC107] hover:scale-110 transform transition-all duration-300 group"
                        >
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Section: Location Map --}}
            <div class="space-y-4">
                <h4 class="text-xl lg:text-2xl font-bold mb-4 flex items-center">
                    LOCATION
                </h4>

                {{-- Map Container --}}
                <div
                    class="relative rounded-xl overflow-hidden shadow-2xl border-4 border-white/20 hover:border-[#FFC107]/50 transition-all duration-300 group"
                >
                    <div class="aspect-video bg-gradient-to-br from-blue-100 to-blue-50">
                        <iframe
                            src="https://www.google.com/maps?q=Badan+Koordinasi+Wilayah+Pemerintahan+dan+Pembangunan+Jawa+Timur+III+Malang,Jl.+Simpang+Ijen+No.2,+Oro-oro+Dowo,+Kec.+Klojen,+Kota+Malang,+Jawa+Timur+65119&output=embed&z=17"
                            width="100%"
                            height="100%"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full"
                        ></iframe>
                    </div>

                    {{-- Overlay on hover --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[#1A8EC4]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"
                    ></div>
                </div>
            </div>
        </div>

        {{-- Bottom Bar: Copyright --}}
        <div class="mt-12 pt-8 border-t border-white/20">
            <div
                class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0"
            >
                <p class="text-sm text-blue-100 text-center md:text-left">
                    &copy; {{ date('Y') }} SIMAGANG - Badan Koordinasi Wilayah III Malang. All
                    rights reserved.
                </p>

                <div class="flex items-center space-x-6 text-sm text-blue-100">
                    <a href="#" class="hover:text-[#FFC107] transition-colors duration-300">
                        Privacy Policy
                    </a>
                    <span class="text-white/30">|</span>
                    <a href="#" class="hover:text-[#FFC107] transition-colors duration-300">
                        Terms of Service
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Decorative Wave at Top --}}
    <div class="absolute top-0 left-0 right-0 overflow-hidden leading-none">
        <svg
            class="relative block w-full h-12"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 100"
            preserveAspectRatio="none"
        >
            <path
                fill="#ffff"
                fill-opacity="1"
                d="M0,50 C240,100 480,0 720,50 C960,100 1200,0 1440,50 L1440,0 L0,0 Z"
            ></path>
        </svg>
    </div>
</footer>
