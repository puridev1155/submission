<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;
use App\Http\Controllers\JsonResponse;
use App\Http\Requests\PrizeRequest;
use Illuminate\Support\Facades\Log;

class PrizeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Log::info('Prize Controller Store Method Invoked');
        Log::info('Request Data: ', $request->all());
        return $request->all();
        $validated = $request->validated();
        $validated['device'] =  $request->userAgent();
        $validated['wip'] = $request->ip();
        $data = Prize::create($validated);
        return response()->json([
            'message' => '완료',
            'data' => $data,
        ], 200);
    }

}
