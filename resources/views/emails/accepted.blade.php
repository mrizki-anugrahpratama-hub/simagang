<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <title>Selamat Bergabung</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #059669 0%, #10B981 100%); padding: 35px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 700; }
        .header p { margin: 5px 0 0; opacity: 0.9; font-size: 14px; }
        .content { padding: 30px; color: #374151; line-height: 1.6; }
        
        .badge { background-color: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; border: 1px solid #34d399; }
        
        .info-card { background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #e5e7eb; padding-bottom: 10px; }
        .info-row:last-child { margin-bottom: 0; border-bottom: none; padding-bottom: 0; }
        .info-label { color: #6b7280; font-size: 13px; }
        .info-val { color: #111827; font-weight: 600; font-size: 14px; text-align: right; }

        .attachment-box { background: #fffbeb; border-left: 4px solid #f59e0b; padding: 15px; margin-top: 25px; border-radius: 4px; color: #92400e; font-size: 14px; }
        
        .footer { background-color: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; padding: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Selamat! Anda Diterima</h1>
            <p>Permohonan Magang Disetujui</p>
        </div>
        
        <div class="content">
            <p>Halo, <strong>{{ $intern->nama_mahasiswa }}</strong>!</p>
            <p>Berdasarkan verifikasi berkas dan ketersediaan kuota, kami informasikan bahwa permohonan magang Anda di Bakorwil III Malang telah <strong>DISETUJUI</strong>.</p>
            
            <div class="info-card">
                <div style="text-align: center; margin-bottom: 15px;">
                    <span class="badge">STATUS: AKTIF</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Divisi Penempatan</span>
                    <span class="info-val">{{ $intern->division->nama_divisi ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Mulai</span>
                    <span class="info-val">{{ \Carbon\Carbon::parse($intern->tgl_mulai)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Selesai</span>
                    <span class="info-val">{{ \Carbon\Carbon::parse($intern->tgl_berakhir)->translatedFormat('d F Y') }}</span>
                </div>
                 <div class="info-row">
                    <span class="info-label">Durasi</span>
                    <span class="info-val">{{ \Carbon\Carbon::parse($intern->tgl_mulai)->diffInDays(\Carbon\Carbon::parse($intern->tgl_berakhir)) }} Hari</span>
                </div>
            </div>

            <div class="attachment-box">
                <strong>📎 PENTING: Surat Balasan Resmi Terlampir</strong><br>
                Kami telah melampirkan Surat Balasan Resmi pada email ini (Attachment). Silakan unduh untuk diserahkan ke pihak kampus.
            </div>

            <p style="margin-top: 20px;"><strong>Instruksi Kedatangan:</strong></p>
            <ul style="font-size: 14px; color: #4b5563; padding-left: 20px;">
                <li>Datang tepat waktu pada tanggal mulai magang (07.30 WIB).</li>
                <li>Mengenakan pakaian bebas, rapi, sopan (berkerah), dan bersepatu.</li>
                <li>Membawa almamater kampus (jika ada).</li>
            </ul>

            <p>Sampai jumpa di Bakorwil III Malang!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Bakorwil III Malang</p>
        </div>
    </div>
</body>
</html>