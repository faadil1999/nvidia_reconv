<?php

namespace App\Http\Controllers;

use App\Models\CareerPath;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CareerPathController extends Controller
{
    /**
     * Function for getting the list of careerPath
     *
     * @return Response
     */
    public function index()
    {
        $careerPaths = CareerPath::all("id", "introduction", "career_id");

        $careerPaths->load(['career']);

        return Inertia::render('Career/Path/Index', ['careerPaths' => $careerPaths]);
    }
}
