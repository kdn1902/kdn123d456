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
        $table_data = $vuetable->get(new \App\Employee, ['id', 'lastname', 'firstname', 'otchestvo', 'birthday', 'deathday', 'address']);
        return response()->json($table_data);
    }
    
    public function getemployee($id) 
    {
    	$empl = \App\Employee::find($id);
    	//$empl = DB::table('employees')->where('id', $id)->select('lastname', 'firstname', 'address')->first();
    	//$empl = str_replace('','',json_encode($empl));
    	
		return view('employee',['empl' => $empl]);
	//	print_r(htmlspecialchars(json_encode($empl), ENT_HTML5));
	}

}


