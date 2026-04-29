<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logo-prov-jatim.png') }}" />
    <title>Pendaftaran Diterima</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #0D6EAD 0%, #1A8EC4 100%); padding: 35px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 700; letter-spacing: 0.5px; }
        .header p { margin: 5px 0 0; opacity: 0.9; font-size: 14px; }
        .content { padding: 30px; color: #374151; line-height: 1.6; }
        
        /* Section Styling */
        .section-title { font-size: 14px; font-weight: bold; color: #0D6EAD; text-transform: uppercase; margin-top: 25px; margin-bottom: 10px; border-bottom: 2px solid #e5e7eb; padding-bottom: 5px; }
        .data-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .data-table td { padding: 6px 0; vertical-align: top; }
        .data-table td.label { width: 140px; color: #6b7280; }
        .data-table td.value { color: #111827; font-weight: 500; }
        
        .status-box { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; color: #1e40af; }
        .footer { background-color: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; padding: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pendaftaran Berhasil</h1>
            <p>Data Anda telah kami terima</p>
        </div>
        
        <div class="content">
            <p>Halo, <strong>{{ $intern->nama_mahasiswa }}</strong>.</p>
            <p>Terima kasih telah mendaftar. Data pendaftaran dan berkas Anda telah tersimpan di sistem kami. Saat ini status pendaftaran Anda adalah:</p>
            
            <div class="status-box">
                <strong>⏳ MENUNGGU VERIFIKASI (PENDING)</strong><br>
                Admin akan memeriksa kelengkapan berkas Anda dalam 1-3 hari kerja.
            </div>

            <div class="section-title">I. Identitas Pribadi</div>
            <table class="data-table">
                <tr><td class="label">Nama Lengkap</td><td class="value">: {{ $intern->nama_mahasiswa }}</td></tr>
                <tr><td class="label">NIM</td><td class="value">: {{ $intern->nim }}</td></tr>
                <tr><td class="label">No. WhatsApp</td><td class="value">: {{ $intern->no_telp_peserta }}</td></tr>
                <tr><td class="label">Email</td><td class="value">: {{ $intern->email_peserta }}</td></tr>
            </table>

            <div class="section-title">II. Data Akademik</div>
            <table class="data-table">
                <tr><td class="label">Asal Kampus</td><td class="value">: {{ $intern->asal_kampus }}</td></tr>
                <tr><td class="label">Fakultas</td><td class="value">: {{ $intern->fakultas }}</td></tr>
                <tr><td class="label">Prodi</td><td class="value">: {{ $intern->prodi }}</td></tr>
            </table>

            <div class="section-title">III. Rencana Magang</div>
            <table class="data-table">
                <tr><td class="label">Divisi Tujuan</td><td class="value">: {{ $intern->division->nama_divisi ?? '-' }}</td></tr>
                <tr><td class="label">Periode</td><td class="value">: {{ \Carbon\Carbon::parse($intern->tgl_mulai)->translatedFormat('d M Y') }} s.d {{ \Carbon\Carbon::parse($intern->tgl_berakhir)->translatedFormat('d M Y') }}</td></tr>
                <tr><td class="label">Dosen Pembimbing</td><td class="value">: {{ $intern->nama_pembimbing }}</td></tr>
                <tr><td class="label">No. HP Dosen</td><td class="value">: {{ $intern->no_telp_pembimbing }}</td></tr>
            </table>

            <div class="section-title">IV. Kelengkapan Berkas</div>
            <p style="font-size: 13px; color: #666; margin-top: 5px;">
                ✅ Pasfoto &nbsp; ✅ KTM &nbsp; ✅ CV &nbsp; ✅ Proposal &nbsp; ✅ Surat Permohonan
            </p>

            {{-- <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #059669; line-height: 1.8;">
                @if($intern->cv_path) <li>✅ Curriculum Vitae (CV) = <td class="value">: {{ $intern->cv_path }}</td></li> @endif
                @if($intern->proposal_path) <li>✅ Proposal Magang = <td class="value">: {{ $intern->proposal_path }}</td></li> @endif
                @if($intern->surat_permohonan_path) <li>✅ Surat Permohonan = <td class="value">: {{ $intern->surat_permohonan_path }}</td></li> @endif
                @if($intern->ktm_path) <li>✅ Scan KTM / Identitas = <td class="value">: {{ $intern->ktm_path }}</td></li> @endif
            </ul> --}}

            <p style="margin-top: 30px; font-size: 14px;">Kami akan mengirimkan notifikasi persetujuan (Surat Balasan) atau penolakan melalui email ini.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Bakorwil III Malang - Simagang System</p>
        </div>
    </div>
</body>
</html>