<?php

namespace App\Http\Controllers\Api;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\LessonCollection;

class TrainerLessonsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Trainer $trainer)
    {
        $this->authorize('view', $trainer);

        $search = $request->get('search', '');

        $lessons = $trainer
            ->lessons()
            ->search($search)
            ->latest()
            ->paginate();

        return new LessonCollection($lessons);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Trainer $trainer)
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'in:on-site,on-line'],
            'gym_id' => ['nullable', 'exists:gyms,id'],
            'limit' => ['required', 'numeric'],
        ]);

        $lesson = $trainer->lessons()->create($validated);

        return new LessonResource($lesson);
    }
}
