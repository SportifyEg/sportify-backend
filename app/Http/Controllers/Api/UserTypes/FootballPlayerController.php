<?php

namespace App\Http\Controllers\Api\UserTypes;


use App\Models\FootballPlayer;
use App\Helpers\HelpersFunctions;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserType\StorePlayerRequest;


class FootballPlayerController extends Controller
{
    public function storeFootballPlayer(StorePlayerRequest $request ) :JsonResponse
    {
        $data = $request->validated();
        $file = $request->file('cv');
        $path = HelpersFunctions::storeFile($file,'player');

        $create = FootballPlayer::create([
            'user_id' => $request->user()->id,
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
        if($create)
        {
            return $this->finalResponse('success',200,'data created successfully');
        }

        return $this->finalResponse('failed',400,null,null,'something failed in server');

    }
}
