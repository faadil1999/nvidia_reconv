<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Skill;
use App\Models\Career;
use Illuminate\Http\Request;
use App\Models\CareerHistory;
use App\Http\Requests\CareerHistoryFormRequest;
use Illuminate\Support\Arr;

class CareerHistoryController extends Controller
{

    /**
     * Function for listing of career history
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $careerHistories = CareerHistory::query()
            ->when($request->has(['search']), function ($query) use ($request) {
                return $query->whereHas('career', function ($query) use ($request) {
                    $query->search(['title', 'description'], $request->get('search'));
                });
            })
            ->when($request->has(['startDate']), function ($query) use ($request) {
                return $query->whereDate('start_date', '=', $request->get('startDate'));
            })
            ->when($request->has(['endDate']), function ($query) use ($request) {
                return $query->whereDate('end_date', '=', $request->get('endDate'));
            })
            ->with(['career'])
            ->paginate(15)
            ->appends($request->query());

        return Inertia::render('Career/History/Index', ['careerHistories' => $careerHistories]);
    }

    /**
     * Function for creating career history
     *
     * @return Response
     */
    public function create()
    {
        $careers = Career::all("id", "title");
        $skills = Skill::all("id", "name");
        $careerHistories = CareerHistory::query()->with(['career', 'skills'])->get(['id', 'start_date', 'end_date', 'career_id']);

        return Inertia::render('Career/History/Form', ['careers' => $careers, 'skills' => $skills, 'career_histories' => $careerHistories]);
    }

    /**
     * Function for storing career history
     *
     * @return Response
     */
    public function store(CareerHistoryFormRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $careerHistory = CareerHistory::create(Arr::except($validated, ['skills']));
        $careerHistory->skills()->sync($validated['skills']);

        return redirect()->back()->wits('success', "Added successfuly");
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
