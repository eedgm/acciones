<?php

namespace App\Http\Livewire;

use App\Models\Action;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Agrupacion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActionAgrupacionsDetail extends Component
{
    use AuthorizesRequests;

    public Action $action;
    public Agrupacion $agrupacion;
    public $agrupacionsForSelect = [];
    public $agrupacion_id = null;

    public $showingModal = false;
    public $modalTitle = 'New Agrupacion';

    protected $rules = [
        'agrupacion_id' => ['required', 'exists:agrupacions,id'],
    ];

    public function mount(Action $action): void
    {
        $this->action = $action;
        $this->agrupacionsForSelect = Agrupacion::pluck('nombre', 'id');
        $this->resetAgrupacionData();
    }

    public function resetAgrupacionData(): void
    {
        $this->agrupacion = new Agrupacion();

        $this->agrupacion_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAgrupacion(): void
    {
        $this->modalTitle = trans('crud.action_agrupacions.new_title');
        $this->resetAgrupacionData();

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        $this->authorize('create', Agrupacion::class);

        $this->action->agrupacions()->attach($this->agrupacion_id, []);

        $this->hideModal();
    }

    public function detach($agrupacion): void
    {
        $this->authorize('delete-any', Agrupacion::class);

        $this->action->agrupacions()->detach($agrupacion);

        $this->resetAgrupacionData();
    }

    public function render(): View
    {
        return view('livewire.action-agrupacions-detail', [
            'actionAgrupacions' => $this->action
                ->agrupacions()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
