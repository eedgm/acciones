<?php

namespace App\Http\Controllers;

use App\Models\Statu;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StatuStoreRequest;
use App\Http\Requests\StatuUpdateRequest;

class StatuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Statu::class);

        $search = $request->get('search', '');

        $status = Statu::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.status.index', compact('status', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Statu::class);

        return view('app.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatuStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Statu::class);

        $validated = $request->validated();

        $statu = Statu::create($validated);

        return redirect()
            ->route('estatus.edit', $statu)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Statu $statu): View
    {
        $this->authorize('view', $statu);

        return view('app.status.show', compact('statu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $statu): View
    {
        $statu = Statu::find($statu);
        $this->authorize('update', $statu);

        return view('app.status.edit', compact('statu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StatuUpdateRequest $request,
        Statu $statu
    ): RedirectResponse {
        $this->authorize('update', $statu);

        $validated = $request->validated();

        $statu->update($validated);

        return redirect()
            ->route('estatus.edit', $statu)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Statu $statu): RedirectResponse
    {
        $this->authorize('delete', $statu);

        $statu->delete();

        return redirect()
            ->route('estatus.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
