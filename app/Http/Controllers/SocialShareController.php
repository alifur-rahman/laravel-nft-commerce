<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class SocialShareController extends Controller
{
    public function ShareWidget(Request $request)
    { 
   
        $shareComponent = \Share::page(url('/').'/'.'asset-details/'.$request->id
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit()->getRawLinks();
        
        return Response::json([
            'status' => true,
            'message' => $shareComponent
        ]); 
    }
}
