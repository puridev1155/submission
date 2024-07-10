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
        Log::info('check');
        $validated['vol'] = $request->vol;
        $validated['device'] =  $request->userAgent();
        $validated['wip'] = $request->ip();
        //$validated = $request->validated();
        
        if($request->award == '스타벅스') {
            //Param: vol, award, name, phone, email
            $validated['award'] = $request->award;
            $validated['email'] = $request->email;
            $validated['phone'] = $request->phone;
            
            //check the email
            $email = Prize::where('email', $request->email)->first();
            //check the phone
            $phone = Prize::where('phone', $request->phone)->first();

            if(!$email && !$phone) {
                $validated['count'] = 1;
                $data = Prize::create($validated);

                return response()->json([
                    'status' => 'success',
                    'message' => '완료',
                    'data' => $data,
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => '이미 내역 존재함',
            ], 200);

        } else {
            $validated['award'] = "꽝";
        }

        $data = Prize::create($validated);
        return response()->json([
            'message' => '완료',
            'data' => $data,
        ], 200);
    }

}
