@extends('layouts.master', ['title' => 'Mutu Kaputama'])

@section('url-css', 'public.css')
@section('content')
<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Dokumen Mutu Kaputama</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">STMIK KAPUTAMA</h1>
        <p class="lead">Menjadi perguruan tinggi bidang teknologi informasi yang unggul, profesional, berkarakter, dan
            berjiwa entrepreneur di Sumatera Utara (Tahun 2022), serta Indonesia (Tahun 2032).</p>

    </div>
</div>

<div class="container">

    <div class="row mt-4">

    @foreach($mutu as $m)
        <div class="col-12 col-md-4">
            <div class="card card-artikel">
                <div class="card-header">
                    {{ $m->nama }}
                </div>
                <div class="card-body">
                    <p>
                        {{  substr($m->keterangan, 0, 60 )}}
                    </p>
                    <a href="/download-file-mutu/{{ $m->nama_file }}" class="btn btn-sm btn-primary">Download</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>

@stop
