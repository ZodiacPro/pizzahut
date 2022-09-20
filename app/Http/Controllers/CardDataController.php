<?php

namespace App\Http\Controllers;
use DB;
use App\Models\view_demo_temp_hum;
use App\Exports\HistoryExport;
use Maatwebsite\Excel\Facades\Excel;
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
    public function sensor_graph($id,$date,$trig){
        // Query to select total of all channel
        $to_array_total = 0;
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        if($trig == "month"){
            $items = view_demo_temp_hum::selectRaw('avg(temperature) as temperature, avg(humidity) as humidity, day(times) as times')
                        ->whereRaw("year(times) = $year")
                        ->whereRaw("month(times) = $month")
                        ->where('sensor_id',$id)
                        ->groupByRaw('day(times)')
                        ->orderby('times', 'asc')
                        ->get();

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
        }else{
            $items = view_demo_temp_hum::selectRaw('avg(temperature) as temperature, avg(humidity) as humidity, hour(times) as times')
                        ->whereRaw("date(times) = '$date'")
                        ->where('sensor_id',$id)
                        ->groupByRaw('hour(times)')
                        ->orderby('times', 'asc')
                        ->get();;

            $barTotal[0]=(['name' => 'Temperature', 'name1' => 'Humidity', 'values' => [], 'values1' => [], 'total' => [] ]);

            $stopper = 0;       
            foreach($items as $item){
                for($z = $stopper; $z <= 23; $z++){
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
        }
        

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
    public function alerts_filtered($min_date,$max_date){
        // Query for sensor's alerts

        // $min_date = $_ENV['ALERT_DATE_MIN'];
        // $max_date = $_ENV['ALERT_DATE_MAX'];
        $data = DB::table('demo_alarm_history')
                ->whereRaw("date(times) BETWEEN '$min_date' AND '$max_date' ")
                ->orderBy('times','desc')
                ->get();
        return $data;
    }
    public function history($sensor_id,$min_date,$max_date){
        $data = view_demo_temp_hum::selectRaw('times,avg(temperature) as temperature,max_t,min_t,avg(humidity) as humidity,max_h,min_h ')
                        ->whereRaw("date(times) BETWEEN '$min_date' AND '$max_date' ")
                        ->where('sensor_id',$sensor_id)
                        ->groupByRaw("year(times), MONTH(times), DAY(times),DATE_format(times, '%H')")
                        ->orderby('times', 'asc')
                        ->get();
        return $data;
    }
    public function history_download($sensor_id,$min_date,$max_date){
        return Excel::download(new HistoryExport($sensor_id,$min_date,$max_date), $sensor_id.'.csv');
    }
    public function threshold(){
        // Query for sensor's threshold Data
        $data = DB::table('demo_sensor')
                    ->orderBy('sensor_id','asc')
                    ->get();
        return $data;
    }
}
