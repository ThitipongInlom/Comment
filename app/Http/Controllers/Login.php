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

		        echo "success with username!";
		}
		elseif (Auth::attempt(['email'=> $username, 'password' => $password])) {

		        echo "success with email!"; 
		} 
		else {
		        echo "fail!";

		}
		
    }

    public function Dashboard()
    {
    	return view('dashboard');
    }
}
