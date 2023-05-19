<?php

namespace App\Http\Controllers\Api;

use App\Models\Statu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\StatuResource;
use App\Http\Resources\StatuCollection;
use App\Http\Requests\StatuStoreRequest;
use App\Http\Requests\StatuUpdateRequest;

class StatuController extends Controller
{
    public function index(Request $request): StatuCollection
    {
        $this->authorize('view-any', Statu::class);

        $search = $request->get('search', '');

        $status = Statu::search($search)
            ->latest()
            ->paginate();

        return new StatuCollection($status);
    }

    public function store(StatuStoreRequest $request): StatuResource
    {
        $this->authorize('create', Statu::class);

        $validated = $request->validated();

        $statu = Statu::create($validated);

        return new StatuResource($statu);
    }

    public function show(Request $request, Statu $statu): StatuResource
    {
        $this->authorize('view', $statu);

        return new StatuResource($statu);
    }

    public function update(
        StatuUpdateRequest $request,
        Statu $statu
    ): StatuResource {
        $this->authorize('update', $statu);

        $validated = $request->validated();

        $statu->update($validated);

        return new StatuResource($statu);
    }

    public function destroy(Request $request, Statu $statu): Response
    {
        $this->authorize('delete', $statu);

        $statu->delete();

        return response()->noContent();
    }
}
