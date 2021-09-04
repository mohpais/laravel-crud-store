<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Hash;
use Session;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showFormLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function doLogin(Request $req)
    {
        // Rules validation
        $rules = [
            'username' => 'required',
            'password' => 'required|string'
        ];

        $messages = [
            'username.required' => 'Username is required!',
            'password.required' => 'Password is required!'
        ];

        $validator = Validator::make($req->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($req->all);
        };

        $data = [
            'username' => $req->input('username'),
            'password' => $req->input('password')
        ];
        
        // Melakukan proses pengecekan validasi login langsung ke table auths dan memberikan fasilitasi session jika berhasil login.
        Auth::attempt($data);
        if (Auth::check()) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('product.index');
            }else{
                return redirect()->route('home');
            }
        } else {
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function showFormRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $rules = [
            'fullname' => 'required|min:3|max:35',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed'
        ];

        $messages = [
            'fullname.required' => 'Nama Lengkap wajib diisi',
            'fullname.min' => 'Nama lengkap minimal 3 karakter',
            'fullname.max' => 'Nama lengkap maksimal 35 karakter',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->fullname = ucwords(strtolower($request->fullname));
        $user->username = strtolower($request->username);
        $user->is_admin = '0';
        $user->password = Hash::make($request->password);
        $simpan = $user->save();

        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
