<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    use Searchable;

    protected const DAYS_FOR_AVAILABILITY = 8;

    protected $fillable = [
        'limit',
        'type',
        'gym_id',
        'category_id',
        'trainer_id',
    ];

    protected $searchableFields = ['*'];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function schedulers()
    {
        return $this->hasMany(Scheduler::class);
    }

    public function scopeAvailable(Builder $query)
    {
        return $query
            ->join('schedulers', function ($join) {
                $join->on('schedulers.lesson_id', '=', 'lessons.id')
                    ->whereDate(
                        'schedulers.start_at',
                        '>=',
                        now()->addDays(static::DAYS_FOR_AVAILABILITY)
                    );
            })
            ->orderBy('schedulers.start_at', 'ASC');
    }
}
