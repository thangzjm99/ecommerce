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
}
