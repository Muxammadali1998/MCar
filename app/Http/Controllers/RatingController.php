<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function reting(Request $request){


        $data=Validator::make($request->all(), [
            'reting' => ' required ',
            
        ]);
        

        if($data->fails()){
            return $this->error(null, 400, $data->errors());
        }

        $author = auth()->guard('api')->id();
        // $reting = Rating::where('author', $author)->get();
        // if($request->post_id){

        //     $check=$reting->where('post_id', $request->post_id)->first();
        // }else{

        //     $check=$reting->where('reltor_id', $request->reltor_id)->first();
        // }
        $data = $request->all();
        $data['from']=$author;
        // if (!empty($check)) {
        //     if($request->reting){
        //         $check->update($data);
        //         return $this->success(null,"reting o'zgartirildi",200);
        //     }else{
        //         $check->delete();
        //         return $this->success(null,"reting o'chirildi",200);
        //     }
        // }else{
            Rating::create($data);
            return $this->success(null,"reting kiritildi",200);
        }
    
}
