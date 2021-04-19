<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Common\NotificationMessage;
use Faker\Provider\ar_SA\Payment;

class PaymentMethodController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethod = PaymentMethod::all();
        return response()->json([
            'data'=>$paymentMethod
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
        $paymentMethod = new PaymentMethod();
        $checkPaymentMethodName = PaymentMethod::where('name','like',$request->name);
        if($checkPaymentMethodName)
        {
            return response()->json([
                'message' => 'Your tag name was already existed'
            ],500);
        }
        else
        {
            $paymentMethod->name = $request->name;
            if($paymentMethod->save()){
                return response()->json([
                    'data'=>$paymentMethod,
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
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $notificationMessage = new NotificationMessage();
        $paymentMethod->name = $request->name;

        if($paymentMethod->save()){
            return response()->json([
                'data'=>$paymentMethod,
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
    public function destroy(PaymentMethod $tag)
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
        $tag = PaymentMethod::where('name','like','%'.$name.'%')->get();
        return response()->json([
            'data'=>$tag,
            'message' => 'success'
        ],200);
    }
}
