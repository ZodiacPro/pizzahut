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
        if($request->type === 'alert'){
            $cardData = app('App\Http\Controllers\CardDataController')->alerts();
            return $cardData;
        }
        return view('dashboard');
    }

    protected function changeEnv($data = array()){
        // ========================== this code to update env
        // $env_update = $this->changeEnv([
        //     'ALERT_DATE_MIN'   => 'new_db_name',
        // ]);
        // ==========================
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            
            return true;
        } else {
            return false;
        }
    }
}
