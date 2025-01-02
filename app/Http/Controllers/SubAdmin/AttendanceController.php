<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserAttandance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function index(){

        $userId = Auth::id();

        $user = User::where('id',$userId)->first();


        $todayDate = Carbon::now()->toDateString();

        $startData = UserAttandance::where('user_id', $userId)
        ->where('status', 'Start')
        ->whereDate('created_at', $todayDate)
        ->first();

        $endData = UserAttandance::where('user_id', $userId)
        ->where('status', 'End for today')
        ->whereDate('created_at', $todayDate)
        ->first();

        $Break = UserAttandance::where('user_id', $userId)
        ->whereDate('created_at', $todayDate)
        ->orderBy('id','desc')
        ->first();

        // dd($Break);


        // last seven day employee activity

        $todayDate = Carbon::now();
        $sevenDaysAgo = $todayDate->subDays(7);

        $sevenDayActivity = UserAttandance::where('user_id', $userId)
            ->whereDate('created_at', '>=', $sevenDaysAgo)
            ->orderBy('created_at')
            ->get();

        $data = [];

        foreach ($sevenDayActivity as $activity) {
            if ($activity->status == 'Start') {
                $data[] = [
                    'startTime' => $activity->created_at,
                    'endTime' => null,
                    'totalBreakTime' => 0,
                ];
            } elseif ($activity->status == 'End for today') {
                if (!empty($data)) {
                    $data[count($data) - 1]['endTime'] = $activity->created_at;
                }
            } elseif ($activity->status == 'Break') {
                if (!empty($data)) {
                    $data[count($data) - 1]['breakStartTime'] = $activity->created_at;
                }
            } elseif ($activity->status == 'Break end') {
                if (!empty($data) && isset($data[count($data) - 1]['breakStartTime'])) {
                    $breakEndTime = $activity->created_at;
                    $breakStartTime = $data[count($data) - 1]['breakStartTime'];
                    $breakTime = $breakEndTime->diffInMinutes($breakStartTime);
                    $data[count($data) - 1]['totalBreakTime'] += $breakTime;
                    unset($data[count($data) - 1]['breakStartTime']);

                }
            }
        }




        return view('admin.subAdmin.userAttendance.index',compact('startData','endData','Break','data','user'));

    }


    public function loadData(Request $request){

        $latitude = $request->lat;
        $longitude = $request->lng;
        $buttonvalue = $request->query('buttonvalue');


        $ip = $request->ip();

        $userId = Auth::id();

        $todayDate = Carbon::now()->toDateString();

        // dd($buttonvalue);

        if( $buttonvalue == 'Start' ){
            $startData = UserAttandance::where('user_id', $userId)
            ->where('status', $buttonvalue)
            ->whereDate('created_at', $todayDate)
            ->first();

            if($startData == Null){
                UserAttandance::insert([
                    'latlng'=>$latitude.','.$longitude,
                    'user_id'=>$userId,
                    'ip_address'=>$ip,
                    'status'=>$buttonvalue,
                    'created_at'=>now()
                ]);

                return response()->json(['message'=>'Start']);
            }else{
                return response()->json(['message'=>'Start']);
            }
        }else if( $buttonvalue == 'End for today' ){
            $EndDate = UserAttandance::where('user_id', $userId)
            ->where('status', $buttonvalue)
            ->whereDate('created_at', $todayDate)
            ->first();

            if($EndDate == Null){
                UserAttandance::insert([
                    'latlng'=>$latitude.','.$longitude,
                    'user_id'=>$userId,
                    'ip_address'=>$ip,
                    'status'=>$buttonvalue,
                    'created_at'=>now()
                ]);

                return response()->json(['message'=>'End for today']);
            }else{
                return response()->json(['message'=>'End for today']);
            }
        }else if( $buttonvalue == 'Break' ){
            $Checkend = UserAttandance::where('user_id', $userId)
            ->where('status', 'End for today')
            ->whereDate('created_at', $todayDate)
            ->first();

            // dd($Checkend);

            if($Checkend == null){
                UserAttandance::insert([
                    'latlng'=>$latitude.','.$longitude,
                    'user_id'=>$userId,
                    'ip_address'=>$ip,
                    'status'=>$buttonvalue,
                    'created_at'=>now()
                ]);

                return response()->json(['message'=>'Break']);

            }else{
                return response()->json(['message'=>'Today job done']);
            }
        }
        else if( $buttonvalue == 'Break end' ){
            $Checkend = UserAttandance::where('user_id', $userId)
            ->where('status', 'End for today')
            ->whereDate('created_at', $todayDate)
            ->first();

            if($Checkend == null){

                UserAttandance::insert([
                    'latlng'=>$latitude.','.$longitude,
                    'user_id'=>$userId,
                    'ip_address'=>$ip,
                    'status'=>$buttonvalue,
                    'created_at'=>now()
                ]);

                return response()->json(['message'=>'Break end']);

            }else{
                return response()->json(['message'=>'Today job done']);
            }
        }

    }

}
