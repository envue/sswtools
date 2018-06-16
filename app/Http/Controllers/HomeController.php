<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        
        $timeentries = \App\TimeEntry::with('work_type')->latest()->limit(5)->get(); 

             
        $userID = \Auth::user()->id;
        $userEmail = \Auth::user()->email;
        $userName = \Auth::user()->name;
        $userRole = \Auth::user()->role->title;
        $userTeam = isset(\Auth::user()->team->name) ? : "";

     
        return view('home', compact( 'timeentries', 'userID', 'userEmail', 'userName', 'userRole', 'userTeam' ));
    }
}
