<?php

namespace App\Http\Controllers;
use DB;
use App\Models\view_demo_temp_hum;

use Illuminate\Http\Request;

class CardDataController extends Controller
{
    // Function to Get SensorData
    public function Sensor_data(){
        // Query for sensor's Data
        $data = view_demo_temp_hum::whereRaw("times IN (SELECT MAX(times) FROM view_demo_temp_hum GROUP BY sensor_id)")
                    ->orderBy('sensor_id','asc')
                    ->get();
        return $data;
    }
    public function sensor_graph($id,$date){
        // Query to select total of all channel
        $to_array_total = 0;
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $items = view_demo_temp_hum::selectRaw('avg(temperature) as temperature, avg(humidity) as humidity, day(times) as times')
                    ->whereRaw("year(times) = $year")
                    ->whereRaw("month(times) = $month")
                    ->where('sensor_id',$id)
                    ->groupByRaw('day(times)')
                    ->orderby('times', 'asc')
                    ->get();;

        $barTotal[0]=(['name' => 'Temperature', 'name1' => 'Humidity', 'values' => [], 'values1' => [], 'total' => [] ]);

        $stopper = 1;       
        foreach($items as $item){
            for($z = $stopper; $z <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $z++){
                if($z == $item->times){
                    array_push($barTotal[0]['values'], $item['temperature']);
                    array_push($barTotal[0]['values1'], $item['humidity']);
                    // function to move data to right time
                    $stopper = $z + 1;
                    $z = 100;
                    $to_array_total += $item['temperature'];
                }else{
                    array_push($barTotal[0]['values'], 0);
                    array_push($barTotal[0]['values1'], 0);
                }
                
            }
            
        }

       array_push($barTotal[0]['total'], $to_array_total);
       $data = array();
       array_push($data, $barTotal[0]);

       return $data;
    }
    public function alerts(){
        // Query for sensor's alerts

        // $min_date = $_ENV['ALERT_DATE_MIN'];
        // $max_date = $_ENV['ALERT_DATE_MAX'];
        $data = DB::table('demo_alarm')
                // ->whereRaw("times BETWEEN '$min_date' AND '$max_date' ")
                ->orderBy('times','desc')
                ->get();
        return $data;
    }
}
