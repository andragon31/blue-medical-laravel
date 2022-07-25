<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contract;
use Carbon\Carbon;
use App\Models\vehicle;
use App\Models\daily_log;
use App\Models\mensual_log;
use PDF;

class VehicleParkingController extends Controller
{
    //obtiene los contratos disponibles
    public function getContracts(){

        $message = null;
        $status = null;

        try {
            $contracts = contract::all();

            $message = 'contratos obtenidos correctamente';
            $status = 'success';

            return response()->json([
                'data' => $contracts,
                'message'=> $message,
                'status' => $status,
            ]); 
        } catch (\Throwable $th) {

            $status = 'error';

            return response()->json([
                'data' => null,
                'message'=> $th,
                'status' => $status,
            ]); 
        }
    }

    //obtiene el vehiculo con la placa recibida
    public function getVehicle($plate){
        
        $message = null;
        $status = null;

        try {
            $vehicle = vehicle::where('plate', $plate)->first();

            $message = 'vehiculos obtenidos exitosamente';
            $status = 'success';

            return response()->json([
                'data' => $vehicle,
                'message'=> $message,
                'status' => $status,
            ]); 

        } catch (\Throwable $th) {

            $status = 'error';

            return response()->json([
                'data' => null,
                'message'=> $th,
                'status' => $status,
            ]); 
        }
    }


    public function checkInVehicle(Request $request){

        $message = null;
        $status = null;
        
        try {
            //Primero verificamos si la placa recibida ya se encuentra en nuestros registros
            $vehicle = vehicle::where('plate', $request['plate'])->first();

            if($vehicle){
                
                //verificamos si el vehiculo ya tiene un ingreso registrado
                $daily_log = daily_log::where('plate_vehicle', $request['plate'])
                ->orderBy('id', 'desc')
                ->first();

                if($daily_log->check_in && !$daily_log->check_out){
                    $message = 'Ya existe una entrada registrada';
                    $status = 'warning';
                }
                else{
                    //registramos la entrada en la tabla daily_log
                    $daily_log = daily_log::create([
                        'plate_vehicle' => $request['plate'],
                        'check_in' => Carbon::now()
                    ]);

                    $message = 'Entrada registrada correctamente';
                    $status = 'success';
                }
            }
            else{
                //creamos el registro del nuevo vehiculo con el contrato no residente por default
                $vehicle = vehicle::create([
                    'plate' => $request['plate'],
                    'id_contract' => 3
                ]);

                //registramos la entrada del nuevo vehiculo en la tabla daily_log
                $daily_log = daily_log::create([
                    'plate_vehicle' => $request['plate'],
                    'check_in' => Carbon::now()
                ]);

                $message = 'Entrada registrada correctamente';
                $status = 'success';

            }

            return response()->json([
                'message'=> $message,
                'status' => $status,
            ]); 

        } catch (\Throwable $th) {
            $status = 'error';

            return response()->json([
                'data' => null,
                'message'=> $th,
                'status' => $status,
            ]); 
        }
        

    }

    public function checkOutVehicle(Request $request){
        
        $message = null;
        $status = null;
        $total = 0;

        try {
            
            //obtenemos el ultimo registro del vehiculo en la tabla daily_log
            $daily_log = daily_log::where('plate_vehicle', $request['plate'])->orderBy('id', 'desc')->first();

            if($daily_log){

                //verificamos si ya fue registrada una salida para este vehiculo
                if(!$daily_log->check_out){
                    //obtenemos la hora de entrada
                    $check_in = new Carbon($daily_log->check_in);

                    //calculamos la duracion en minutos entre la entrada y la salida del vehiculo
                    $duration = $check_in->diffInMinutes(Carbon::now());

                    //verificamos el contrato del vehiculo
                    $vehicle = vehicle::where('plate', $request['plate'])
                    ->join('contract', 'id_contract', 'contract.id')
                    ->first();

                    //calculamos el total a pagar
                    $total = ($duration * $vehicle->price);

                    if($vehicle->id_contract == 3 || $vehicle->id_contract == 1){

                        $daily_log->update([
                            'check_out' => Carbon::now(),
                            'duration' => $duration,
                            'paid' => true,
                            'total_pay' => $total
                        ]);
                    }
                    else{

                        return "total2= ".($duration * $vehicle->price);

                        //actualizamos el check_out y la duracion de la tabla daily_log
                        $daily_log->update([
                            'check_out' => Carbon::now(),
                            'duration' => $duration,
                            'paid' => false,
                            'total_pay' => $total
                        ]);
                    }

                    $message = 'Salida registrada correctamente';
                    $status = 'success';
                }
                else{
                    $message = 'Salida ya registrada';
                    $status = 'warning';
                }
            }
            else{
                $message = 'No existe el vehiculo ingresado';
                $status = 'warning';
            }

            return response()->json([
                'message'=> $message,
                'status' => $status,
            ]); 
        } catch (\Throwable $th) {
            $status = 'error';

            return response()->json([
                'data' => null,
                'message'=> $th,
                'status' => $status,
            ]); 
        } 
    }

