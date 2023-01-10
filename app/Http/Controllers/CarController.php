<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\ApiResponcer;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{

    use ApiResponcer;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $car = $request->all();
        $car['client_id'] = 1;
        
        $data = Validator::make($car, [
            'number'=>'required | unique:cars',
            'client_id'=>'required | unique:cars',
            'model'=>'required',
            'marka'=>'required',
            'type'=>'required ',
            'coller'=>'required',
            'year'=>'required',
            
        ]);
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }

        $data = Car::create($car);
        return $this->success($data, "Ma'lumot kiritildi");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        
        if( $car->client_id != auth()->guard('client')->id()){
            
            return $this->error('sizga tegishli bolmagan mashina',400);
       }

       $input =  $request->all();
       $key = array_keys($input);

       if ($key['0'] == 'number') {
            $data = Validator::make(  $request->all(), [
                'number'=>'required | unique:cars,number,'.$car->id,
            ]);
            if($data->fails()){
                return $this->error("", 400, $data->errors());
            }
        }

        $car[$key['0']] = $request->all()[$key['0']];
        $car->save();


        return $this->success($car, $key['0']." O'zgartirildi");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if( $car->client_id == auth()->guard('client')->id()){
            $car->delete();
            return $this->success("", "Ma'lumot o'chtildi");
        }
        return $this->error('Bu mashina sizga tegishi emas',400);
    }
}
