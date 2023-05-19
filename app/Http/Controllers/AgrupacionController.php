<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Agrupacion;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AgrupacionStoreRequest;
use App\Http\Requests\AgrupacionUpdateRequest;

class AgrupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Agrupacion::class);

        $search = $request->get('search', '');

        $agrupacions = Agrupacion::search($search)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('app.agrupacions.index', compact('agrupacions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Agrupacion::class);

        return view('app.agrupacions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgrupacionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Agrupacion::class);

        $validated = $request->validated();

        $agrupacion = Agrupacion::create($validated);

        return redirect()
            ->route('agrupacions.edit', $agrupacion)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Agrupacion $agrupacion): View
    {
        $this->authorize('view', $agrupacion);

        return view('app.agrupacions.show', compact('agrupacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Agrupacion $agrupacion): View
    {
        $this->authorize('update', $agrupacion);

        return view('app.agrupacions.edit', compact('agrupacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AgrupacionUpdateRequest $request,
        Agrupacion $agrupacion
    ): RedirectResponse {
        $this->authorize('update', $agrupacion);

        $validated = $request->validated();

        $agrupacion->update($validated);

        return redirect()
            ->route('agrupacions.edit', $agrupacion)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Agrupacion $agrupacion
    ): RedirectResponse {
        $this->authorize('delete', $agrupacion);

        $agrupacion->delete();

        return redirect()
            ->route('agrupacions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
