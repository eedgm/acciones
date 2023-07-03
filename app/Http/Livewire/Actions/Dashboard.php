<?php

namespace App\Http\Livewire\Actions;

use App\Models\User;
use App\Models\Statu;
use App\Models\Action;
use Livewire\Component;
use App\Models\Prioridad;
use Illuminate\View\View;
use App\Models\Agrupacion;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    use WithPagination;

    public User $user;
    public Action $action;
    public $actionEdit = null;
    public $status, $clusters, $priorities;
    public $search = '';
    public $filterCompleted = false;

    public $modalTitle = 'Nueva Acción';
    public $showingModal = false;
    public $modalTitleEdit = 'Editar Acción';
    public $showingModalEdit = false;

    public $actionFecha;

    protected $rules = [
        'action.numero' => ['nullable', 'max:255', 'string'],
        'actionFecha' => ['nullable', 'date'],
        'action.accion' => ['required', 'max:255', 'string'],
        'action.descripcion' => ['nullable', 'string'],
        'action.statu_id' => ['required', 'exists:status,id'],
        'action.prioridad_id' => ['required', 'exists:prioridads,id'],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->status = Statu::pluck('nombre', 'id');
        $this->clusters = Agrupacion::pluck('nombre', 'id');
        $this->priorities = Prioridad::pluck('nombre', 'id');
    }

    public function create()
    {
        $this->action = new Action();
        $this->showingModal = true;
    }

    public function searchResult()
    {
        // dump($this->search);
        // $this->search = $search;
    }

    public function edit(Action $action)
    {
        $this->editing = true;
        $this->action = $action;
        $this->actionEdit = $action;

        $this->actionFecha = $this->action->fecha->format('Y-m-d');

        $this->showingModalEdit = true;
    }

    public function saveAction()
    {
        $this->validate();

        $this->action->fecha = \Carbon\Carbon::parse($this->actionFecha);

        $this->action->save();

        $this->showingModal = false;

        $this->showingModalEdit = true;

        $this->actionEdit = $this->action;

        $this->dispatchBrowserEvent('refresh');
    }

    public function filterCompleted()
    {
        $this->filterCompleted = !$this->filterCompleted;
    }

    public function updateAction()
    {
        $this->validate();

        $this->action->fecha = \Carbon\Carbon::parse($this->actionFecha);

        $this->action->save();

        $this->actionEdit = null;

        $this->showingModalEdit = false;
    }

    public function render(): View
    {
        if (!$this->user->isSuperAdmin()) {
            $actions = $this->user->actions()
                ->when($this->search, function ($query) {
                    $query->where('accion', 'like', "%{$this->search}%")
                        ->orWhere('descripcion', 'like', "%{$this->search}%");
                })
                ->where('statu_id', $this->filterCompleted ? '=' : '!=', 3)
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $actions = Action::when($this->search, function ($query) {
                    $query->where('accion', 'like', "%{$this->search}%")
                        ->orWhere('descripcion', 'like', "%{$this->search}%");
                })
                ->where('statu_id', $this->filterCompleted ? '=' : '!=', 3)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return view('livewire.actions.dashboard', compact('actions'));
    }
}
