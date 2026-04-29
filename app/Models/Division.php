<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Wajib import ini
use App\Models\SystemLog;

class Division extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($intern) {
            if (empty($intern->id)) {
                $intern->id = 'DIV-' . strtoupper(\Illuminate\Support\Str::random(3));
            }
        });

        static::created(function (Division $division) {
            SystemLog::create([
                'user_id' => Auth::id() ?? null,
                'action' => 'create',
                'subject_type' => self::class,
                'subject_id' => $division->id,
                'description' => "Menambahkan data divisi baru: {$division->nama_divisi}",
                'changes' => $division->getAttributes(),
            ]);
        });

        static::updated(function (Division $division) {
            // B. Logic Catat Log Perubahan
            $changes = [];
            foreach ($division->getDirty() as $key => $value) {
                if ($key === 'updated_at') continue;
                $changes[$key] = [
                    'old' => $division->getOriginal($key),
                    'new' => $value,
                ];
            }

            if (!empty($changes)) {
                SystemLog::create([
                    'user_id' => Auth::id() ?? null,
                    'action' => 'update',
                    'subject_type' => self::class,
                    'subject_id' => $division->id,
                    'description' => "Mengubah data divisi: {$division->nama_divisi}",
                    'changes' => $changes,
                ]);
            }
        
        });

        static::deleted(function (Division $division) {
            SystemLog::create([
                'user_id' => Auth::id() ?? null,
                'action' => 'delete',
                'subject_type' => self::class,
                'subject_id' => $division->id,
                'description' => "Menghapus data divisi: {$division->nama_divisi}",
                'changes' => $division->attributesToArray(),
            ]);
        });
    }

    protected $fillable = [
        'nama_divisi',
        'competency',
        'icon_type',
        'color_scheme',
        'total_quota',
        'used_quota',
        'updated_date'
    ];

    protected $casts = [
        'updated_date' => 'date',
    ];

    public function interns()
    {
        return $this->hasMany(Intern::class);
    }

    // Accessor for remaining quota
    public function getRemainingQuotaAttribute()
    {
        return $this->total_quota - $this->used_quota;
    }

    // Accessor for progress percentage
    public function getProgressPercentageAttribute()
    {
        if ($this->total_quota == 0) return 0;
        return round(($this->used_quota / $this->total_quota) * 100, 2);
    }
}

