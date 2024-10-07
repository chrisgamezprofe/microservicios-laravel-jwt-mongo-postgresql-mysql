<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderShippedEmail;
use App\Mail\OrderShipped;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendOrderShippedEmail(Request $request)
    {

        try{
            $order = $request->input('order');
            $from = $request->input('from');
            $to = $request->input('to');
            $subject = $request->input('subject');
            $content = $request->input('content');

            SendOrderShippedEmail::dispatch(
                $order,
                $from,
                $to,
                $subject,
                $content
            );
            return response()->json(['message' => 'Email sent successfully'], Response::HTTP_OK);
            
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
