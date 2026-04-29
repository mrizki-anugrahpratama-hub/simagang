<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <title>Masa Magang Selesai</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); padding: 35px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 700; }
        .header p { margin: 5px 0 0; opacity: 0.8; font-size: 14px; }
        .content { padding: 30px; color: #374151; line-height: 1.6; text-align: center; }
        
        .summary-box { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: left; }
        .summary-title { font-size: 12px; font-weight: bold; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; }
        .summary-value { font-size: 16px; font-weight: 600; color: #0f172a; margin-bottom: 15px; }
        
        .btn { display: inline-block; background-color: #0D6EAD; color: white; padding: 14px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 10px 0; box-shadow: 0 4px 6px rgba(13, 110, 173, 0.2); transition: all 0.2s; }
        .btn:hover { background-color: #0c4a6e; transform: translateY(-1px); }
        
        .alert-step { background: #fff1f2; color: #be123c; padding: 12px; border-radius: 6px; font-size: 14px; margin-bottom: 25px; border: 1px dashed #fda4af; text-align: left; }

        .footer { background-color: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; padding: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Terima Kasih!</h1>
            <p>Masa Magang Telah Selesai</p>
        </div>
        
        <div class="content">
            <p style="text-align: left;">Halo, <strong>{{ $intern->nama_mahasiswa }}</strong>.</p>
            <p style="text-align: left;">Terima kasih atas dedikasi dan kontribusi Anda selama menjalani program magang di Bakorwil III Malang. Berikut adalah ringkasan magang Anda:</p>
            
            <div class="summary-box">
                <div class="summary-title">Divisi</div>
                <div class="summary-value">{{ $intern->division->nama_divisi ?? '-' }}</div>
                
                <div class="summary-title">Periode Magang</div>
                <div class="summary-value">{{ \Carbon\Carbon::parse($intern->tgl_mulai)->translatedFormat('d M Y') }} — {{ \Carbon\Carbon::parse($intern->tgl_berakhir)->translatedFormat('d M Y') }}</div>
                
                <div class="summary-title">Status Akhir</div>
                <div class="summary-value" style="color: #059669; margin-bottom: 0;">✅ SELESAI</div>
            </div>

            <div class="alert-step">
                <strong>📝 Langkah Terakhir Diperlukan:</strong><br>
                Sertifikat Magang dan Surat Pengembalian Anda sudah siap. Mohon isi ulasan singkat untuk membuka akses unduhan dokumen.
            </div>

            <a href="{{ $url }}" class="btn">Isi Ulasan & Unduh Sertifikat</a>

            <p style="font-size: 12px; color: #9ca3af; margin-top: 20px;">
                Jika tombol di atas tidak berfungsi, salin tautan berikut:<br>
                <a href="{{ $url }}" style="color: #0D6EAD;">{{ $url }}</a>
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Bakorwil III Malang</p>
        </div>
    </div>
</body>
</html>