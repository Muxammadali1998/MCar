<?php

namespace App\Http\Controllers;

use App\Events\PeopleChange;
use App\Events\PeopleEvent;
use Illuminate\Http\Request;
use App\Helpers\Traits\ApiResponcer;
use App\Models\Client;
use App\Models\Path;
use App\Models\People;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule ;

class PeopleController extends Controller
{
    use ApiResponcer;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = auth()->user()->paths->peoples; 
        if(empty($data)){
            return $this->error("Sizda mashrut mavjud emas", 400);
        }
        return $this->success($data, "yo'lovchilar jonatildi");
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

        // path areadan joy kamayish funksiyasini  update qilish kere


        $data = Validator::make($request->all(),[
            
            'path_id' => [
                'required',
                Rule::unique('People')->where(function ($query) use ($request) {
                    return $query->where('client_id', $request->client_id)
                    ->where('path_id', $request->path_id);
                }),
            ],
            'area'=>'required',
            'client_id'=>'required'
        ]);
        if($data->fails()) {
            return $this->error("",401,$data->errors());
        } 
        $path = Path::findOrFail($request->path_id);
        
        if($path->area <= 0){
            return $this->error("Bu mashinada bo'sh joy qolmagan",401);
        }
        $path->area = $path->area - $request->area;
        $path->save();

        $people = $request->all();
        $people['status'] = $path->check;  
        People::create($people);
        broadcast(new PeopleEvent($path->client_id))->toOthers();
        return $this->success('malumot kiritildi',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(People $person)
    {
        $person->client = $person->client;
        return $this->success($person ,'');       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,People $person)
    {
        $auth = auth()->id();
        if($auth !=  $person->path->client_id & $auth != $person->client_id){
            $id = auth()->guard('client')->id();
            Client::destroy($id);
            return $this->success("", "foydalanuvchi o'chrildi");
        };
        $person->status = $request->status;
        $person->save();

        broadcast(new PeopleChange($person->client_id))->toOthers();
        return $this->success('',"Buyurtma o'zgartirildi");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $person)
    {
        $auth = auth()->id();
        if($auth !=  $person->path->client_id & $auth != $person->client_id){
            $id = auth()->guard('client')->id();
            Client::destroy($id);
            return $this->success("", "foydalanuvchi o'chrildi");
        };
        $person->delete();
        return $this->success('',"Buyurtma o'chirildi");
    }
}
