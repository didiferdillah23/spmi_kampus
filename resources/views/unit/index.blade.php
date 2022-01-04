@extends('layouts.master', ['title' => session('info_login')->nama])


@section('url-css', 'admin-data-user.css')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid" style="border-bottom: 1px solid grey;">
        <a class="navbar-brand mb-3" href=""><span class="btn btn-primary">UNIT PAGE | {{ session('info_login')->nama }}</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-link mr-5 active"
                    href="/admin">Dashboard</a>
                <!-- <p class="nav-link active mr-3">{{ session('info_login')->nama }} <span
                        class="badge badge-info">{{ session('info_login')->level }}</span></p> -->
                <a class="nav-link btn btn-danger" style="color: white;line-height: 20px;height: 40px;"
                    href="/logout">logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-5">
    <h2>Dokumen Mutu</h2>
    <!--  -->
    <div class="row">
        <div class="col-9">
            <form class="form-inline" action="/unit/cari-dokumen" method="get">
                <div class="form-group mr-sm-3 mb-2">
                    <input type="text" name="nama_kode_dok" class="form-control" placeholder="Cari nama/kode dokumen">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                <a href="/unit" class="btn btn-warning mb-2 ml-1">Refresh</a>
            </form>
        </div>
        <div class="col-3">
            
        </div>
    </div>
    <!--  -->
    <table class="table table-striped">
        <thead class="bg-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Kategori</th>
                <th scope="col">Kode</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($dok as $d)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td><a style="color: lightblue !important" href="/unit/download_dok_mutu/{{ $d->nama_file }}"><u>{{ $d->nama }}</u></a></td>
                <td>{{ $d->jenis_dokumen }}</td>
                <td style="font-size: 13px">{{ $d->keterangan }}</td>
                <td>@if($d->kategori == null) - @else {{ $d->kategori}} @endif</td>
                <td>@if($d->kode == null) - @else {{ $d->kode}} @endif</td>
                <td>
                    <a href="/unit/submit-hasil/{{ $d->id }}" class="badge badge-success p-2">Submit Hasil</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br>
</div>


@stop
