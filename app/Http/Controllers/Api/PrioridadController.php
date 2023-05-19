<?php

namespace App\Http\Controllers\Api;

use App\Models\Prioridad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrioridadResource;
use App\Http\Resources\PrioridadCollection;
use App\Http\Requests\PrioridadStoreRequest;
use App\Http\Requests\PrioridadUpdateRequest;

class PrioridadController extends Controller
{
    public function index(Request $request): PrioridadCollection
    {
        $this->authorize('view-any', Prioridad::class);

        $search = $request->get('search', '');

        $prioridads = Prioridad::search($search)
            ->latest()
            ->paginate();

        return new PrioridadCollection($prioridads);
    }

    public function store(PrioridadStoreRequest $request): PrioridadResource
    {
        $this->authorize('create', Prioridad::class);

        $validated = $request->validated();

        $prioridad = Prioridad::create($validated);

        return new PrioridadResource($prioridad);
    }

    public function show(
        Request $request,
        Prioridad $prioridad
    ): PrioridadResource {
        $this->authorize('view', $prioridad);

        return new PrioridadResource($prioridad);
    }

    public function update(
        PrioridadUpdateRequest $request,
        Prioridad $prioridad
    ): PrioridadResource {
        $this->authorize('update', $prioridad);

        $validated = $request->validated();

        $prioridad->update($validated);

        return new PrioridadResource($prioridad);
    }

    public function destroy(Request $request, Prioridad $prioridad): Response
    {
        $this->authorize('delete', $prioridad);

        $prioridad->delete();

        return response()->noContent();
    }
}
