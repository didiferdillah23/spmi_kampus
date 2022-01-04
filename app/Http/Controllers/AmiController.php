<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen_mutu;
use App\Models\User;
use App\Models\Hasil_kerja;
use App\Models\Penilaian_kinerja;

class AmiController extends Controller
{
    public function index()
    {
        $unit = User::where('level', 'unit')->get();
        return view('ami.index', compact('unit'));
    }

    public function show_hasil_kerja($username)
    {
        $user = User::where('username', $username)->first();
        $hasil_kerja = Hasil_kerja::where('user_id', $user->id)->get();
        return view('ami.lihat_hasil', compact('hasil_kerja'));
    }

    public function show_beri_nilai($hasil_id, $username)
    {
        $data_hasil = Hasil_kerja::find($hasil_id);
        return view('ami.beri_nilai', compact('hasil_id', 'username', 'data_hasil'));
    }

    public function beri_nilai(Request $request)
    {
        $request->validate([
            'hasil_kerja_id' => 'unique:penilaian_kinerja',
        ]);

        $hasil_kerja = Hasil_kerja::find($request->hasil_kerja_id);
        $dokumen_mutu_id = Hasil_kerja::find($request->hasil_kerja_id)->dokumen_mutu_id;

        $penilaian_kinerja = new Penilaian_kinerja;

        $penilaian_kinerja->user_id = $hasil_kerja->user_id;
        $penilaian_kinerja->dokumen_mutu_id = $dokumen_mutu_id;
        $penilaian_kinerja->hasil_kerja_id = $request->hasil_kerja_id;
        $penilaian_kinerja->nilai = $request->nilai;
        $penilaian_kinerja->keterangan = $request->keterangan;

        $penilaian_kinerja->save();

        return redirect('/ami/lihat-hasil/'.$hasil_kerja->user->username);
    }

    public function show_edit_nilai($hasil_id)
    {
        $data = Penilaian_kinerja::where('hasil_kerja_id', $hasil_id)->first();
        return view('ami.edit_nilai', compact('data', 'hasil_id'));
    }

    public function edit_nilai(Request $request)
    {
        $request->validate([
            'nilai' => 'required',
            'keterangan' => 'required',
        ]);
        
        Penilaian_kinerja::where('hasil_kerja_id', $request->hasil_id)->update(
            [
                'nilai' => $request->nilai, 'keterangan' => $request->keterangan
            ]);    
        return redirect('/ami/lihat-hasil/' . $request->username);
    }

    public function search_unit(Request $request)
    {
        $unit = User::where('nama', $request->nama_unit)->get();
        return view('ami.index', compact('unit'));
    }
}
