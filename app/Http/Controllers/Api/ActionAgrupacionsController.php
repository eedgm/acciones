<?php
namespace App\Http\Controllers\Api;

use App\Models\Action;
use App\Models\Agrupacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgrupacionCollection;

class ActionAgrupacionsController extends Controller
{
    public function index(
        Request $request,
        Action $action
    ): AgrupacionCollection {
        $this->authorize('view', $action);

        $search = $request->get('search', '');

        $agrupacions = $action
            ->agrupacions()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgrupacionCollection($agrupacions);
    }

    public function store(
        Request $request,
        Action $action,
        Agrupacion $agrupacion
    ): Response {
        $this->authorize('update', $action);

        $action->agrupacions()->syncWithoutDetaching([$agrupacion->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Action $action,
        Agrupacion $agrupacion
    ): Response {
        $this->authorize('update', $action);

        $action->agrupacions()->detach($agrupacion);

        return response()->noContent();
    }
}
