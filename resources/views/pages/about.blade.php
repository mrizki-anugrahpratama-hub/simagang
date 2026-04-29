{{-- About Section --}}
<section id="about" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-4xl font-extrabold text-gray-900 mb-2">
                Tentang
                <span
                    class="bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] bg-clip-text text-transparent"
                >
                    Kami
                </span>
            </h2>
            <p class="text-md text-gray-600 max-w-3xl mx-auto">
                Informasi Seputar Program Pemagangan di Bakorwil III Malang
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            {{-- Left: Image --}}
            <div class="flex justify-center lg:justify-start">
                <div class="w-full max-w-md">
                    <img
                        src="{{ asset('images/about-ilustrasi.png') }}"
                        alt="Tentang Program Illustration"
                        class="w-full h-auto object-contain"
                    />
                </div>
            </div>

            {{-- Right: Accordion --}}
            <div class="space-y-8">
                {{-- Accordion Item 1 --}}
                <div
                    class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md border border-blue-100 overflow-hidden mb-2"
                >
                    <button
                        class="w-full px-6 py-4 flex items-center justify-between text-left bg-gradient-to-r from-[#1A8EC4]/10 to-[#0D6EAD]/5 hover:from-[#1A8EC4]/20 hover:to-[#0D6EAD]/10 transition-all duration-200"
                        onclick="toggleAccordion('accordion1')"
                    >
                        <span class="font-semibold text-gray-800">Tentang Program</span>
                        <div class="relative w-5 h-5">
                            {{-- Chevron Down (when open) --}}
                            <svg
                                id="icon-down-accordion1"
                                class="w-5 h-5 text-[#1A8EC4] absolute transition-opacity duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            {{-- Chevron Right (when closed) --}}
                            <svg
                                id="icon-right-accordion1"
                                class="w-5 h-5 text-[#1A8EC4] absolute opacity-0 transition-opacity duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </button>

                    <div
                        id="accordion1"
                        class="accordion-content overflow-hidden transition-all duration-300"
                        style="max-height: 500px"
                    >
                        <div
                            class="px-6 py-4 text-gray-700 leading-relaxed border-t border-blue-100 bg-white"
                        >
                            Program magang sekaligus pelatihan kerja yang dirancang untuk memberikan
                            pengalaman kerja nyata bagi mahasiswa maupun lulusan perguruan tinggi
                            (fresh graduate). Program ini bertujuan untuk meningkatkan kompetensi,
                            keterampilan, serta kesiapan peserta dalam memasuki dunia kerja,
                            khususnya di lingkungan pemerintahan.
                            <br />
                            <br />
                            Program pemagangan ini dilaksanakan di Badan Koordinasi Wilayah
                            Pemerintahan dan Pembangunan (Bakorwil) III Malang, yang beralamat di
                            Jl. Simpang Ijen No.2, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa
                            Timur 65119. Selama mengikuti program, peserta akan terlibat secara
                            langsung dalam berbagai aktivitas kerja di lingkungan pemerintahan
                            daerah, dengan pendampingan mentor atau pembimbing dari instansi
                            terkait.
                        </div>
                    </div>
                </div>

                {{-- Accordion Item 2 --}}
                <div
                    class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md border border-blue-100 overflow-hidden mb-2"
                >
                    <button
                        class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-blue-50/50 transition-all duration-200"
                        onclick="toggleAccordion('accordion2')"
                    >
                        <span class="font-semibold text-gray-800">Peserta Pemagangan</span>
                        <div class="relative w-5 h-5">
                            {{-- Chevron Down (when open) --}}
                            <svg
                                id="icon-down-accordion2"
                                class="w-5 h-5 text-[#1A8EC4] absolute opacity-0 transition-opacity duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            {{-- Chevron Right (when closed) --}}
                            <svg
                                id="icon-right-accordion2"
                                class="w-5 h-5 text-[#1A8EC4] absolute transition-opacity duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </button>

                    <div
                        id="accordion2"
                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300"
                    >
                        <div
                            class="px-6 py-4 text-gray-700 leading-relaxed border-t border-blue-100 bg-white"
                        >
                            Peserta program pemagangan adalah mahasiswa perguruan tinggi yang telah
                            memenuhi persyaratan administrasi maupun akademik sesuai dengan
                            ketentuan yang berlaku serta telah terdaftar secara resmi sebagai
                            peserta program. Program ini ditujukan bagi individu yang memiliki
                            motivasi tinggi untuk belajar, mengembangkan keterampilan, dan
                            memperoleh pengalaman kerja secara langsung di lingkungan pemerintahan.
                            <br />
                            <br />
                            Peserta pemagangan diharapkan mampu mengikuti seluruh rangkaian kegiatan
                            yang telah ditetapkan, mematuhi peraturan dan tata tertib yang berlaku
                            di Bakorwil III Malang, serta menunjukkan sikap profesional, disiplin,
                            dan bertanggung jawab selama pelaksanaan program. Selain itu, peserta
                            juga diharapkan dapat beradaptasi dengan budaya kerja pemerintahan serta
                            menjalin kerja sama yang baik dengan mentor maupun pegawai di unit
                            penempatan.
                        </div>
                    </div>
                </div>

                {{-- Accordion Item 3 --}}
                <div
                    class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md border border-blue-100 overflow-hidden"
                >
                    <button
                        class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-blue-50/50 transition-all duration-200"
                        onclick="toggleAccordion('accordion3')"
                    >
                        <span class="font-semibold text-gray-800">Penyelenggara Pemagangan</span>
                        <div class="relative w-5 h-5">
                            {{-- Chevron Down (when open) --}}
                            <svg
                                id="icon-down-accordion3"
                                class="w-5 h-5 text-[#1A8EC4] absolute opacity-0 transition-opacity duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            {{-- Chevron Right (when closed) --}}
                            <svg
                                id="icon-right-accordion3"
                                class="w-5 h-5 text-[#1A8EC4] absolute transition-opacity duration-200"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </button>

                    <div
                        id="accordion3"
                        class="accordion-content max-h-0 overflow-hidden transition-all duration-300"
                    >
                        <div
                            class="px-6 py-4 text-gray-700 leading-relaxed border-t border-blue-100 bg-white"
                        >
                            Program pemagangan ini diselenggarakan oleh Badan Koordinasi Wilayah
                            Pemerintahan dan Pembangunan (Bakorwil) III Malang sebagai instansi
                            pemerintah yang memiliki peran strategis dalam koordinasi, pembinaan,
                            dan fasilitasi penyelenggaraan pemerintahan serta pembangunan di wilayah
                            kerjanya. Bakorwil III Malang bertanggung jawab penuh dalam perencanaan,
                            pelaksanaan, pengawasan, serta evaluasi kegiatan pemagangan agar program
                            dapat berjalan secara efektif dan sesuai dengan tujuan yang telah
                            ditetapkan.
                            <br><br>
                            Dalam pelaksanaan program pemagangan, Bakorwil III Malang
                            menyediakan lingkungan kerja yang kondusif, mentor atau pembimbing yang
                            kompeten, serta sarana dan prasarana pendukung guna menunjang proses
                            pembelajaran peserta.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Accordion Script --}}
