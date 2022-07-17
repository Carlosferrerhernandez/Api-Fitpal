<?php

namespace App\Http\Controllers\Api;

use App\Models\Gym;
use Illuminate\Http\Request;
use App\Http\Resources\GymResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\GymCollection;
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
            ->paginate();

        return new GymCollection($gyms);
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

        return new GymResource($gym);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gym $gym)
    {
        $this->authorize('view', $gym);

        return new GymResource($gym);
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

        return new GymResource($gym);
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

        return response()->noContent();
    }
}
