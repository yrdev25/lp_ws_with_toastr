<?php

namespace App\Http\Controllers;

use App\Events\ForWebsocket;
use Illuminate\Http\Request;
use App\Models\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(asset('app'));
        // $data = 'event called';
        // event(new ForWebsocket($data));
         
        //broadcast(new ForWebsocket());
        return view('home');
    }

    public function event(){
        // $data = [ "data" => "dqatg"];
        event(new ForWebsocket());
        return "success";

    }

    public function notification(Request $request){
       // dd('here');
      $notify =  Notification::create([
        'message' => $request->message,
       ]);

       return response()->json($notify);
    }
}
