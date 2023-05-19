<?php

namespace App\Http\Controllers;

use App\Models\Statu;
use App\Models\Action;
use Illuminate\View\View;
use App\Models\Prioridad;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ActionStoreRequest;
use App\Http\Requests\ActionUpdateRequest;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Action::class);

        $search = $request->get('search', '');

        $actions = Action::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.actions.index', compact('actions', 'search'));
    }

    public function dashboard(Request $request): View
    {
        return view('app.actions.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Action::class);

        $status = Statu::pluck('nombre', 'id');
        $prioridads = Prioridad::pluck('nombre', 'id');

        return view('app.actions.create', compact('status', 'prioridads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Action::class);

        $validated = $request->validated();

        $action = Action::create($validated);

        return redirect()
            ->route('actions.edit', $action)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Action $action): View
    {
        $this->authorize('view', $action);

        return view('app.actions.show', compact('action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Action $action): View
    {
        $this->authorize('update', $action);

        $status = Statu::pluck('nombre', 'id');
        $prioridads = Prioridad::pluck('nombre', 'id');

        return view(
            'app.actions.edit',
            compact('action', 'status', 'prioridads')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ActionUpdateRequest $request,
        Action $action
    ): RedirectResponse {
        $this->authorize('update', $action);

        $validated = $request->validated();

        $action->update($validated);

        return redirect()
            ->route('actions.edit', $action)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Action $action): RedirectResponse
    {
        $this->authorize('delete', $action);

        $action->delete();

        return redirect()
            ->route('actions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
