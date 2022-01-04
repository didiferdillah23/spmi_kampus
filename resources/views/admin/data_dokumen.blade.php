@extends('layouts.master', ['title' => 'Data Dokumen '. $jenis_dok])


@section('url-css', 'admin-data-user.css')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid" style="border-bottom: 1px solid grey;">
        <a class="navbar-brand mb-3" href="/admin/dashboard">SPMI KAPUTAMA - ADMIN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-link mr-5" style="color: grey;"
                    href="/admin">Dashboard</a>
                <!-- <p class="nav-link active mr-2">{{ session('info_login')->nama }} <span
                        class="badge badge-info">{{ session('info_login')->level }}</span></p> -->
                <a class="nav-link btn btn-danger" style="color: white;line-height: 20px;height: 40px;"
                    href="/logout">logout</a>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <h2 class="mt-5">Data Dokumen {{ $jenis_dok }}</h2>
    <br>
    <!-- <form class="form-inline" action="" method="get">
        <div class="form-group mr-sm-3 mb-2">
            <input type="username" name="username" class="form-control" id="username" placeholder="Cari username">
        </div>
        <button type="submit" class="btn btn-primary mb-2" value="username">Cari</button>
        <a href="" class="btn btn-warning mb-2 ml-1">Refresh</a>
    </form>
    <br> -->
    <!--  -->
    <table class="table table-striped">
        <thead class="bg-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jenis</th>
                <th scope="col">Pembuat</th>
                <th scope="col">Kategori</th>
                <th scope="col">Kode</th>
                <th scope="col">File</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            ?>
            @foreach($dok as $d)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $d->nama }}</td>
                <td style="font-size: 13px">{{ $d->keterangan }}</td>
                <td>{{ $d->jenis_dokumen }}</td>
                <td>{{ $d->user->nama }}</td>
                <td>{{ $d->kategori }}</td>
                <td>{{ $d->kode }}</td>
                <td><a href="" class="badge badge-success p-2">Download</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br>
</div>

@stop
