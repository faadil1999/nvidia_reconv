<?php

namespace App\Http\Controllers;

use App\Models\CareerPath;
use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    /**
     * Function for getting the list of careerPath
     *
     * @return Response
     */
    public function index()
    {
        $careerPaths = CareerPath::all();
        $careerPaths->load(['steps']);
    }
}
