<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use App\Models\Scheduler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchedulerResource;
use App\Http\Resources\SchedulerCollection;

class LessonSchedulersController extends Controller
{
    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return SchedulerCollection
     * @throws AuthorizationException
     */
    public function index(Request $request, Lesson $lesson)
    {
        $this->authorize('view', $lesson);

        $search = $request->get('search', '');

        $schedulers = $lesson
            ->schedulers()
            ->search($search)
            ->latest()
            ->paginate();

        return new SchedulerCollection($schedulers);
    }

    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return SchedulerResource
     * @throws AuthorizationException
     */
    public function store(Request $request, Lesson $lesson)
    {
        $this->authorize('create', Scheduler::class);

        $validated = $request->validate([
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
        ]);

        $scheduler = $lesson->schedulers()->create($validated);

        return new SchedulerResource($scheduler);
    }
}
