<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'subject_type', 'subject_id', 'description', 'changes'
    ];

    protected $casts = [
        'changes' => 'array', // Supaya otomatis jadi JSON
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}