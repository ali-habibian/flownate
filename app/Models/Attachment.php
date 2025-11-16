<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'filename',
        'path',
        'mime_type',
        'size',
    ];

    protected $casts = [
        'size' => 'integer',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper: get public URL (works with local + S3)
    public function url(): string
    {
        return Storage::disk('public')->url($this->path);
    }

    // Auto-delete file when attachment record is deleted
    protected static function booted(): void
    {
        static::deleting(function ($attachment) {
            if (Storage::disk('public')->exists($attachment->path)) {
                Storage::disk('public')->delete($attachment->path);
            }
        });
    }
}
