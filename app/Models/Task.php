<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelIdea\Helper\App\Models\_IH_Project_QB;

class Task extends Model
{
    protected $fillable = [
        'board_id',
        'title',
        'description',
        'due_date',
        'order',
    ];

    protected $casts = [
        'due_date' => 'date',
        'order' => 'integer',
    ];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function project(): BelongsTo|_IH_Project_QB
    {
        return $this->board->project();
    }

    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(TaskUser::class)
            ->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
