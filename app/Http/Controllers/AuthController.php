<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users|min:10',
            'password' => 'required|min:8|string',
            // 'confirm_password' => 'same:password',
        ]);


        $users = new User();
        $users->role_as = '5';
        $users->firstname = $request->firstname;
        $users->lastname = $request->lastname;
        $users->email = $request->email;
        $users->phone_number = $request->phone_number;
        $users->password = Hash::make($request->password);
        $users->status = 1;
        $users->save();

        // $confirm = Hash::make($request->conf_pass);

        // if($users->password == $confirm){
        //     $users->save();
        //     if($users->save()){
        //         return Inertia::render('Login');
        //     }
        // }

    }

    public function log(Request $request)
    {

        // $user = new User();
        $email = $request->email;
        $password = $request->password;
        // dd("admin@black.com");
       if(Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])){

        if(Auth::user()->role_as == '5'){
            return redirect('/buyerdash');
        }else{
           // $this.$router.push('/dashboard');
             return redirect('admindash');
        }
       }else{
        return redirect()->back()->with('status', 'Incorrect login credentials');
        }
    }
}
