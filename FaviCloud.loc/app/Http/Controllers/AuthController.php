<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {

        if (Auth::check()) {
            return redirect("/");
        }

        else {
            return view('authentication.login');
        }

    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("/");
        }

        return redirect()->back()->withErrors(['invalid_data' => 'Username or password is invalid']);
    }


    public function registration()
    {
        return view('authentication.registration');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'regex:/^[a-zA-Z]+$/', 'max:50'],
            'last_name' => ['required', 'regex:/^[a-zA-Z]+$/', 'max:50'],
            'username' => 'required|unique:users|max:50',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:6|confirmed',

        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login");
    }


    public function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return redirect("files");
        }

        return redirect("login")->withErrors(['invalid_data' =>'You are not allowed to access']);
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