<script>
    function toggleAccordion(id) {
        const content = document.getElementById(id)
        const iconDown = document.getElementById('icon-down-' + id)
        const iconRight = document.getElementById('icon-right-' + id)

        const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px'

        // Close all accordions and show right arrows
        document.querySelectorAll('.accordion-content').forEach((item) => {
            item.style.maxHeight = '0px'
        })
        document.querySelectorAll('[id^="icon-down-"]').forEach((item) => {
            item.style.opacity = '0'
        })
        document.querySelectorAll('[id^="icon-right-"]').forEach((item) => {
            item.style.opacity = '1'
        })

        // If clicked accordion was closed, open it and show down arrow
        if (!isOpen) {
            content.style.maxHeight = content.scrollHeight + 'px'
            iconDown.style.opacity = '1'
            iconRight.style.opacity = '0'
        }
    }

    function initializeAccordion() {
        const firstAccordionContent = document.getElementById('accordion1')
        const firstIconDown = document.getElementById('icon-down-accordion1')
        const firstIconRight = document.getElementById('icon-right-accordion1')

        if (firstAccordionContent && firstIconDown && firstIconRight) {
            // Open first accordion
            firstAccordionContent.style.maxHeight = firstAccordionContent.scrollHeight + 'px'
            firstIconDown.style.opacity = '1'
            firstIconRight.style.opacity = '0'

            // Close all other accordions
            document.querySelectorAll('.accordion-content').forEach((item) => {
                if (item.id !== 'accordion1') {
                    item.style.maxHeight = '0px'
                }
            })

            // Show right arrows for closed accordions
            document.querySelectorAll('[id^="icon-down-"]').forEach((item) => {
                if (item.id !== 'icon-down-accordion1') {
                    item.style.opacity = '0'
                }
            })
            document.querySelectorAll('[id^="icon-right-"]').forEach((item) => {
                if (item.id !== 'icon-right-accordion1') {
                    item.style.opacity = '1'
                }
            })
        }
    }

    document.addEventListener('DOMContentLoaded', initializeAccordion)
</script>
