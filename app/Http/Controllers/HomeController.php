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
}


