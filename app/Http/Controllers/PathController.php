<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\ApiResponcer;
use App\Http\Resources\FilterResource;
use App\Models\Location;
use App\Models\Path;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PathController extends Controller
{
    use ApiResponcer;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $date = date('Y-m-d H:i', time());
        $stale_posts = Location::where('time', '=', Carbon::now()->subDays(7))->get();

        foreach ($stale_posts as $post) {
            $post->delete();
        }
        echo $date;
     Path::where('finish_time', $date)->delete();
    }
    public function filter(Request $request)
    {
        $paths = Path::whereHas('locations', function($q )use($request)
        {
            
            $q->where('latitude' , $request->from);

        })->whereHas('locations', function($q )use($request)
        {
            
            $q->where( 'latitude', $request->to);

        })->get(); 

        foreach($paths as $path){
            
            $from_order = $path->locations->where('latitude', $request->from)->first()->order;
            $to_order = $path->locations->where('latitude', $request->to)->first()->order;
            
            if($from_order < $to_order){
                $pa[]=$path;
            }                 
        }
        if(empty($pa)){
            return $this->error("ma'lumot topilmadi", 404);
        }
        return $this->success( FilterResource::collection($pa) );
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
        $data = Validator::make($request->all(),[
           
            'locations'=>'required | array | min:2',
            'locations.*.name'=>'required',
            'locations.*.time'=>'required',
            'locations.*.latitude'=>'required',
            'locations.*.longitude'=>'required',
            'locations.*.price'=>'required',
            'start_time'=>'required',
            'finish_time'=>'required',
            'area'=>'required',
            
        ]);

        if($data->fails()){
            return $this->error("", 403 ,$data->errors());
        }

        $data = $request->all();
      
        $data['client_id'] = auth()->guard('client')->id(); 
        
        $path = Path::create($data);
        

        $i = 0;
      
        foreach($request->locations as $location){
              
            Location::create([
                'path_id'=>$path->id,
                'name'=>$location['name'],
                'latitude'=>$location['latitude'],
                'longitude'=>$location['longitude'],
                'time'=>$location['time'],
                'price'=>$location['price'],
                'order'=>$i
            ]);
            $i++;
        }
        return $this->success("","Ma'lumot kiritildi");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function show(Path $path)
    {
        if(isset($path->id)){
            return $this->success($path);
        }else{
            return $this->error("",400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function edit(Path $path)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Path $path)
    {
         if( $path->client_id != auth()->guard('client')->id()){
                return $this->error('Bu path sizga tegishi emas',400);
            }
        if(isset($request->times)){
         
            $data = Validator::make($request->all(),[
                'times'=>'array',
                'start_time'=>'required',
                'finish_time'=>'required',
            ]);
    
            if($data->fails()){
                return $this->error("", 403 ,$data->errors());
            }
            
            foreach($path->locations as $location){
                $location->time = $request->times[$location->order];
                $location->save();
            }

            $path->start_time = $request->start_time;
            $path->finish_time = $request->finish_time; 
            $path->save();
            return $this->success($path,"Ma'lumot O'zgartirildi");

        }elseif(isset($request->area)){
             $path->area = $request->area;
             $path->save();
            return $this->success($path,"Ma'lumot O'zgartirildi");
        }
        return $this->error("Mumkun bo'lmagan ma'lumot kiritildi",400);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function destroy(Path $path)
    {
        if( $path->client_id != auth()->guard('client')->id()){
            return $this->error('Bu path sizga tegishi emas',400);
        }
        Location::where('path_id', $path->id)->delete();
        $path->delete();
        return $this->success();
    }
}