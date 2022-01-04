@extends('layouts.master', ['title' => 'Beri Nilai | '.$data_hasil->user->nama])


@section('url-css', 'admin-data-user.css')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 mt-5">
            <h2><a href="/ami/lihat-hasil/{{ $username }}" style="color: white;font-size: 40px;">&larr;</a>Beri Nilai : {{ $data_hasil->user->nama }} | {{ $data_hasil->Dokumen_mutu->nama }}<b></b> </h2>
            <div class="card p-3">
                <form action="/ami/beri-nilai" method="post">
                @csrf
                <input type="hidden" name="hasil_kerja_id" value="{{ $hasil_id }}">
                    <div class="form-group">
                        <label for="">Nilai</label>
                        <input type="number" name="nilai" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
