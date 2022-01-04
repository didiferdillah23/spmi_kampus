<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dokumen_mutu;
use App\Models\User;

class AdminController extends Controller
{

    public function index()
    {
        $jumlah_upm = User::where('level', 'upm')->count();
        $jumlah_unit = User::where('level', 'unit')->count();
        $jumlah_ami = User::where('level', 'ami')->count();
        ///doukemen
        $jumlah_dokumen = [
            Dokumen_mutu::where('jenis_dokumen', 'buku mutu')->count(),
            Dokumen_mutu::where('jenis_dokumen', 'manual')->count(),
            Dokumen_mutu::where('jenis_dokumen', 'instruksi kerja')->count(),
            Dokumen_mutu::where('jenis_dokumen', 'standard')->count(),
            Dokumen_mutu::where('jenis_dokumen', 'formulir')->count(),
        ];
        return view(session()->get('info_login')->level . "/index", compact('jumlah_upm', 'jumlah_unit', 'jumlah_ami', 'jumlah_dokumen'));
        
    }

    public function show_dokumen($jenis_dok)
    {
        $dok = Dokumen_mutu::where('jenis_dokumen', $jenis_dok)->get();
        return view('admin.data_dokumen', compact('jenis_dok', 'dok'));
    }

    public function show_dokumen_sf($jenis_dok)
    {
        $dok = Dokumen_mutu::where('jenis_dokumen', $jenis_dok)->get();
        return view('admin.data_dokumen_fs', compact('jenis_dok', 'dok'));
    }

    public function search_dokumen_sf(Request $request, $jenis_dok)
    {
        $dok = Dokumen_mutu::where('jenis_dokumen', $jenis_dok)->where('kode', $request->kode)->get();
        return view('admin.data_dokumen_fs', compact('jenis_dok', 'dok'));
    }

    public function tambah_user(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = new User;

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->level = $request->level;

        $user->save();

        return redirect()->back();
    }

    public function show_user($level)
    {
        $data_user = User::where('level', $level)->get();
        return view('admin.data_user', compact('data_user', 'level'));
    }

    public function search_user(Request $request, $level)
    {
        // if($request->username == null){
        //     $data_user = User::where('level', $level)->get();
        // }else{
            $data_user = User::where('level', $level)->where('username', $request->username)->get();
        // }
        return view('admin.data_user', compact('data_user', 'level'));
    }

    public function show_edit_user($id, $level)
    {   
        $user = User::where('id', $id)->first();
        if($user->level !== $level) {
            return redirect()->back(); 
        }else{
            return view('admin.edit_data_user', compact('user'));
        }
    }

    public function edit_user(Request $request)
    {   
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        User::where('id', $request->id)->where('level', $request->level)->update(
            [
                'username' => $request->username, 'password' => $request->password
            ]);    
        return redirect('/admin/data-user/' . $request->level);
    }

    public function destroy_user($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}
