@extends('layouts.master', ['title' => 'Edit Nilai | '.$data->user->nama])


@section('url-css', 'admin-data-user.css')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">
            <h2><a href="/ami/lihat-hasil/{{ $data->user->username }}" style="color: white;font-size: 40px;">&larr;</a>Edit Nilai :  {{ $data->user->nama }} | {{ $data->Dokumen_mutu->nama }}<b></b> </h2>
            <div class="card p-3">
                <form action="/ami/edit-nilai" method="post">
                @csrf
                <input type="hidden" name="hasil_id" value="{{ $hasil_id }}">
                <input type="hidden" name="username" value="{{ $data->user->username }}">
                    <div class="form-group">
                        <label for="">Nilai</label>
                        <input type="number" name="nilai" class="form-control" value="{{ $data->nilai }}">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" id="" cols="30" rows="3" class="form-control">{{ $data->keterangan }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
