<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg shadow-lg border-b border-gray-200/50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">

            <div class="flex items-center group">
                <span class="text-2xl md:text-3xl font-extrabold tracking-wide
                    bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                    bg-clip-text text-transparent
                    hover:scale-105 transition-transform duration-300 cursor-pointer
                    drop-shadow-sm"
                    style="font-family: 'Poppins', sans-serif;">
                    SIMAGANG
                </span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="#home"
                   class="px-4 py-2 font-semibold text-gray-700 rounded-lg
                          hover:text-[#1A8EC4] hover:bg-blue-50/80
                          transition-all duration-300 ease-in-out
                          relative group">
                    Beranda
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                                 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#about"
                   class="px-4 py-2 font-semibold text-gray-700 rounded-lg
                          hover:text-[#1A8EC4] hover:bg-blue-50/80
                          transition-all duration-300 ease-in-out
                          relative group">
                    Tentang Kami
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                                 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#information"
                   class="px-4 py-2 font-semibold text-gray-700 rounded-lg
                          hover:text-[#1A8EC4] hover:bg-blue-50/80
                          transition-all duration-300 ease-in-out
                          relative group">
                    Informasi
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                                 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#division"
                   class="px-4 py-2 font-semibold text-gray-700 rounded-lg
                          hover:text-[#1A8EC4] hover:bg-blue-50/80
                          transition-all duration-300 ease-in-out
                          relative group">
                    Divisi
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                                 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#internship"
                   class="px-4 py-2 font-semibold text-gray-700 rounded-lg
                          hover:text-[#1A8EC4] hover:bg-blue-50/80
                          transition-all duration-300 ease-in-out
                          relative group">
                    Mahasiswa
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                                 group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="#testimonial"
                   class="px-4 py-2 font-semibold text-gray-700 rounded-lg
                          hover:text-[#1A8EC4] hover:bg-blue-50/80
                          transition-all duration-300 ease-in-out
                          relative group">
                    Testimoni
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#FFC107] to-[#1A8EC4]
                                 group-hover:w-full transition-all duration-300"></span>
                </a>
            </div>

            <!-- Desktop Login Button -->
            {{-- <div class="hidden lg:flex">
                <a href="admin/login"
                   class="px-6 py-2.5 font-semibold text-white rounded-lg
                          bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD]
                          hover:from-[#0D6EAD] hover:to-[#1A8EC4]
                          shadow-md hover:shadow-xl
                          transform hover:scale-105
                          transition-all duration-300 ease-in-out">
                    Login Admin
                </a>
            </div> --}}

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button"
                    class="lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-500/50
                           transition-all duration-300"
                    onclick="toggleMenu()">
                <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 transition-transform duration-300"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="close-icon" xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 hidden transition-transform duration-300"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu with Slide Animation -->
    <div id="mobile-menu"
         class="lg:hidden overflow-hidden max-h-0 transition-all duration-500 ease-in-out
                bg-white/95 backdrop-blur-lg border-t border-gray-200/50">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="/"
               class="block px-4 py-3 rounded-lg font-semibold text-gray-700
                      hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
                      hover:text-[#1A8EC4] transition-all duration-300
                      transform hover:translate-x-2">
                Beranda
            </a>
            <a href="#about"
               class="block px-4 py-3 rounded-lg font-semibold text-gray-700
                      hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
                      hover:text-[#1A8EC4] transition-all duration-300
                      transform hover:translate-x-2">
                Tentang Kami
            </a>
            <a href="#information"
               class="block px-4 py-3 rounded-lg font-semibold text-gray-700
                      hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
                      hover:text-[#1A8EC4] transition-all duration-300
                      transform hover:translate-x-2">
                Informasi
            </a>
            <a href="#division"
               class="block px-4 py-3 rounded-lg font-semibold text-gray-700
                      hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
                      hover:text-[#1A8EC4] transition-all duration-300
                      transform hover:translate-x-2">
                Divisi
            </a>
            <a href="#internship"
               class="block px-4 py-3 rounded-lg font-semibold text-gray-700
                      hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
                      hover:text-[#1A8EC4] transition-all duration-300
                      transform hover:translate-x-2">
                Mahasiswa
            </a>
            <a href="#testimonial"
               class="block px-4 py-3 rounded-lg font-semibold text-gray-700
                      hover:bg-gradient-to-r hover:from-blue-50 hover:to-orange-50
                      hover:text-[#1A8EC4] transition-all duration-300
                      transform hover:translate-x-2">
                Testimoni
            </a>
            {{-- <a href="admin/login"
               class="block mt-4 px-5 py-4 text-center font-semibold text-white rounded-lg
                      bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD]
                      hover:from-[#0D6EAD] hover:to-[#1A8EC4]
                      shadow-md hover:shadow-lg
                      transform hover:scale-102
                      transition-all duration-300">
                Login Admin
            </a> --}}
        </div>
    </div>
</nav>

<!-- JavaScript for Mobile Menu -->
<script>
    function toggleMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const menuButton = document.getElementById('mobile-menu-button');

        if (mobileMenu.style.maxHeight === '0px' || mobileMenu.style.maxHeight === '') {
            // Open menu
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            menuButton.classList.add('rotate-90');
        } else {
            // Close menu
            mobileMenu.style.maxHeight = '0px';
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            menuButton.classList.remove('rotate-90');
        }
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const mobileMenu = document.getElementById('mobile-menu');
        const menuButton = document.getElementById('mobile-menu-button');

        if (mobileMenu && menuButton &&
            !mobileMenu.contains(event.target) &&
            !menuButton.contains(event.target) &&
            mobileMenu.style.maxHeight !== '0px' &&
            mobileMenu.style.maxHeight !== '') {
            toggleMenu();
        }
    });

    // Close mobile menu when window is resized to desktop size
    window.addEventListener('resize', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        if (window.innerWidth >= 1024 && mobileMenu.style.maxHeight !== '0px') {
            mobileMenu.style.maxHeight = '0px';
            document.getElementById('menu-icon').classList.remove('hidden');
            document.getElementById('close-icon').classList.add('hidden');
        }
    });
</script>
