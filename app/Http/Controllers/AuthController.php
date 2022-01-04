<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function show_login()
    {
        if ( session()->get('info_login') ) {
            return redirect(session()->get('info_login')->level);
        }else{
            return view('login');
        }
    }

    public function login(Request $request)
    {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);

            if ( User::where('username', $request->username)->count() ) {
                $data_user = User::where(
                    [
                        ['username', '=', $request->username],
                        ['password', '=', $request->password],
                    ]);
                if ( $data_user->count() ){
                        session(['info_login' => $data_user->first()]);
                        return redirect(session()->get('info_login')->level);
                }else{
                    return redirect('login')->with('passwordSalah', 'Password anda salah');
                }
            }else {
                return redirect('login')->with('passwordSalah', 'username yang anda masukkan tidak ada');
            }
    }
}

