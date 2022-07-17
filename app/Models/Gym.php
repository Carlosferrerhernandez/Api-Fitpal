<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gym extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'address', 'phone'];

    protected $searchableFields = ['*'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
