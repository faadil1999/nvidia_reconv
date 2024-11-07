<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CareerHistoryFormRequest;
use App\Models\CareerHistory;

class DashboardController extends Controller
{

    /**Function for showing the user dashboard */
    public function index()
    {
        /********Logo Application *******/
        $imagePath = 'public/images/logo_nvidia_reconv.png';
        $logoApp = Storage::url($imagePath);
        $careers = Career::all("id", "title");
        $careerHistories = CareerHistory::all();
        $careerHistories->load(['career', 'skills']);
        return Inertia::render('Dashboard', [
            'image_url' => asset($logoApp),
            'careers' => $careers,
            'careerHistories' => $careerHistories
        ]);
    }
}
