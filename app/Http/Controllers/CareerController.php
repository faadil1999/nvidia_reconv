<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CareerController extends Controller
{

    /**
     * Function for storing model
     *
     * @return Response
     */
    public function store()
    {

        return Inertia::render();
    }
}
