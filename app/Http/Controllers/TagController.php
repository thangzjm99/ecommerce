<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;

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
        $tag = new Tag();
        $tag->name = $request->name;
        
        if($tag->save()){
            return response()->json([
                'data'=>$tag
            ],201);
        }else{
            return response()->json([
                'message'=>'error'
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
        $tag->name = $request->name;

        if($tag->save()){
            return response()->json([
                'data'=>$tag
            ],201);
        }else{
            return response()->json([
                'message'=>'error'
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
        //
        if($tag->delete())
        {
            return response()->json([
                'message'   =>  'Category deleted successfully !',
                'status_code'   =>  200
            ], 200);
        }else{
            return response()->json([
                'message'   =>  'Error!',
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
