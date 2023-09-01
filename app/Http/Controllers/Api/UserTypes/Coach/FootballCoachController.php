<?php

namespace App\Http\Controllers\Api\UserTypes\Coach;

use App\Helpers\HelpersFunctions;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\FootballCoach;

class FootballCoachController extends Controller
{
    public function storeFootballCoach(Request $request ) :JsonResponse
    {
        // check user type on table
        $user = $request->user();
        // $checkType = HelpersFunctions::checkUserType(new FootballCoach , $user);
        // if ($checkType) {
        //     return $this->finalResponse('failed',400,null,null,'you already Coach');
        // }
        // vailate data profile
        $data = $request->validate(FootballCoach::rules());

        // store data_file in server
        $file = $request->file('cv');
        $path = HelpersFunctions::storeFile($file,'coach');

        $create = FootballCoach::create([
            'user_id' => $user->id,
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
        $user->role = 'coach';
        $user->save();
        if($create)
        {
            return $this->finalResponse('success',200,'data created successfully');
        }
        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }

    public function updateFootballCoach(Request $request) : JsonResponse
    {
        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }
}
