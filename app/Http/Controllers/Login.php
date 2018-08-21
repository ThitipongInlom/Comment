<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Guard;


class Login extends Controller
{
    public function Do_login()
    {
    	$username = Input::post('username');
    	$password = Input::post('password');
		if (Auth::attempt(['username' => $username, 'password' => $password])) {
				$data = ['Name' => 'Nice', 'Pass' => 'Nice', 'Login' => 'Username'];
				Session::put('Login', $data);
		        return redirect('Dashboard');
		}
		elseif (Auth::attempt(['email'=> $username, 'password' => $password])) {
				$data = ['Name' => 'Nice', 'Pass' => 'Nice', 'Login' => 'E-Mail'];
				Session::put('Login', $data);
		        return redirect('Dashboard');
		} 
		else {
				return back()->withInput();
		}
    }

    public function Dashboard()
    {
        $create_link = DB::select("select * from create_link");
    	return view('dashboard',[
            'create_link' => $create_link,
            ]);
    }

    public function Create_Link()
    {
        return view('create_link');
    }

    public function Star()
    {
    	return view('star');
    }

    public function Logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('Admin');
    }
}
