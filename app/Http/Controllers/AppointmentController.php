<?php

namespace App\Http\Controllers;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    //
    public function index()
    {
        $appointments = Appointment::query()
            ->select('id', 'name', 'email', 'phone')
            ->get();
        if (sizeof($appointments) >= 1) {
            return response()->json($appointments, 200);
        } else {
            return response()->json(["message" => 'please add appointments', "data" => $appointments, "status" => 200]);
        }
    }

    public function store(Request $request){
        $appointment = new Appointment();
        $appointment->name = $request->input('name');
        $appointment->email = $request->input('email');
        $appointment->phone = $request->input('phone');
        $appointment->save();
        return response()->json(["message" => 'Appointment added successfully', "data" => $appointment, "status" => 200]);
    }

    public function update(Request $request,$id){
        $appointment = Appointment::find($id);
        if($appointment){
            $appointment->name = $request->input('name') ?? $appointment->name;
            $appointment->email = $request->input('email') ?? $appointment->email;
            $appointment->phone = $request->input('phone') ?? $appointment->phone;
            $appointment->save();
        }else{
            $appointment = new Appointment();
            $appointment->name = $request->input('name');
            $appointment->email = $request->input('email');
            $appointment->phone = $request->input('phone');
            $appointment->save();
        }
        return response()->json(["message" => 'Appointment updated successfully', "data" => $appointment, "status" => 200]);
    }

    public function show($id){
        $appointment = Appointment::query()
            ->select('id', 'name', 'email', 'phone')
            ->where('id',$id)
            ->first();
        if ($appointment) {
            return response()->json($appointment, 200);
        } else {
            return response()->json(["message" => 'N0_DATA', "data" => $appointment, "status" => 400]);
        }
    }

        public function delete($id){
            Appointment::query()->where('id','=',$id)->update(['deleted_at'=>Carbon::now()]);
            return response()->json(["message" => 'Deleted Successfully', "status" => 200]);
        }
    }
