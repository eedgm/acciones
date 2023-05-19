<?php

namespace App\Http\Controllers\Api;

use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionResource;
use App\Http\Resources\ActionCollection;
use App\Http\Requests\ActionStoreRequest;
use App\Http\Requests\ActionUpdateRequest;

class ActionController extends Controller
{
    public function index(Request $request): ActionCollection
    {
        $this->authorize('view-any', Action::class);

        $search = $request->get('search', '');

        $actions = Action::search($search)
            ->latest()
            ->paginate();

        return new ActionCollection($actions);
    }

    public function store(ActionStoreRequest $request): ActionResource
    {
        $this->authorize('create', Action::class);

        $validated = $request->validated();

        $action = Action::create($validated);

        return new ActionResource($action);
    }

    public function show(Request $request, Action $action): ActionResource
    {
        $this->authorize('view', $action);

        return new ActionResource($action);
    }

    public function update(
        ActionUpdateRequest $request,
        Action $action
    ): ActionResource {
        $this->authorize('update', $action);

        $validated = $request->validated();

        $action->update($validated);

        return new ActionResource($action);
    }

    public function destroy(Request $request, Action $action): Response
    {
        $this->authorize('delete', $action);

        $action->delete();

        return response()->noContent();
    }
}
