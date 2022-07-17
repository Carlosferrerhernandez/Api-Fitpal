<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Lesson;
use App\Models\Trainer;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;

class LessonController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Lesson::class);

        $search = $request->get('search', '');

        $lessons = Lesson::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.lessons.index', compact('lessons', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Lesson::class);

        $categories = Category::pluck('name', 'id');
        $trainers = Trainer::pluck('first_name', 'id');
        $gyms = Gym::pluck('name', 'id');

        return view(
            'app.lessons.create',
            compact('categories', 'trainers', 'gyms')
        );
    }

    /**
     * @param \App\Http\Requests\LessonStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonStoreRequest $request)
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validated();

        $lesson = Lesson::create($validated);

        return redirect()
            ->route('lessons.edit', $lesson)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Lesson $lesson)
    {
        $this->authorize('view', $lesson);

        return view('app.lessons.show', compact('lesson'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $categories = Category::pluck('name', 'id');
        $trainers = Trainer::pluck('first_name', 'id');
        $gyms = Gym::pluck('name', 'id');

        return view(
            'app.lessons.edit',
            compact('lesson', 'categories', 'trainers', 'gyms')
        );
    }

    /**
     * @param \App\Http\Requests\LessonUpdateRequest $request
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(LessonUpdateRequest $request, Lesson $lesson)
    {
        $this->authorize('update', $lesson);

        $validated = $request->validated();

        $lesson->update($validated);

        return redirect()
            ->route('lessons.edit', $lesson)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lesson $lesson)
    {
        $this->authorize('delete', $lesson);

        $lesson->delete();

        return redirect()
            ->route('lessons.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
