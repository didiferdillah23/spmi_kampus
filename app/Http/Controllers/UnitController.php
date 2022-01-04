<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen_mutu;
use App\Models\Hasil_kerja;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    public function index()
    {
        $dok = Dokumen_mutu::get();
        return view('unit.index', compact('dok'));
    }

    public function search_dokumen(Request $request)
    {
        $dok = Dokumen_mutu::where('nama', $request->nama_kode_dok)->orWhere('kode', $request->nama_kode_dok)->get();
        return view('unit.index', compact('dok'));
    }

    // public function search_unit($level)
    // {
    
    //     $data_user = User::where('level', $level)->where('username', $request->username)->get();
    //     return view('admin.data_user', compact('data_user', 'level'));
    // }

    public function show_hasil_kerja($id)
    {
        $dok = Dokumen_mutu::where('id', $id)->first();
        $hasil = Hasil_kerja::where('dokumen_mutu_id', $id)->get();
        return view('unit.submit_hasil', compact('dok', 'hasil'));
    }

    public function add_hasil_kerja(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'file_hasil_kerja' => 'required'
        ]);

        $hasil_kerja = new Hasil_kerja;

        $file = $request->file('file_hasil_kerja');
        $nama = time();
        $extension = $file->getClientOriginalExtension();
        $nama_file = $nama . '.' . $extension;
        Storage::putFileAs('dok_hasil', $request->file('file_hasil_kerja'), $nama_file);
        
        // =============
        $hasil_kerja->user_id = session()->get('info_login')->id;
        $hasil_kerja->dokumen_mutu_id = $request->dokumen_mutu_id;
        $hasil_kerja->nama_file = $nama_file;
        $hasil_kerja->keterangan = $request->keterangan;

        $hasil_kerja->save();

        return redirect('/unit/submit-hasil/'.$hasil_kerja->dokumen_mutu_id);
    }

    public function show_edit_hasil($id)
    {
        $data = Hasil_kerja::where('id', $id)->first();
        return view('unit.edit_hasil_kerja', compact('data'));
    }

    public function edit_hasil_kerja(Request $request)
    {   
        $request->validate([
            'keterangan' => 'required',
        ]);

        if ($request->file_dokumen == null) {
            $nama_file = $request->file_lama;
        }else{
            Storage::disk('local')->delete('/dok_hasil/'.$request->file_lama);
            $file = $request->file('file_dokumen');
            $nama = time();
            $extension = $file->getClientOriginalExtension();
            $nama_file_baru = $nama . '.' . $extension;
            Storage::putFileAs('dok_hasil', $request->file('file_dokumen'), $nama_file_baru);

            $nama_file = $nama_file_baru;
        }
        
        Hasil_kerja::where('id', $request->id)->update(
            [
                'keterangan' => $request->keterangan,
                'nama_file' => $nama_file,
            ]);    
        return redirect('/unit/submit-hasil/'.$request->dokumen_mutu_id);
    }

    public function destroy_hasil_kerja($id, $filename)
    {
        Storage::disk('local')->delete('/dok_hasil/'.$filename);
        Hasil_kerja::where('id', $id)->delete();
        return redirect()->back();
    }
}
