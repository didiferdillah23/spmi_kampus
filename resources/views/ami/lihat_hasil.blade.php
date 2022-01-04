@extends('layouts.master', ['title' => 'Hasil Kerja Unit'])


@section('url-css', 'admin-data-user.css')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid" style="border-bottom: 1px solid grey;">
        <a class="navbar-brand mb-3" href=""><span class="btn btn-success">AUDIT PAGE |
                {{ session('info_login')->nama }}</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-link mr-5" style="height: 40px;" href="/ami">Dashboard</a>
                <!-- <p class="nav-link active mr-3">{{ session('info_login')->nama }} <span
                        class="badge badge-info">{{ session('info_login')->level }}</span></p> -->
                <a class="nav-link btn btn-danger" style="color: white;line-height: 20px;height: 40px;"
                    href="/logout">logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-5">
    <h3 style="color: whitesmoke;font-family: montserrat;">Hasil kerja : {{ $hasil_kerja[0]->user->nama }}</h3>
    <br>
    <!--  -->
    <!-- <div class="row">
        <div class="col-9">
            <form class="form-inline" action="" method="get">
                <div class="form-group mr-sm-3 mb-2">
                    <input type="username" name="username" class="form-control" id="username" placeholder="Cari unit">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                <a href="" class="btn btn-warning mb-2 ml-1">Refresh</a>
            </form>
        </div>
    </div> -->
    <!--  -->
    <table class="table table-striped">
        <thead class="bg-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dokumen Mutu</th>
                <th scope="col">Hasil & Keterangan</th>
                <th scope="col">nilai</th>
                <th scope="col">keterangan</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($hasil_kerja as $h)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td><a style="color: lightblue !important"
                        href="/ami/download_dok_mutu/{{ $h->Dokumen_mutu->nama_file }}"><u>{{ $h->dokumen_mutu->nama }}</u></a>
                </td>
                <td style="font-size: 13px">{{ $h->keterangan }}<br><a
                        href="/ami/download_hasil_kerja/{{ $h->nama_file }}" class="badge badge-success p-2 mt-1">unduh
                        hasil kerja</a></td>
                @if($h->penilaian_kinerja == null)
                <td>0</td>
                <td>-</td>
                @else
                <td>{{ $h->penilaian_kinerja->nilai }}</td>
                <td>{{ $h->penilaian_kinerja->keterangan }}</td>
                @endif
                <td>
                    @if($h->penilaian_kinerja == null)
                    <a href="/ami/beri-nilai/{{ $h->id }}/{{ $h->user->username }}" class="btn btn-sm btn-primary">
                        Beri nilai</a>
                    @else
                    <a href="/ami/edit-nilai/{{ $h->id }}" class="btn btn-sm btn-warning">
                        Edit nilai</a>
                    @endif
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br>
</div>

@stop
