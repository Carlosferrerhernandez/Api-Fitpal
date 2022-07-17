<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scheduler extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['start_at', 'end_at', 'lesson_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
