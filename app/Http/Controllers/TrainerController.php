<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Http\Requests\TrainerStoreRequest;
use App\Http\Requests\TrainerUpdateRequest;

class TrainerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Trainer::class);

        $search = $request->get('search', '');

        $trainers = Trainer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.trainers.index', compact('trainers', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Trainer::class);

        return view('app.trainers.create');
    }

    /**
     * @param \App\Http\Requests\TrainerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainerStoreRequest $request)
    {
        $this->authorize('create', Trainer::class);

        $validated = $request->validated();

        $trainer = Trainer::create($validated);

        return redirect()
            ->route('trainers.edit', $trainer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Trainer $trainer)
    {
        $this->authorize('view', $trainer);

        return view('app.trainers.show', compact('trainer'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Trainer $trainer)
    {
        $this->authorize('update', $trainer);

        return view('app.trainers.edit', compact('trainer'));
    }

    /**
     * @param \App\Http\Requests\TrainerUpdateRequest $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(TrainerUpdateRequest $request, Trainer $trainer)
    {
        $this->authorize('update', $trainer);

        $validated = $request->validated();

        $trainer->update($validated);

        return redirect()
            ->route('trainers.edit', $trainer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Trainer $trainer)
    {
        $this->authorize('delete', $trainer);

        $trainer->delete();

        return redirect()
            ->route('trainers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
