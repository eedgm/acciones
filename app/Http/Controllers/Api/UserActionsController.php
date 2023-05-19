<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionCollection;

class UserActionsController extends Controller
{
    public function index(Request $request, User $user): ActionCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $actions = $user
            ->actions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActionCollection($actions);
    }

    public function store(
        Request $request,
        User $user,
        Action $action
    ): Response {
        $this->authorize('update', $user);

        $user->actions()->syncWithoutDetaching([$action->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        User $user,
        Action $action
    ): Response {
        $this->authorize('update', $user);

        $user->actions()->detach($action);

        return response()->noContent();
    }
}
