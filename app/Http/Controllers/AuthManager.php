<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\Film;
use App\Models\Kitap;

class AuthManager extends Controller
{
    function login(){
        if(Auth::check()){
            $filmler = Film::all();
            $kitaplar = Kitap::all();
            return view('layout', compact('filmler','kitaplar'));
        }
        return view('login');
    
    }
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $filmler = Film::all();
            $kitaplar = Kitap::all();
            return view('layout', compact('filmler','kitaplar'));
        }
        return redirect(route('login'))->with("error","Login details are not valid");
    }
    function registration(){
        return view('registration');
    }
    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $userRole = Role::findByname('user');
        $user =User::create($data);
        $user->assignRole($userRole);
        $user->givePermissionTo($userRole->getAllPermissions());
        if(!$user){
            return redirect(route('registration'))->with("error","Registration failed, try again");
        }
        return redirect(route('login'))->with("success","Registration success, Login to access the app");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
    function admin(){
        return view('admin');
    }
    function layout(){
        if(Auth::check()){
            $filmler = Film::all(); 
            $kitaplar =Kitap::all();
            return view('layout', compact('filmler','kitaplar'));
        }

    }

    

}
