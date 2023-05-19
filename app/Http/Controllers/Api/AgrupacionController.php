<?php

namespace App\Http\Controllers\Api;

use App\Models\Agrupacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgrupacionResource;
use App\Http\Resources\AgrupacionCollection;
use App\Http\Requests\AgrupacionStoreRequest;
use App\Http\Requests\AgrupacionUpdateRequest;

class AgrupacionController extends Controller
{
    public function index(Request $request): AgrupacionCollection
    {
        $this->authorize('view-any', Agrupacion::class);

        $search = $request->get('search', '');

        $agrupacions = Agrupacion::search($search)
            ->latest()
            ->paginate();

        return new AgrupacionCollection($agrupacions);
    }

    public function store(AgrupacionStoreRequest $request): AgrupacionResource
    {
        $this->authorize('create', Agrupacion::class);

        $validated = $request->validated();

        $agrupacion = Agrupacion::create($validated);

        return new AgrupacionResource($agrupacion);
    }

    public function show(
        Request $request,
        Agrupacion $agrupacion
    ): AgrupacionResource {
        $this->authorize('view', $agrupacion);

        return new AgrupacionResource($agrupacion);
    }

    public function update(
        AgrupacionUpdateRequest $request,
        Agrupacion $agrupacion
    ): AgrupacionResource {
        $this->authorize('update', $agrupacion);

        $validated = $request->validated();

        $agrupacion->update($validated);

        return new AgrupacionResource($agrupacion);
    }

    public function destroy(Request $request, Agrupacion $agrupacion): Response
    {
        $this->authorize('delete', $agrupacion);

        $agrupacion->delete();

        return response()->noContent();
    }
}
