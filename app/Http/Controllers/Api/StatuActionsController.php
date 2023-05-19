<?php

namespace App\Http\Controllers\Api;

use App\Models\Statu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionResource;
use App\Http\Resources\ActionCollection;

class StatuActionsController extends Controller
{
    public function index(Request $request, Statu $statu): ActionCollection
    {
        $this->authorize('view', $statu);

        $search = $request->get('search', '');

        $actions = $statu
            ->actions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActionCollection($actions);
    }

    public function store(Request $request, Statu $statu): ActionResource
    {
        $this->authorize('create', Action::class);

        $validated = $request->validate([
            'numero' => ['nullable', 'max:255', 'string'],
            'fecha' => ['nullable', 'date'],
            'accion' => ['required', 'max:255', 'string'],
            'descripcion' => ['nullable', 'max:255', 'string'],
            'prioridad_id' => ['required', 'exists:prioridads,id'],
        ]);

        $action = $statu->actions()->create($validated);

        return new ActionResource($action);
    }
}
