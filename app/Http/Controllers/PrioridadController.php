<?php

namespace App\Http\Controllers;

use App\Models\Prioridad;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PrioridadStoreRequest;
use App\Http\Requests\PrioridadUpdateRequest;

class PrioridadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Prioridad::class);

        $search = $request->get('search', '');

        $prioridads = Prioridad::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.prioridads.index', compact('prioridads', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Prioridad::class);

        return view('app.prioridads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrioridadStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Prioridad::class);

        $validated = $request->validated();

        $prioridad = Prioridad::create($validated);

        return redirect()
            ->route('prioridads.edit', $prioridad)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Prioridad $prioridad): View
    {
        $this->authorize('view', $prioridad);

        return view('app.prioridads.show', compact('prioridad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Prioridad $prioridad): View
    {
        $this->authorize('update', $prioridad);

        return view('app.prioridads.edit', compact('prioridad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PrioridadUpdateRequest $request,
        Prioridad $prioridad
    ): RedirectResponse {
        $this->authorize('update', $prioridad);

        $validated = $request->validated();

        $prioridad->update($validated);

        return redirect()
            ->route('prioridads.edit', $prioridad)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Prioridad $prioridad
    ): RedirectResponse {
        $this->authorize('delete', $prioridad);

        $prioridad->delete();

        return redirect()
            ->route('prioridads.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
