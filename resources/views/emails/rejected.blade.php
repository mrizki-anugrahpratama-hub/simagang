<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <title>Status Pendaftaran</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        /* Header Merah Elegan */
        .header { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); padding: 35px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 700; }
        .header p { margin: 5px 0 0; opacity: 0.9; font-size: 14px; }
        .content { padding: 30px; color: #374151; line-height: 1.6; }
        
        .status-badge { display: inline-block; background-color: #fef2f2; color: #991b1b; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: bold; border: 1px solid #fecaca; margin-bottom: 20px; }
        
        .message-box { background-color: #fff1f2; border-left: 4px solid #f43f5e; padding: 15px; border-radius: 4px; color: #881337; margin: 20px 0; font-size: 14px; }
        
        .info-table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 10px; }
        .info-table td { padding: 5px 0; color: #4b5563; }
        .info-table td:first-child { width: 100px; font-weight: 600; }

        .footer { background-color: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; padding: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pemberitahuan Seleksi</h1>
            <p>Informasi Status Pendaftaran Magang</p>
        </div>
        
        <div class="content">
            <p>Halo, <strong>{{ $intern->nama_mahasiswa }}</strong>.</p>
            
            <p>Terima kasih atas antusiasme Anda mendaftar program magang di Bakorwil III Malang. Kami telah meninjau berkas pendaftaran Anda secara menyeluruh.</p>
            
            <div style="text-align: center;">
                <span class="status-badge">STATUS: BELUM DITERIMA</span>
            </div>

            <p>Mohon maaf, dengan berat hati kami sampaikan bahwa permohonan magang Anda <strong>belum dapat kami terima</strong> untuk periode ini. Keputusan ini didasarkan pada:</p>

            <div class="message-box">
                <strong>📋 Catatan Seleksi:</strong><br>
                Ketersediaan kuota pada divisi yang dituju telah penuh atau kualifikasi jurusan belum sesuai dengan kebutuhan divisi saat ini.
            </div>

            <p style="margin-bottom: 5px;"><strong>Detail Pendaftaran Anda:</strong></p>
            <table class="info-table">
                <tr>
                    <td>Divisi</td>
                    <td>: {{ $intern->division->nama_divisi ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Asal Kampus</td>
                    <td>: {{ $intern->asal_kampus }}</td>
                </tr>
            </table>
            
            <hr style="border: 0; border-top: 1px dashed #e5e7eb; margin: 25px 0;">

            <p>Keputusan ini tidak mengurangi penilaian kami terhadap potensi akademis Anda. Kami menyarankan Anda untuk:</p>
            <ul style="font-size: 14px; color: #4b5563; padding-left: 20px;">
                <li>Mencoba mendaftar kembali di periode mendatang.</li>
                <li>Mengecek ketersediaan kuota divisi lain yang relevan.</li>
            </ul>

            <p>Tetap semangat dan sukses selalu untuk studi Anda!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistem Informasi Magang Bakorwil III Malang.</p>
        </div>
    </div>
</body>
</html>