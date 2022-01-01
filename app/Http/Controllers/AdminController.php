<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function dashboard(){
        $employees=User::orderBy('id','desc')->get();
        return view('backpanel.dashboard')->with('userCount',count($employees));
    }

    
}
