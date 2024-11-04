<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerHistoryFormRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{

    /**Function for showing the user dashboard */
    public function index()
    {
        return Inertia::render();
    }

    /**
     * Function for storing career history
     *
     * @return Response
     */
    public function storeCareerHistory(CareerHistoryFormRequest $request)
    {
        $validated = $request->validated();

        return redirect()->back()->wits('success', "");
    }

    /**
     * Function for updating career history
     *
     * @param CareerHistoryFromRequest $request
     * @return Response
     */
    public function updateCareerHistory(CareerHistoryFormRequest $request)
    {
        $validate = $request->validated();
    }
}
