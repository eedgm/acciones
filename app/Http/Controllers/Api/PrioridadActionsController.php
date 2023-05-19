<?php

namespace App\Http\Controllers\Api;

use App\Models\Prioridad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionResource;
use App\Http\Resources\ActionCollection;

class PrioridadActionsController extends Controller
{
    public function index(
        Request $request,
        Prioridad $prioridad
    ): ActionCollection {
        $this->authorize('view', $prioridad);

        $search = $request->get('search', '');

        $actions = $prioridad
            ->actions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActionCollection($actions);
    }

    public function store(
        Request $request,
        Prioridad $prioridad
    ): ActionResource {
        $this->authorize('create', Action::class);

        $validated = $request->validate([
            'numero' => ['nullable', 'max:255', 'string'],
            'fecha' => ['nullable', 'date'],
            'accion' => ['required', 'max:255', 'string'],
            'descripcion' => ['nullable', 'max:255', 'string'],
            'statu_id' => ['required', 'exists:status,id'],
        ]);

        $action = $prioridad->actions()->create($validated);

        return new ActionResource($action);
    }
}
