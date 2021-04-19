<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use App\Common\NotificationMessage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('images');

        return response()->json([
            'data' => $product,
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
        $product = new Product();
        $image1 = new Image();
        $image2 = new Image();
        $checkProductName = Product::where('name', 'like', $request->name)->exists();
        if ($checkProductName) {
            return response()->json([
                'message' => 'Your product name was already existed'
            ], 500);
        } else {
            $product->code = $request->code;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->inventory_quantity = $request->inventory_quantity;
            $product->description = $request->description;
            $product->note = $request->note;
            $product->category_id = $request->category_id;
            $product->is_active = $request->is_active;
            $path1 = $request->file('image1')->store('product_image');
            $path2 = $request->file('image2')->store('product_image');

            if ($product->save()) {
                $image1->image_name = $path1;
                $image1->product_id = $product->id;
                $image1->save();
                $image2->image_name = $path2;
                $image2->product_id = $product->id;
                $image2->save();
                return response()->json([
                    'data' => $product,
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
    public function update(Request $request, Product $product)
    {
        $notificationMessage = new NotificationMessage();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->inventory_quantity = $request->inventory_quantity;
        $product->description = $request->description;
        $product->note = $request->note;
        $product->category_id = $request->category_id;
        $product->is_active = $request->is_active;
        if ($product->save()) {
            return response()->json([
                'data' => $product,
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
    public function destroy(Product $product)
    {
        $notificationMessage = new NotificationMessage();
        if ($product->delete()) {
            return response()->json([
                'data' => $product,
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
        $tag = Product::where('name', 'like', '%' . $name . '%')->get();
        return response()->json([
            'data' => $tag,
            'message' => 'success'
        ], 200);
    }

    public function getProductWithImage()
    {
        $product = Product::all();
        $image = Image::all();
        return response()->json([
            'data' => [
                'product' => $product,
                'image' => $image
            ]

        ]);
    }
}
