<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Terkirim</title>
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-10 rounded-2xl shadow-xl text-center max-w-lg w-full">
        <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Ulasan Terkirim!</h2>
        <p class="text-gray-600 mb-8">
            Terima kasih {{ $intern->nama_mahasiswa }}, ulasan Anda sangat berarti bagi kami di Bakorwil III Malang.
        </p>
        <a href="/" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>