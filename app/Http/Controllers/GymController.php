<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;
use App\Http\Requests\GymStoreRequest;
use App\Http\Requests\GymUpdateRequest;

class GymController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Gym::class);

        $search = $request->get('search', '');

        $gyms = Gym::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.gyms.index', compact('gyms', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Gym::class);

        return view('app.gyms.create');
    }

    /**
     * @param \App\Http\Requests\GymStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GymStoreRequest $request)
    {
        $this->authorize('create', Gym::class);

        $validated = $request->validated();

        $gym = Gym::create($validated);

        return redirect()
            ->route('gyms.edit', $gym)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gym $gym)
    {
        $this->authorize('view', $gym);

        return view('app.gyms.show', compact('gym'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Gym $gym)
    {
        $this->authorize('update', $gym);

        return view('app.gyms.edit', compact('gym'));
    }

    /**
     * @param \App\Http\Requests\GymUpdateRequest $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function update(GymUpdateRequest $request, Gym $gym)
    {
        $this->authorize('update', $gym);

        $validated = $request->validated();

        $gym->update($validated);

        return redirect()
            ->route('gyms.edit', $gym)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gym $gym)
    {
        $this->authorize('delete', $gym);

        $gym->delete();

        return redirect()
            ->route('gyms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
