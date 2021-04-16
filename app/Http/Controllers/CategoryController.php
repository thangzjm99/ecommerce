<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Common\NotificationMessage;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'data' => $category,
        ], 200);
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
        $notificationMessage = new NotificationMessage();
        $category = new Category;
        $checkCategoryName = Category::where('name', 'like', $request->name);
        if ($checkCategoryName) {
            return response()->json([
                'message' => 'Your category name was already existed'
            ], 500);
        } else {
            $category->name = $request->name;

            if ($category->save()) {
                return response()->json([
                    'data' => $category,
                    'message' => $notificationMessage->getInsertSuccessMessage()
                ], 201);
            } else {
                return response()->json([
                    'message' => $notificationMessage->getInsertFailMessage()
                ], 500);
            };
        }


        //

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
    public function update(Request $request, Category $category)
    {
        $notificationMessage = new NotificationMessage();
        $category->name = $request->name;

        if ($category->save()) {
            return response()->json([
                'data' => $category,
                'message' => $notificationMessage->getUpdateSuccessMessage()
            ], 201);
        } else {
            return response()->json([
                'message' => $notificationMessage->getUpdateFailMessage()
            ], 500);
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $notificationMessage = new NotificationMessage();
        if ($category->delete()) {
            return response()->json([
                'data' => $category,
                'message' => $notificationMessage->getDeleteSuccessMessage()
            ], 201);
        } else {
            return response()->json([
                'message' => $notificationMessage->getDeleteFailMessage()
            ], 500);
        }

        //
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $tag = Category::where('name', 'like', '%' . $name . '%')->get();
        return response()->json([
            'data' => $tag,
            'message' => 'success'
        ], 200);
    }
}
