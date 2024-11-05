<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CareerHistoryFormRequest;
use Inertia\Inertia;

class CareerHistoryController extends Controller
{

    /**
     * Function for listing of career history
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Career/History/Index');
    }

    /**
     * Function for creating career history
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Career/History/Form');
    }

    /**
     * Function for storing career history
     *
     * @return Response
     */
    public function store(CareerHistoryFormRequest $request)
    {
        $validated = $request->validated();
        dd($validated);
        return redirect()->back()->wits('success', "");
    }

    /**
     * Function for updating career history
     *
     * @param CareerHistoryFromRequest $request
     * @return Response
     */
    public function update(CareerHistoryFormRequest $request)
    {
        $validate = $request->validated();
    }
}
