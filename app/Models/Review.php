<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Wajib import ini
use App\Models\SystemLog;

class Review extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($intern) {
            if (empty($intern->id)) {
                $intern->id = 'RVW-' . strtoupper(\Illuminate\Support\Str::random(3));
            }
        });

        static::created(function (Review $review) {
            SystemLog::create([
                'user_id' => Auth::id() ?? null,
                'action' => 'create',
                'subject_type' => self::class,
                'subject_id' => $review->id,
                'description' => "Menambahkan data ulasan baru: {$review->nama_reviewer}",
                'changes' => $review->getAttributes(),
            ]);
        });

        static::updated(function (Review $review) {
            // B. Logic Catat Log Perubahan
            $changes = [];
            foreach ($review->getDirty() as $key => $value) {
                if ($key === 'updated_at') continue;
                $changes[$key] = [
                    'old' => $review->getOriginal($key),
                    'new' => $value,
                ];
            }

            if (!empty($changes)) {
                SystemLog::create([
                    'user_id' => Auth::id() ?? null,
                    'action' => 'update',
                    'subject_type' => self::class,
                    'subject_id' => $review->id,
                    'description' => "Mengubah data ulasan: {$review->nama_reviewer}",
                    'changes' => $changes,
                ]);
            }
        
        });

        static::deleted(function (Review $review) {
            SystemLog::create([
                'user_id' => Auth::id() ?? null,
                'action' => 'delete',
                'subject_type' => self::class,
                'subject_id' => $review->id,
                'description' => "Menghapus data ulasan: {$review->nama_reviewer}",
                'changes' => $review->attributesToArray(),
            ]);
        });
    }

    protected $fillable = [
        'intern_id', // <--- Wajib ada
        'nama_reviewer', 
        'asal_kampus', 
        'tgl_review', 
        'rating', 
        'content', 
        'is_visible',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_visible', true);
    }

    // Relasi balik ke Intern
    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
}