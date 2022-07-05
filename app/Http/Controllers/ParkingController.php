<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DataTables;

class ParkingController extends Controller
{
    public function saveParking(Request $request)
    {
        $checking = ParkingLog::where('license_num', $request->license_num)->where("time_out", null)->first();

        if ($checking == null) {
            $save = new ParkingLog;
            $save->license_num = $request->license_num;
            $save->time_in = date('Y-m-d H:i:s');
            $save->save();
            return "entry";
        } else {
            $data = ParkingLog::where('license_num', $request->license_num)->where("time_out", null)->first();
            $d1 = new DateTime($data->time_in);
            $d2 = new DateTime(date('Y-m-d H:i:s'));
            $interval = $d1->diff($d2);
            $save["time_out"] = date('Y-m-d H:i:s');
            if ($interval->d >= 1) {
                $d3 = new DateTime(date('Y-m-d 00:00:00'));
                $interval2 = $d1->diff($d3);
                $save["price"] = ($interval2->h * 3000) + ($interval->d * 72000);
                $save["minute"] = $interval->i;
                $save["hour"] = $interval->h;
                $save["day"] = $interval->d;
            } else {
                $save["price"] = ($interval->h * 3000);
                $save["minute"] = $interval->i;
                $save["hour"] = $interval->h;
                $save["day"] = $interval->d;
            }

            ParkingLog::where('id', $data->id)->update($save);
            $dataSuccess = ParkingLog::where('id', $data->id)->first();

            return $dataSuccess;
        }
    }

    public function getDatalog(){
        $records = ParkingLog::all();


        return Datatables::of($records)
    
                ->editColumn('license_num', function($record) {

                    return $record->license_num;
                })
                ->editColumn('time_in', function($record) {

                    return $record->time_in;
                })
                ->editColumn('time_out', function($record) {

                    if($record->time_out ==  null){
                        return "Not Exit";
                    }else{
                        return $record->time_out;
                    }
                })
                ->editColumn('price', function($record) {
                    if($record->time_out ==  null){
    return "";
}else{
    return "Rp. $record->price";
}
                  
                })

                ->editColumn('duration', function($record) {
                    if($record->time_out ==  null){
    return "";
}else{
    return "$record->day Day $record->hour Hour $record->minute Minute";
}
                  
                })
               
               
              
                ->rawColumns(['id'])

            ->make(true);
    }
}
