<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\ApiResponcer;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
   
    use ApiResponcer;

    public function login(Request $request)
    {
        $data=Validator::make($request->all(), [
            'phone'=>'required', 
            'password'=>'required',
        ]);
        
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }
     
        if(auth()->guard('api')->attempt(['phone'=>$request->phone, 'password'=>$request->password])){
                $token=auth()->guard('api')->user()->createToken('Laravel')->accessToken;
                return $this->success($token, "", 201);  
        }else{
            return $this->error("", 400, 'parol xato');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = Validator::make($request->all(), [
            'phone'=>'required | unique:clients',
            'name'=>'required',
            'age'=>'required',
            'password'=>'required | confirmed',
            'password_confirmation'=>'required',
            'code'=>'required',
        ]);

        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }
        

        if( 1234 != $request->code){
            return $this->error("Paro'l xato", 400);
        }


        $client = $request->all();
        $client['password'] = Hash::make($request->password);        
        $client['photo'] = 5;        
        $user = Client::create($client);    
        $token=$user->createToken('Laravel')->accessToken;
        return $this->success($token, "", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $client = Client::with('car')->find($id);
        return $this->success($client);
    }

    public function client()
    {
        $id = auth()->guard('client')->id();
        $client = Client::with('car')->find($id);
        return $this->success($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( $id != auth()->guard('client')->id()){
            
             return $this->error('sizga tegishli bolmagan hisob',400);
        }
        $client = Client::find($id);

        $input =  $request->all();
        $key = array_keys($input);
        $info = $request->all()[$key['0']];

        if ($key['0'] == 'phone') {
            $data = Validator::make($request->all(), [
                'phone'=>'required | unique:clients,phone,'.$client->id,
            ]);
            
            if($data->fails()){
                return $this->error( "", 400, $data->errors());
            }

           
        }elseif($key['0'] == 'password'){
    
            $info = Hash::make($request->password);
    
        }

        $client[$key['0']] = $info;
        $client->save();
        
        return $this->success($client, $key['0']." o'zgartirildi", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = auth()->guard('client')->id();
        Client::destroy($id);
        return $this->success("", "foydalanuvchi o'chrildi");
       
    }

    public function logout(){

        auth()->guard('client')->user()->token()->revoke();
        return $this->success(['message' => 'Successfully logged out'], 200);
    
    }
}
