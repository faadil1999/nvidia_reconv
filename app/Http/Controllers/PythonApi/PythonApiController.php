<?php

namespace App\Http\Controllers\PythonApi;

use App\Http\Controllers\Controller;
use App\Services\PythonApiService;
use Illuminate\Http\Request;

class PythonApiController extends Controller
{
    protected $pythonApiService;

    public function __construct(PythonApiService $pythonApiService)
    {
        $this->pythonApiService = $pythonApiService;
    }

    /**
     * Function for getting the response throught the python api
     *
     * @param Request $request
     * @return Response
     */
    public function getResponse(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        try {
            $response = $this->pythonApiService->getChatResponse($request);
            return response()->json(['response' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
