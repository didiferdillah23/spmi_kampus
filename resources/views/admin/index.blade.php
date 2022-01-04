@extends('layouts.master', ['title' => 'ADMIN'])


@section('url-css', 'admin-index.css')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid" style="border-bottom: 1px solid grey;">
        <a class="navbar-brand mb-3" href="">SPMI KAPUTAMA - ADMIN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
            <a class="nav-link mr-5 active" style="height: 40px;"
                    href="/admin">Dashboard</a>
                <!-- <p class="nav-link active mr-3">{{ session('info_login')->nama }} <span class="badge badge-info">{{ session('info_login')->level }}</span></p> -->
                <a class="nav-link btn btn-danger" style="color: white;line-height: 20px;height: 40px;"
                    href="/logout">logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <h2 class="mt-5">&#x2750;Data User</h2>
        <div class="row">
            <div class="col-md-6 mt-4">
                <div class="card p-3">
                    <h4>Unit</h4>
                    <p>{{ $jumlah_unit }} user</p>
                    <a href="/admin/data-user/unit" class="btn btn-info">Lihat</a>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card p-3">
                    <h4>Audit Mutu Internal</h4>
                    <p>{{ $jumlah_ami }} user</p>
                    <a href="/admin/data-user/ami" class="btn btn-info">Lihat</a>
                </div>
            </div>
    </div>
    <!-- ////// -->
    <h2 style="margin-top: 90px;">&#x2750;Dokumen Mutu</h2>
        <div class="row">
        <div class="col-md-4 mt-4">
                <div class="card p-3">
                    <h4>Buku Mutu</h4>
                    <p>{{ $jumlah_dokumen[0] }} dokumen</p>
                    <a href="/admin/lihat/buku%20mutu" class="btn btn-info">Lihat</a>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card p-3">
                    <h4>Manual</h4>
                    <p>{{ $jumlah_dokumen[1] }} dokumen</p>
                    <a href="/admin/lihat/manual" class="btn btn-info">Lihat</a>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card p-3">
                    <h4>Instruksi Kerja</h4>
                    <p>{{ $jumlah_dokumen[2] }} dokumen</p>
                    <a href="/admin/lihat/instruksi%20kerja" class="btn btn-info">Lihat</a>
                </div>
            </div>
        </div>
        <div class="row mt-2">
        <div class="col-md-6 mt-4">
                <div class="card p-3">
                    <h4>Standard</h4>
                    <p>{{ $jumlah_dokumen[3] }} dokumen</p>
                    <a href="/admin/lihatt/standard" class="btn btn-info">Lihat</a>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card p-3">
                    <h4>Formulir</h4>
                    <p>{{ $jumlah_dokumen[4] }} dokumen</p>
                    <a href="/admin/lihatt/formulir" class="btn btn-info">Lihat</a>
                </div>
            </div>
        </div>
    <br><br><br>
</div>
@stop
