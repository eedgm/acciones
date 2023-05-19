<?php
namespace App\Http\Controllers\Api;

use App\Models\Action;
use App\Models\Agrupacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionCollection;

class AgrupacionActionsController extends Controller
{
    public function index(
        Request $request,
        Agrupacion $agrupacion
    ): ActionCollection {
        $this->authorize('view', $agrupacion);

        $search = $request->get('search', '');

        $actions = $agrupacion
            ->actions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActionCollection($actions);
    }

    public function store(
        Request $request,
        Agrupacion $agrupacion,
        Action $action
    ): Response {
        $this->authorize('update', $agrupacion);

        $agrupacion->actions()->syncWithoutDetaching([$action->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Agrupacion $agrupacion,
        Action $action
    ): Response {
        $this->authorize('update', $agrupacion);

        $agrupacion->actions()->detach($action);

        return response()->noContent();
    }
}
