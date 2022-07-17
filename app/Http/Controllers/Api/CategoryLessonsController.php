<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\LessonCollection;

class CategoryLessonsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $lessons = $category
            ->lessons()
            ->search($search)
            ->latest()
            ->paginate();

        return new LessonCollection($lessons);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validate([
            'type' => ['required', 'in:on-site,on-line'],
            'trainer_id' => ['required', 'exists:trainers,id'],
            'gym_id' => ['nullable', 'exists:gyms,id'],
            'limit' => ['required', 'numeric'],
        ]);

        $lesson = $category->lessons()->create($validated);

        return new LessonResource($lesson);
    }
}
