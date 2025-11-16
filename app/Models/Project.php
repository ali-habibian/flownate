<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'description',
        'color',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        // Auto-set team_id when creating via Team relationship
        static::creating(function ($project) {
            if (empty($project->team_id)) {
                $project->team_id = auth()->user()?->currentTeam?->id;
            }
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(\Laravel\Jetstream\Team::class);
    }

    public function boards(): HasMany
    {
        return $this->hasMany(Board::class)->orderBy('order');
    }

    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Board::class);
    }
}
