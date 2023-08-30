<?php

namespace App\Http\Controllers\Api\UserTypes;

use App\Helpers\HelpersFunctions;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserType\StoreCoachRequest;
use App\Models\FootballCoach;

class FootballCoachController extends Controller
{
    public function storeFootballCoach(StoreCoachRequest $request ) :JsonResponse
    {
        $data = $request->validated();
        $file = $request->file('cv');
        $path = HelpersFunctions::storeFile($file,'coach');

        $create = FootballCoach::create([
            'user_id' => $request->user()->id,
            'country'=> $data['country'],
            'city'=> $data['city'],
            'age'=> $data['age'],
            'jop_title' => $data['jop_title'],
            'gender'=> $data['gender'],
            'phone_number'=> $data['phone_number'],
            'whatsapp_number'=> $data['whatsapp_number'],
            // 'possibility_travel'=> $data['possibility_travel'],
            'cv' => $path
        ]);
        if($create)
        {
            return $this->finalResponse('success',200,'data created successfully');
        }
        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }
}
