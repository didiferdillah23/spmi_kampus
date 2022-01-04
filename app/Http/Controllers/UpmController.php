<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen_mutu;
use Illuminate\Support\Facades\Storage;

class UpmController extends Controller
{
    public function index()
    {
        $dok = Dokumen_mutu::get();
        return view('upm.index', compact('dok'));
    }

    public function search_dokumen(Request $request)
    {
        $dok = Dokumen_mutu::where('nama', $request->nama_kode_dok)->orWhere('kode', $request->nama_kode_dok)->get();
        return view('upm.index', compact('dok'));
    }

    public function add_dokumen(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:dokumen_mutu',
            'kode' => 'unique:dokumen_mutu',
            'jenis_dokumen' => 'required',
            'keterangan' => 'required',
        ]);

        $dok = new Dokumen_mutu;

        $file = $request->file('file_dokumen');
        $nama = time();
        $extension = $file->getClientOriginalExtension();
        $nama_file = $nama . '.' . $extension;
        Storage::putFileAs('dok_mutu', $request->file('file_dokumen'), $nama_file);
        
        // =============
        $dok->user_id = session()->get('info_login')->id;
        $dok->jenis_dokumen = $request->jenis_dokumen;
        $dok->nama = $request->nama;
        $dok->keterangan = $request->keterangan;
        $dok->kategori = ($request->jenis_dokumen !== 'standard' && $request->jenis_dokumen !== 'formulir') ? null : $request->kategori;
        $dok->kode = ($request->jenis_dokumen !== 'standard' && $request->jenis_dokumen !== 'formulir') ? null : $request->kode;
        $dok->nama_file = $nama_file;

        $dok->save();

        return redirect('/upm');
    }

    public function show_edit_dok_mutu($id)
    {   
        $data = Dokumen_mutu::where('id', $id)->first();
        return view('upm.edit_dok_mutu', compact('data'));
    }

    public function edit_dok_mutu(Request $request)
    {   
        $request->validate([
            'keterangan' => 'required',
        ]);

        if ($request->file_dokumen == null) {
            $nama_file = $request->file_lama;
        }else{
            Storage::disk('local')->delete('/dok_mutu/'.$request->file_lama);
            $file = $request->file('file_dokumen');
            $nama = time();
            $extension = $file->getClientOriginalExtension();
            $nama_file_baru = $nama . '.' . $extension;
            Storage::putFileAs('dok_mutu', $request->file('file_dokumen'), $nama_file_baru);

            $nama_file = $nama_file_baru;
        }
        
        Dokumen_mutu::where('id', $request->id)->update(
            [
                'keterangan' => $request->keterangan,
                'nama_file' => $nama_file,
            ]);    
        return redirect('/upm');
    }

    public function destroy_dokumen($id, $filename)
    {
        Storage::disk('local')->delete('/dok_mutu/'.$filename);
        Dokumen_mutu::where('id', $id)->delete();
        return redirect()->back();
    }
}
