<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('db_checker');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {   
        if($request->type === 'card1'){
            $cardData = app('App\Http\Controllers\CardDataController')->Sensor_data();  
            return $cardData;
        }
        if($request->type === 'graph'){
            $cardData = app('App\Http\Controllers\CardDataController')->sensor_graph($request->id,$request->date);  
            return $cardData;
        }

        return view('dashboard');
    }
}
