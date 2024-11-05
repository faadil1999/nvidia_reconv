<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CareerHistoryFormRequest;

class DashboardController extends Controller
{

    /**Function for showing the user dashboard */
    public function index()
    {
        /********Logo Application *******/
        $imagePath = 'public/images/logo_nvidia_reconv.png';
        $logoApp = Storage::url($imagePath);

        return Inertia::render('Dashboard', ['image_url' => asset($logoApp)]);
    }
}
