<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Common\NotificationMessage;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::all();
        return response()->json([
            'data'=>$tag
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $notificationMessage = new NotificationMessage();
        $tag = new Tag();
        $checkTagName = Tag::where('name','like',$request->name);
        if($checkTagName)
        {
            return response()->json([
                'message' => 'Your tag name was already existed'
            ],500);
        }
        else
        {
            $tag->name = $request->name;
            if($tag->save()){
                return response()->json([
                    'data'=>$tag,
                    'message' => $notificationMessage->getInsertSuccessMessage()
                ],201);
            }else{
                return response()->json([
                    'message' => $notificationMessage->getInsertFailMessage()
                ],500);
            };
        }
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $notificationMessage = new NotificationMessage();
        $tag->name = $request->name;

        if($tag->save()){
            return response()->json([
                'data'=>$tag,
                'message'=>$notificationMessage->getUpdateSuccessMessage()
            ],201);
        }else{
            return response()->json([
                'message'=>$notificationMessage->getUpdateFailMessage()
            ],500);
        };
        
    }

    /**
     * Remove the specified resource from storage.
     *Tag 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $notificationMessage = new NotificationMessage();
        if($tag->delete())
        {
            return response()->json([
                'message'   =>  $notificationMessage->getDeleteSuccessMessage()  ,
                'status_code'   =>  200
            ], 200);
        }else{
            return response()->json([
                'message'   =>  $notificationMessage->getDeleteFailMessage(),
                'status_code'   =>  500
            ], 500);   
        }
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $tag = Tag::where('name','like','%'.$name.'%')->get();
        return response()->json([
            'data'=>$tag,
            'message' => 'success'
        ],200);
    }
}
