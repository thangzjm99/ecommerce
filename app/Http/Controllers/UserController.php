<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Common\NotificationMessage;
use Mockery\Matcher\Not;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'data'=>$user,
            
        ]);

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        //
        $notificationMessage = new NotificationMessage();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        
        if($user->save())
        {
            return response()->json([
                'data'=>$user,
                'message' => $notificationMessage->getUpdateSuccessMessage()
            ],201);
        }else{
            return response()->json([
                'message' => $notificationMessage->getUpdateFailMessage()
            ],500);
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $notificationMessage=new NotificationMessage();
        if($user->delete())
        {
            return response()->json([
                'message'=>$notificationMessage->getDeleteSuccessMessage()
            ]);
        }
        //

    }
}
