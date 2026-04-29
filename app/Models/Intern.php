<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Wajib import ini
use App\Models\SystemLog;

class Intern extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'division_id', 
        'nama_mahasiswa', 
        'nim', 
        'asal_kampus', 
        'fakultas', 
        'prodi',
        'email_peserta',
        'no_telp_peserta',
        'nama_pembimbing',
        'nip',
        'no_telp_pembimbing', 
        'tgl_mulai', 
        'tgl_berakhir', 
        'status', 
        'pasfoto_path', 
        'cv_path', 
        'ktm_path', 
        'proposal_path', 
        'surat_permohonan_path',
        'surat_balasan_magang_path', 
        'surat_pengembalian_path', 
        'sertifikat_path',
        'form_penilaian_path',
        'alasan_ditolak',
        'catatan_admin'
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($intern) {
            if (empty($intern->id)) {
                $intern->id = 'INT-' . strtoupper(\Illuminate\Support\Str::random(3));
            }
        });

        // ==========================================
        // 1. SAAT DATA BARU DIBUAT (CREATED)
        // ==========================================
        static::created(function (Intern $intern) {
            // A. Logic Update Kuota Divisi
            if ($intern->status === 'aktif') {
                self::decreaseQuota($intern->division);
            }

            // B. Logic Catat Log Sistem
            // (Posisi coding ini HARUS di dalam kurung kurawal 'created')
            SystemLog::create([
                'user_id' => Auth::id() ?? null, 
                'action' => 'create',
                'subject_type' => self::class,
                'subject_id' => $intern->id,
                'description' => "Menambahkan data mahasiswa baru: {$intern->nama_mahasiswa}",
                'changes' => $intern->getAttributes(),
            ]);
        }); 

        // ==========================================
        // 2. SAAT DATA DIUPDATE (UPDATING)
        // ==========================================
        static::updating(function (Intern $intern) {
            $originalStatus = $intern->getOriginal('status');
            $originalDivisionId = $intern->getOriginal('division_id');

            // A. Logic Update Kuota jika status/divisi berubah
            if ($originalStatus !== $intern->status) {
                if ($originalStatus === 'aktif' && $intern->status === 'selesai') {
                    self::increaseQuota($intern->division);
                }
                if ($originalStatus !== 'aktif' && $intern->status === 'aktif') {
                    self::decreaseQuota($intern->division);
                }
            }

            if ($originalDivisionId !== $intern->division_id) {
                $oldDivision = Division::find($originalDivisionId);
                $newDivision = $intern->division;

                if ($originalStatus === 'aktif') {
                    if ($oldDivision) self::increaseQuota($oldDivision);
                    if ($newDivision) self::decreaseQuota($newDivision);
                }
            }

            // B. Logic Catat Log Perubahan
            $changes = [];
            foreach ($intern->getDirty() as $key => $value) {
                if ($key === 'updated_at') continue;
                $changes[$key] = [
                    'old' => $intern->getOriginal($key),
                    'new' => $value,
                ];
            }

            if (!empty($changes)) {
                SystemLog::create([
                    'user_id' => Auth::id() ?? null,
                    'action' => 'update',
                    'subject_type' => self::class,
                    'subject_id' => $intern->id,
                    'description' => "Mengubah data mahasiswa: {$intern->nama_mahasiswa}",
                    'changes' => $changes,
                ]);
            }
        });

        // ==========================================
        // 3. SAAT DATA DIHAPUS (DELETED)
        // ==========================================
        static::deleted(function (Intern $intern) {
            // A. Kembalikan kuota
            if ($intern->status === 'aktif') {
                self::increaseQuota($intern->division);
            }

            // B. Catat Log Penghapusan
            SystemLog::create([
               'user_id' => Auth::id() ?? null,
               'action' => 'delete',
               'subject_type' => self::class,
               'subject_id' => $intern->id,
               'description' => "Menghapus data mahasiswa: {$intern->nama_mahasiswa}",
               'changes' => $intern->attributesToArray(),
           ]);
        });
    }

    // --- Helper Methods ---

    protected static function decreaseQuota($division): void
    {
        if ($division && $division->used_quota < $division->total_quota) {
            $division->increment('used_quota');
        }
    }

    protected static function increaseQuota($division): void
    {
        if ($division && $division->used_quota > 0) {
            $division->decrement('used_quota');
        }
    }

    protected static function changeQuota($divisionId, $type): void
    {
        $division = \App\Models\Division::find($divisionId);
        if (!$division) return;
    
        if ($type === 'decrease' && $division->used_quota < $division->total_quota) {
            $division->increment('used_quota');
        } elseif ($type === 'increase' && $division->used_quota > 0) {
            $division->decrement('used_quota');
        }
    }

    public function review() {
        return $this->hasOne(Review::class, 'intern_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}