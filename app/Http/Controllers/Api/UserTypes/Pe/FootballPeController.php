<?php

namespace App\Http\Controllers\Api\UserTypes\Pe;

use App\Models\FootballPe;
use App\Helpers\HelpersFunctions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FootballPeController extends Controller
{
    public function storeFootballPe(Request $request ) :JsonResponse
    {
        $user = $request->user();
        // $checkType = HelpersFunctions::checkUserType(new FootballPe , $user);
        // if ($checkType) {
        //     return $this->finalResponse('failed',400,null,null,'you already pe');
        // }

        $data = $request->validate(FootballPe::rules());
        $file = $request->file('cv');
        $path = HelpersFunctions::storeFile($file,'pe');
        $create = FootballPe::create([
            'user_id' => $user->id,
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

        $user->role = 'pe';
        $user->save();

        if($create)
        {
            return $this->finalResponse('success',200,'data created successfully');
        }

        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }


    public function updateFootballPe(Request $request) : JsonResponse
    {
        return $this->finalResponse('failed',400,null,null,'something failed in server');
    }
}
