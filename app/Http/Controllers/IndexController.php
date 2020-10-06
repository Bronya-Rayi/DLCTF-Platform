<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //返回网站主页
    public function index()
    {;
    	if(Auth::check()){
    		return view('ctf.index',['user_data' => Auth::user()]);
    	}

        return view('ctf.index',['user_data' => 'null']);
    }

    public function team()
    {
    	if(Auth::check()){
    		return view('ctf.team',['user_data' => Auth::user()]);
    	}

    	return view('auth.login');
    }

    public function login()
    {
    	if(Auth::check()){
    		return view('ctf.index',['user_data' => Auth::user()]);
    	}

    	return view('auth.login');
    }

    public function register()
    {
    	if(Auth::check()){
    		return view('ctf/index',['user_data' => Auth::user()]);
    	}

    	return view('auth.register');
    }

    
}
