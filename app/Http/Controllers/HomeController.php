<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function getemployees()
    {
        $vuetable = new \App\EloquentVueTables();
        $table_data = $vuetable->get(new \App\Employee, ['id', 'lastname', 'firstname', 'middlename', 'birthday', 'deathday', 'address']);
        return response()->json($table_data);
    }
    
    public function getemployee($id) 
    {
    	$empl = \App\Employee::find($id);
    	$small_photos = [];
    	$photos = [];
    	foreach ($empl->photos()->get() as $photo) {
    		$small_photos[] = $photo->smallphoto_path;
    		$photos[] = $photo->photo_path;
		}
		$empl['photo'] = $photos;
		$empl['small_photo'] = $small_photos;
		return view('employee',['empl' => $empl]);
	}
	
	public function saveemployee(Request $request)
	{
    	$this->validate($request, [
    			'lastname' => 'required|alpha',
    			'firstname' => 'required|alpha',
    			'middlename' => 'required|alpha',
    			'birthday' => 'required']);
     			$employee = \App\Employee::find($request->id);
    			$employee->lastname = $request->lastname;
    			$employee->firstname = $request->firstname;
    			$employee->middlename = $request->middlename;
    			$employee->birthday = $request->birthday;
    			$employee->deathday = $request->deathday;
    			$employee->address = $request->address;
    			$employee->save();
    		   	return response()->json(["status" => "Data saved successfully"]);
	}
	
	public function dropemployee(Request $request)
	{
		$employee = \App\Employee::find($request->id);
		$photos = $employee->photos()->get();
		$employee->photos()->delete();
		$employee->delete();
		
		foreach ($photos as $photo)
		{
			unlink(storage_path() . "/app/public/" . $photo->photo_path);
			unlink(storage_path() . "/app/public/" . $photo->smallphoto_path);
		}
		$request->session()->flash('status', 'Record successfully deleted!');
		return response()->json(["redirect"=>url('home')]);
	}
	
	public function newemployee()
	{
		return view('newemployee');
	}

	public function createemployee(Request $request)
	{
    	$this->validate($request,
    	 		['lastname' => 'required|alpha',
    			'firstname' => 'required|alpha',
    			'middlename' => 'required|alpha',
    			'birthday' => 'required']);
    	$employee = new \App\Employee;
    	$employee->lastname = $request->lastname;
    	$employee->firstname = $request->firstname;
    	$employee->middlename = $request->middlename;
    	$employee->birthday = $request->birthday;
    	$employee->deathday = $request->deathday;
    	$employee->address = $request->address;
    	$employee->save();
    	return response()->json(["redirect" => url('getemployee', [ $employee->id ])]);
	}
	
}


