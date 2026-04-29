<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <title>Dokumen Magang</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #0D6EAD 0%, #1A8EC4 100%); padding: 35px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 700; }
        .content { padding: 30px; color: #374151; line-height: 1.6; }
        
        .file-list { margin: 20px 0; background: #f8fafc; border-radius: 8px; padding: 20px; border: 1px solid #e2e8f0; }
        .file-item { display: flex; align-items: center; margin-bottom: 10px; }
        .file-item:last-child { margin-bottom: 0; }
        .icon { font-size: 20px; margin-right: 10px; }
        .file-name { font-weight: 600; color: #334155; }
        
        .note { font-size: 13px; color: #64748b; background: #fff; padding: 10px; border-left: 3px solid #0D6EAD; margin-top: 20px; }

        .footer { background-color: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; padding: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dokumen Magang</h1>
            <p style="margin: 5px 0 0; font-size: 14px; opacity: 0.9;">Terima kasih atas ulasan Anda</p>
        </div>
        
        <div class="content">
            <p>Halo, <strong>{{ $intern->nama_mahasiswa }}</strong>.</p>
            
            <p>Terima kasih telah meluangkan waktu untuk memberikan ulasan. Sesuai prosedur, berikut kami kirimkan dokumen bukti penyelesaian magang Anda:</p>
            
            <div class="file-list">
                <div style="margin-bottom: 10px; font-size: 12px; text-transform: uppercase; color: #94a3b8; font-weight: bold;">Dokumen Terlampir (Attachment):</div>
                <div class="file-item">
                    <span class="icon">📄</span>
                    <span class="file-name">Sertifikat Magang.pdf</span>
                </div>
                <div class="file-item">
                    <span class="icon">📂</span>
                    <span class="file-name">Surat Pengembalian Magang.pdf</span>
                </div>
            </div>

            <div class="note">
                Harap unduh dan simpan dokumen ini dengan aman. Dokumen ini adalah bukti sah bahwa Anda telah menyelesaikan program magang di Bakorwil III Malang.
            </div>
            
            <p style="margin-top: 30px;">Kami mendoakan kesuksesan untuk studi dan karir Anda di masa depan. Sampai jumpa!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistem Informasi Magang Bakorwil III Malang.</p>
        </div>
    </div>
</body>
</html>