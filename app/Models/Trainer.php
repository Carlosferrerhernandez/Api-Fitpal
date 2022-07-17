<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['first_name', 'last_name', 'phone'];

    protected $appends = [
      'full_name'
    ];

    protected $searchableFields = ['*'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
