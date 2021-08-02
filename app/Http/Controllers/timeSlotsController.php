<?php

namespace App\Http\Controllers;

use App\Models\TimeSlots;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class timeSlotsController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            $user = session('person');
           try{
               //getting time slots list of connected user(guest)
               //$timeSlots = $user->guest->timeSlots;
               if (session()->has('admin')) {
                   $timeSlots = TimeSlots::all();
                   $view ='admin.timeSlots';
               }elseif(session()->has('guest')) {
                   $timeSlots = TimeSlots::where('idPerson' , '=', $user->guest->idPerson)->get();
                   $view ='guest.timeSlots';

               }


               return view($view, ["timeSlots"=>$timeSlots]);
           }catch(Exception $e){
               return view('auth.login')->with('error', "erorrrr");
           }
        }else{
            return view('auth.login');
        }

    }

    public function timeSlot($idTimeSlot){
        if (Auth::check()) {
            try{
                $timeSlot = TimeSlots::find($idTimeSlot);
                return view('guest.timeSlot', ["timeSlot"=>$timeSlot]);

            }catch(Exception $e){
                return view('auth.login')->with('error', "erorrrr");
            }
        }else{
            return view('auth.login');
        }
    }


//creating and showing Form HTML (view)
    public function create($idTimeSlot = null){

        if (Auth::check()) {
            try{
                //$timeSlot = new TimeSlots();//TimeSlots::find(1);
                //return view('guest.createTimeSlot', ["timeSlot"=>$timeSlot]);
                return view('guest.createTimeSlot');

            }catch(Exception $e){
                return view('auth.login')->with('error', "erorrrr");
            }
        }else{
            return view('auth.login');
        }
    }


//creating
    public function store(Request $request){

        if (Auth::check()) {
            try{

                //preparing for  validating data $request
                $data = [
                    'startDateTimeSlot'=>['required','string'],
                    'reasonTimeSlot'=>['required','string']
                ];

                if(isset($request->idTimeSlot) && $request->idTimeSlot > 0){
                    $data["idTimeSlot"]= ['required','integer'];
                }
                //action
                $request->validate($data);


                //dealing with start time

//                $datetime = strtotime($request->startDateTimeSlot);
////                $date = date('m/d/Y', $datetime);
////                $hour =  date('H', $datetime);

                $timeslot= DB::table('TimeSlots')->whereRaw("DATE(startDateTimeSlot)=DATE('$request->startDateTimeSlot')")->whereRaw("HOUR(startDateTimeSlot)=HOUR('{$request->startDateTimeSlot}')")->get();

                if(sizeof($timeslot)>0){
                    //throw error can't reserve because there is an existing reservation with the same time
                    //quit
                    return redirect()->back()->withErrors(["error can\'t make reservation because there is an existing reservation with the same time {$request->startDateTimeSlot}"]);
                    //return "error can't make reservation because there is an existing reservation with the same time";
                }
                $timeslot = new TimeSlots();
                $timeslot->startDateTimeSlot = $request->startDateTimeSlot;
                $timeslot->reasonTimeSlot = $request->reasonTimeSlot;
                $timeslot->idPerson = Auth::id();//id of connected Guest
                // id status by default is configured to be 1 in MYSQL DB

                $timeslot->save();

                return redirect()->route('Guest-TimeSlots');


            }catch(Exception $e){
                return view('auth.login')->with('error', "erorrrr");
            }
        }else{
            return view('auth.login');
        }
    }


    //viewing modification form
    //creating and showing Form HTML (view)
    public function modify($idTimeSlot = null){

        if (Auth::check()) {
            try{
                $timeSlot = TimeSlots::find($idTimeSlot);
                return view('admin.modifyTimeSlot', ["timeSlot"=>$timeSlot]);


            }catch(Exception $e){
                return view('auth.login')->with('error', "erorrrr");
            }
        }else{
            return view('auth.login');
        }
    }

    //saving modifications
    public function update(Request $request){

        if (Auth::check()) {

            try{
//                if(!isset($request->idTimeSlot)){
//                    throw new Exception('Time Slot not identified.');
//                }
//
                //preparing for  validating data $request
                $data = [
                    'idTimeSlot'=>['required', 'integer'],
                    'startDateTimeSlot'=>['required','string'],
                    'reasonTimeSlot'=>['required','string']
                ];


                //action
                $request->validate($data);


                //dealing with start time

//                $datetime = strtotime($request->startDateTimeSlot);
////                $date = date('m/d/Y', $datetime);
////                $hour =  date('H', $datetime);

                $timeslot= DB::table('TimeSlots')->whereRaw("DATE(startDateTimeSlot)=DATE('$request->startDateTimeSlot')")->whereRaw("HOUR(startDateTimeSlot)=HOUR('{$request->startDateTimeSlot}')")->get();

                if(sizeof($timeslot)>0){
                    //throw error can't reserve because there is an existing reservation with the same time
                    //quit
                    return redirect()->back()->withErrors(["error can\'t make reservation because there is an existing reservation with the same time {$request->startDateTimeSlot}"]);
                    //return "error can't save reservation because there is an other one with the same time";
                }
                $timeslot = TimeSlots::find($request->idTimeSlot);
                $timeSlot_Archive = $timeslot;
                $timeslot->startDateTimeSlot = $request->startDateTimeSlot;
                //admin doesn't have the right to modify the reason of the reservation
                //$timeslot->reasonTimeSlot = $request->reasonTimeSlot;
                $timeslot->idStatus = 2;
                $timeslot->save();


                //Archiving modified time slot
                DB::table('HistoryTimeSlots')
                    ->insert([
                        'idTimeSlot'=> $timeSlot_Archive->idTimeSlot,
                    'startDateTimeSlot' => $timeSlot_Archive->startDateTimeSlot
                ]);


                return redirect()->route('admin.timeSlots');


            }catch(Exception $e){
                return view('auth.login')->with('error', "erorrrr");
            }
        }else{
            return view('auth.login');
        }
    }


    public function delete($idTimeSlot){

        $timeSlot = TimeSlots::where('idPerson', '=', Auth::id())->where('idTimeSlot','=',$idTimeSlot)->Delete();

        return redirect()->route('Guest-TimeSlots');
    }


    public function changeSlotTimeStatus($idTimeSlot){
        if($idTimeSlot){
            $timeSlot = TimeSlots::find($idTimeSlot);
            if($timeSlot){
                $timeSlot->idStatus=($timeSlot->idStatus!=2) ? 2 : 1;// confirmed // Default
            }
            $timeSlot->save();

            return redirect()->route('Guest-TimeSlots');
        }
    }
}
