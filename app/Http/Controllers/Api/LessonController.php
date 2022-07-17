<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AvailableLessonCollection;
use App\Models\Lesson;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Http\Resources\LessonCollection;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    /**
     * @param Request $request
     * @return LessonCollection
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Lesson::class);

        $search = $request->get('search', '');

        $lessons = Lesson::query()
            ->search($search)
            ->latest()
            ->paginate();

        return new LessonCollection($lessons);
    }

    /**
     * @param Request $request
     * @return AvailableLessonCollection
     * @throws AuthorizationException
     */
    public function availableLessons(Request $request)
    {
        $this->authorize('view-any', Lesson::class);

        $search = $request->get('search', '');

        $lessons = Lesson::query()
            ->search($search)
            ->available()
            ->select('lessons.*', 'schedulers.start_at', 'schedulers.end_at')
            ->paginate();

        return new AvailableLessonCollection($lessons);
    }

    /**
     * @param LessonStoreRequest $request
     * @return LessonResource
     * @throws AuthorizationException
     */
    public function store(LessonStoreRequest $request)
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validated();

        $lesson = Lesson::create($validated);

        return new LessonResource($lesson);
    }

    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return LessonResource
     * @throws AuthorizationException
     */
    public function show(Request $request, Lesson $lesson)
    {
        $this->authorize('view', $lesson);

        return new LessonResource($lesson);
    }

    /**
     * @param LessonUpdateRequest $request
     * @param Lesson $lesson
     * @return LessonResource
     * @throws AuthorizationException
     */
    public function update(LessonUpdateRequest $request, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $validated = $request->validated();

        $lesson->update($validated);

        return new LessonResource($lesson);
    }

    /**
     * @param Request $request
     * @param Lesson $lesson
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Lesson $lesson)
    {
        $this->authorize('delete', $lesson);

        $lesson->delete();

        return response()->noContent();
    }
}
