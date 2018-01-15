<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\drug;
use App\drugmart;
use Illuminate\Http\Request;

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
		$ad=Auth::user()->name;
		$xx=date('d-m-Y');
$data = DB::table('profit')->where('adby', $ad)->get();
		return view('home',compact('data'));

    }
}
