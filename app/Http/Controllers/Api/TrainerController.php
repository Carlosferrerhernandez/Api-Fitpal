<?php

namespace App\Http\Controllers\Api;

use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\TrainerCollection;
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
            ->paginate();

        return new TrainerCollection($trainers);
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

        return new TrainerResource($trainer);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trainer $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Trainer $trainer)
    {
        $this->authorize('view', $trainer);

        return new TrainerResource($trainer);
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

        return new TrainerResource($trainer);
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

        return response()->noContent();
    }
}
