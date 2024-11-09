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
        $careerPaths = CareerPath::query()->where('user_id', "=", auth()->id())->with(['career'])->get(["id", "introduction", "career_id"]);

        return Inertia::render('Career/Path/Index', ['careerPaths' => $careerPaths]);
    }

    /**
     * Function for getting the careerPath
     *
     * @param CareerPath $careerPath
     *
     * @return Response
     *
     */
    public function show(CareerPath $careerPath)
    {
        $careerPath->load(['steps.ressources', 'skills']);
        return Inertia::render('Career/Path/Show', ['careerPath' => $careerPath]);
    }

    /**
     * Function for deletting selecting careerPath
     *
     * @param CareerPath $careerPath
     *
     * @return Response
     */
    public function delete(CareerPath $careerPath)
    {
        $careerPath->delete();

        return redirect()->back()->with('success', 'Deleted succeffully');
    }
}
