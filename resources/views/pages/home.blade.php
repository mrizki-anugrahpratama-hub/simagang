@extends('layouts.app')

@section('title', 'Simagang')

{{-- Home Page Specific CSS --}}
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
@endpush

@section('content')
    {{-- Hero Section --}}
    <section
        class="relative flex flex-col items-center overflow-hidden bg-white"
    >
        {{-- Decorative clouds --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-20 left-10 w-32 h-16 bg-white/60 rounded-full blur-xl animate-float"
            ></div>
            <div
                class="absolute top-40 right-20 w-40 h-20 bg-blue-100/40 rounded-full blur-2xl animate-float-delayed"
            ></div>
            <div
                class="absolute bottom-40 left-1/4 w-36 h-18 bg-orange-100/30 rounded-full blur-xl animate-float"
            ></div>
        </div>

        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
            <div class="animate-fade-in-up">
                {{-- Animated CSS Illustration --}}
                <div class="mt-0 mb-8">
                    <div class="building-illustration">
                        <div class="sky">
                            {{-- Animated Clouds --}}
                            <div class="cloud cloud-1"></div>
                            <div class="cloud cloud-2"></div>
                            <div class="cloud cloud-3"></div>
                            <div class="cloud cloud-4"></div>

                            {{-- Background Buildings --}}
                            <div class="background-buildings">
                                <div class="bg-building bg-building-1"></div>
                                <div class="bg-building bg-building-2"></div>
                                <div class="bg-building bg-building-3"></div>
                                <div class="bg-building bg-building-4"></div>
                                <div class="bg-building bg-building-5"></div>
                                <div class="bg-building bg-building-6"></div>
                                <div class="bg-building bg-building-7"></div>
                                <div class="bg-building bg-building-8"></div>
                                <div class="bg-building bg-building-9"></div>
                                <div class="bg-building bg-building-10"></div>
                            </div>

                            {{-- City Skyline --}}
                            <div class="city-skyline">
                                {{-- Building 1 (Left) --}}
                                <div class="building building-1">
                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>

                                {{-- Building 2 --}}
                                <div class="building building-2">
                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>

                                {{-- Building 3 --}}
                                <div class="building building-3">
                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>

                                {{-- Main Building (Center - with Sign) --}}
                                <div class="building building-main">
                                    {{-- Building Sign --}}
                                    <div class="building-sign">
                                        <div class="building-sign-text">BAKORWIL III MALANG</div>
                                    </div>

                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>

                                {{-- Building 5 --}}
                                <div class="building building-5">
                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>

                                {{-- Building 6 --}}
                                <div class="building building-6">
                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>

                                {{-- Building 7 --}}
                                <div class="building building-7">
                                    <div class="building-windows">
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                        <div class="window"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- People/Characters --}}
                            <div class="people">
                                <div class="person">
                                    <div class="person-head"></div>
                                    <div class="person-body"></div>
                                    <div class="person-legs">
                                        <div class="person-leg"></div>
                                        <div class="person-leg"></div>
                                    </div>
                                </div>
                                <div class="person">
                                    <div class="person-head"></div>
                                    <div class="person-body"></div>
                                    <div class="person-legs">
                                        <div class="person-leg"></div>
                                        <div class="person-leg"></div>
                                    </div>
                                </div>
                                <div class="person">
                                    <div class="person-head"></div>
                                    <div class="person-body"></div>
                                    <div class="person-legs">
                                        <div class="person-leg"></div>
                                        <div class="person-leg"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Ground --}}
                            <div id="home" class="ground"></div>
                        </div>
                    </div>
                </div>

                {{-- Welcome Badge --}}
                <div
                    class="inline-flex items-center px-6 py-2 mb-2 bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] rounded-full shadow-lg"
                >
                    <span class="text-white font-semibold text-sm tracking-wide">
                        SELAMAT DATANG
                    </span>
                </div>

                {{-- Title --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-2 leading-tight">
                    <span
                        class="bg-gradient-to-r from-[#FFC107] to-[#1A8EC4] bg-clip-text text-transparent drop-shadow-lg"
                    >
                        SIMAGANG
                    </span>
                </h1>

                {{-- Description --}}
                <p
                    class="text-base sm:text-lg lg:text-xl text-gray-700 font-medium mb-6 max-w-3xl mx-auto leading-relaxed"
                >
                    Sistem Informasi Magang ini dirancang untuk membantu mahasiswa dalam
                    pendaftaran kegiatan magang di
                    <span class="font-bold text-[#1A8EC4]">
                        Badan Koordinasi Wilayah III Malang
                    </span>
                </p>

                {{-- CTA Button --}}
                <div class="flex justify-center mb-8">
                    <a
                        href="/alur-penerimaan.pdf"
                        target="_blank"
                        class="items-center gap-2 px-6 py-2.5 font-semibold text-white rounded-full bg-gradient-to-r from-[#1A8EC4] to-[#0D6EAD] hover:from-[#0D6EAD] hover:to-[#1A8EC4] shadow-md hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out"
                    >
                        <span>Alur Penerimaan</span>
                        <svg
                            class="w-5 h-5 inline-block transform group-hover:scale-105 transition-transform duration-300"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    @include('pages.about')

    {{-- Information Section --}}
    @include('pages.information')

    {{-- Division Section --}}
    @include('pages.division')

    {{-- Intern Section --}}
    @include('pages.intern')

    {{-- Testimonial Section --}}
    @include('pages.testimonial')

    {{-- Custom Animations --}}
    <style>
        @keyframes float {
            0%,
            100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes float-delayed {
            0%,
            100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 8s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection
