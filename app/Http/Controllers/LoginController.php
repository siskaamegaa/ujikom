<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Session;


class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        } else {
            return view('login');
        }
    }


    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];


        if (Auth::attempt($data)) {
            return redirect('home');
        } else {
            session()->flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }


    // Logout
    public function actionlogout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }



    // Register
    public function register()
    {
        return view("register");
    }

    // Validasi
    public function proses_register(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        // Validasi jika gagal maka akan kembali ke /register
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // jika berhasil maka hash passwordnya
        $request['password'] = bcrypt($request->password);

        User::create($request->all());

        // kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }
}
