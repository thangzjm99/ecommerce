<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Common\NotificationMessage;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $notificationMessage = new NotificationMessage();
        $requestEmail = $request->email;
        $requestPassword = bcrypt($request->password);
        $checkEmail = User::where('email', 'like', $requestEmail)->exists();
        $checkPassword = User::where('password', 'like', $requestPassword)->exists();
        if ($checkEmail && $checkPassword) {
            $userData = User::where('email', 'like', $requestEmail);
            return response()->json([
                'data' => $userData,
                'message' => $notificationMessage->getLoginSuccessMessage()
            ]);
        } else {
            return response()->json([
                'message' => $notificationMessage->getLoginFailMessage()
            ]);
        }
    }

    public function register(Request $request)
    {
        $notificationMessage = new NotificationMessage();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $checkUserEmail = User::where('email','like',$request->email)->exists();
        if($checkUserEmail)
        {
            return response()->json([
                'message'=>'User email has already existed'
            ]);
        }
        if($user->save())
        {
            return response()->json([
                'data'=>$user,
                'message' => $notificationMessage->getInsertSuccessMessage()
            ],201);
        }else{
            return response()->json([
                'message' => $notificationMessage->getInsertFailMessage()
            ],500);
        };
        
    }
}
