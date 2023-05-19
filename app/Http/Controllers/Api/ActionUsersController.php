<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class ActionUsersController extends Controller
{
    public function index(Request $request, Action $action): UserCollection
    {
        $this->authorize('view', $action);

        $search = $request->get('search', '');

        $users = $action
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(
        Request $request,
        Action $action,
        User $user
    ): Response {
        $this->authorize('update', $action);

        $action->users()->syncWithoutDetaching([$user->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Action $action,
        User $user
    ): Response {
        $this->authorize('update', $action);

        $action->users()->detach($user);

        return response()->noContent();
    }
}