    //
    public function startMonth(){

        $message = null;
        $status = null;

        try {
            //verificamos si existe un registro sin finalizar en mensual_log
            $mensual_log = mensual_log::where('finish_date', null)->orderBy('id', 'desc')->first();

            if($mensual_log){

                //obtenemos los valores a sumar de la tabla daily_log
                $durations = daily_log::where('check_in', '>=', $mensual_log->start_date)
                ->where('check_out', '<=', Carbon::now())
                ->sum('duration');

                $total_pay = daily_log::where('check_in', '>=', $mensual_log->start_date)
                ->where('check_out', '<=', Carbon::now())
                ->sum('total_pay');
                
                //actualizamos los datos de la tabla mensual_log
                $mensual_log->update([
                    'finish_date' => Carbon::now(),
                    'total_min' => $durations,
                    'total_pay' => $total_pay
                ]);

                //se crea el nuevo registro para el siguiente mes
                $mensual_log = mensual_log::create([
                    'start_date' => Carbon::now()
                ]);

                $daily_log = daily_log::where('check_in', '>=', $mensual_log->start_date)
                ->where('check_out', '<=', Carbon::now())
                ->where('paid', 0)
                ->update(['paid' => 1]);
            }
            else{
                
                //crea el registro del nuevo mes en la tabla mensual_log
                $mensual_log = mensual_log::create([
                    'start_date' => Carbon::now()
                ]);
            }

            $message = 'Se ha creado el registro del mes';
            $status = 'success';

            return response()->json([
                'message'=> $message,
                'status' => $status,
            ]); 

        } catch (\Throwable $th) {
            $status = 'error';

            return response()->json([
                'message'=> $th,
                'status' => $status,
            ]); 
        }
    }

    public function updateContractVehicule(Request $request){

        $message = null;
        $status = null;

        try {

            $vehicle = vehicle::where('plate', $request['plate'])->update([
                'id_contract' => $request['id_contract']
            ]);

            if($vehicle){
                $message = 'vehiculo actualizado correctamente';
                $status = 'success';
                
            }else{
                $message = 'el vehiculo no existe';
                $status = 'warning';
            }

            return response()->json([
                'message'=> $message,
                'status' => $status,
            ]); 

        } catch (\Throwable $th) {
            $status = 'error';

            return response()->json([
                'message'=> $th,
                'status' => $status,
            ]); 
        }
    }

    public function generatePDFResident($name){

        try {

            //obtenemos el ultimo registro de cierre de mes
            $mensual_log = mensual_log::where('start_date', '!=', null)
            ->where('finish_date', '!=', null)
            ->orderBy('id', 'desc')->first();

            //obtenemos todos los registros de residentes en las fechas del ultimo cierre de mes
            $daily_log = daily_log::selectRaw('plate_vehicle, SUM(duration) as duration, SUM(total_pay) as total_pay')
            ->where('check_in', '>=', $mensual_log->start_date)
            ->where('check_out', '<=', $mensual_log->finish_date)
            ->where('vehicle.id_contract', 2)
            ->where('paid', 1)
            ->join('vehicle', 'plate_vehicle', 'vehicle.plate')
            ->groupBy('plate_vehicle')
            ->get();

            $data = [
                'data' => $daily_log,
                'start_date' => $mensual_log->start_date,
                'finish_date' => $mensual_log->finish_date,
                'date' => Carbon::now()
            ]; 

            $pdf = PDF::loadView('residents', $data);

            return $pdf->download($name.'.pdf');

        } catch (\Throwable $th) {

            $status = 'error';

            return response()->json([
                'message'=> $th,
                'status' => $status,
            ]); 
        }
    }
}
