<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Action;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActionUsersDetail extends Component
{
    use AuthorizesRequests;

    public Action $action;
    public User $user;
    public $usersForSelect = [];
    public $user_id = null;

    public $showingModal = false;
    public $modalTitle = 'New User';

    protected $rules = [
        'user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Action $action): void
    {
        $this->action = $action;
        $this->usersForSelect = User::pluck('name', 'id');
        $this->resetUserData();
    }

    public function resetUserData(): void
    {
        $this->user = new User();

        $this->user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newUser(): void
    {
        $this->modalTitle = trans('crud.action_users.new_title');
        $this->resetUserData();

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

        $this->authorize('create', User::class);

        $this->action->users()->attach($this->user_id, []);

        $this->hideModal();
    }

    public function detach($user): void
    {
        $this->authorize('delete-any', User::class);

        $this->action->users()->detach($user);

        $this->resetUserData();
    }

    public function render(): View
    {
        return view('livewire.action-users-detail', [
            'actionUsers' => $this->action
                ->users()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
