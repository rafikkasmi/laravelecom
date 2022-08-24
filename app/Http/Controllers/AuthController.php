<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors('fuck off');
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

  
        return redirect("welcome")->withSuccess('yaaayyy connected');
    }

    public function register(Request $request){

        $request->validate([
            'fname' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'password' => 'required',
        ]);

   
            $data = $request->all();
            $data['password']=Hash::make($request->password);
            $data['role_id']=User::CLIENT_ROLE;
            $check = User::create($data);
             
            return redirect("login")->withSuccess('Great! You have Successfully loggedin');
    }

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
}
