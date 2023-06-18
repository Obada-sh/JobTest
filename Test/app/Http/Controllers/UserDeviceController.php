<?php

namespace App\Http\Controllers;

use App\Models\DeviceUserPivot;
use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    public function register_devices_by_user($user_id,$devices_id)
    {
        foreach($devices_id as $device_id )
        {
            DeviceUserPivot::create([
                'user_id' => $user_id,
                'device_id' => $device_id
            ]);
        }

        return response()->json(
            [
                'message' => "registered successfully",
                'status' => true,
            ]
        ,201 );

    }


    public function  get_device_users($device_id)
    {
        
    }

}
