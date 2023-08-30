<?php

namespace App\Http\Controllers\Api\UserTypes;

use App\Models\FootballPe;
use App\Helpers\HelpersFunctions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserType\StorePeRequest;

class FootballPeController extends Controller
{
    public function storeFootballPe(StorePeRequest $request ) :JsonResponse
    {
        $data = $request->validated();
        $file = $request->file('cv');
        $path = HelpersFunctions::storeFile($file,'pe');

        $create = FootballPe::create([
            'user_id' => $request->user()->id,
            'country'=> $data['country'],
            'city'=> $data['city'],
            'age'=> $data['age'],
            'university'=> $data['university'],
            'college' => $data['college'],
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
