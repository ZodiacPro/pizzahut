<?php

namespace App\Exports;

use App\Models\view_demo_temp_hum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($sensor_id,$min_date,$max_date)
    {
        $this->sensor_id = $sensor_id;
        $this->min_date = $min_date;
        $this->max_date = $max_date;
    }
    public function collection()
    {
        return view_demo_temp_hum::selectRaw('times,avg(temperature) as temperature,max_t,min_t,avg(humidity) as humidity,max_h,min_h ')
                                    ->whereRaw("date(times) BETWEEN '$this->min_date' AND '$this->max_date' ")
                                    ->where('sensor_id',$this->sensor_id)
                                    ->groupByRaw("year(times), MONTH(times), DAY(times),DATE_format(times, '%H')")
                                    ->orderby('times', 'asc')
                                    ->get();
    }
    public function headings(): array

    {

        return [
            "時間",
            '溫度',
            '溫度上限',
            '溫度下限',
            '濕度',
            '濕度上限',
            '濕度下限',
        ];

    }
}
