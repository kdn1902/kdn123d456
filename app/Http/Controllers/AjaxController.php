<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadphoto(Request $request, \App\SimpleImage $image)
    {
        	if($request->hasFile('image')) 
        	{
        		$path = $request->file("image")->store('employee_photo', 'public');  
        		$small_path = $request->file("image")->store('employee_photo/small', 'public');  
        		$image->load(storage_path('app/public/' . $path));
        		$image->resizeToWidth(150);
   				$image->save(storage_path('app/public/' . $small_path));
        		$photo = new \App\Photo();
        		$photo->employee_id = $request->id;
        		$photo->photo_path = $path;
    			$photo->smallphoto_path = $small_path;
    			$photo->save();
    			return response()->json(["photo"=>$path, "small_photo" => $small_path]);
        	}
        	else
        	{
				abort(403, 'Unauthorized action.');
			}
    }
    
    public function dropphoto(Request $request)
    {
				$photo = \App\Photo::where('smallphoto_path', $request->smallphoto)->first();
				$smallphoto_path = $photo->smallphoto_path;
				$photo_path = $photo->photo_path;
				$photo->delete();
				unlink(storage_path() . "/app/public/" . $photo_path);
				unlink(storage_path() . "/app/public/" . $smallphoto_path);
    			return response()->json(["photo"=>$photo_path, "small_photo" => $smallphoto_path]);
	}

}