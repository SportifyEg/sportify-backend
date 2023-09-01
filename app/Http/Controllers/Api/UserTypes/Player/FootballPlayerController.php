<?php

namespace App\Http\Controllers\Api\UserTypes\Player;


use Illuminate\Http\Request;
use App\Models\FootballPlayer;
use App\Helpers\HelpersFunctions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class FootballPlayerController extends Controller
{
    public function storeFootballPlayer(Request $request) :JsonResponse
    {
        // check user type on table
        $user = $request->user();
        // $checkType = HelpersFunctions::checkUserType(new FootballPlayer , $user);
        // if ($checkType) {
        //     return $this->finalResponse('failed',400,null,null,'you already player');
        // }
        // vailate data profile
        $data = $request->validate(FootballPlayer::rules());

        // store data_file in server
        $file = $request->file('cv');
        $path = HelpersFunctions::storeFile($file,'player');

        $create = FootballPlayer::create([
            'user_id' => $user->id,
            'country'=> $data['country'],
            'city'=> $data['city'],
            'age'=> $data['age'],
            'weight'=> $data['weight'],
            'height'=> $data['height'],
            'gender'=> $data['gender'],
            'skills_level'=> $data['skills_level'],
            'foot_dominant'=> $data['foot_dominant'],
            'main_position'=> $data['main_position'],
            'phone_number'=> $data['phone_number'],
            'whatsapp_number'=> $data['whatsapp_number'],
            // 'possibility_travel'=> $data['possibility_travel'],
            'cv' => $path
        ]);
        $user->role = 'player';
        $user->save();
        if($create && $path)
        {
            return $this->finalResponse('success',200,'data created successfully');
        }

        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }


    public function updateFootballPlayer(Request $request) : JsonResponse
    {
        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }

}
