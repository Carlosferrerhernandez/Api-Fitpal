<?php

namespace App\Http\Controllers\Api;

use App\Models\Gym;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\LessonCollection;

class GymLessonsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Gym $gym)
    {
        $this->authorize('view', $gym);

        $search = $request->get('search', '');

        $lessons = $gym
            ->lessons()
            ->search($search)
            ->latest()
            ->paginate();

        return new LessonCollection($lessons);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gym $gym)
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'in:on-site,on-line'],
            'trainer_id' => ['required', 'exists:trainers,id'],
            'limit' => ['required', 'numeric'],
        ]);

        $lesson = $gym->lessons()->create($validated);

        return new LessonResource($lesson);
    }
}
