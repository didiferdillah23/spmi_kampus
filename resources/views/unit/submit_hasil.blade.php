@extends('layouts.master', ['title' => 'Submit Hasil | '.session('info_login')->nama])


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
                <a class="nav-link mr-5" style="height: 40px;"
                    href="/unit">Dashboard</a>
                <!-- <p class="nav-link active mr-3">{{ session('info_login')->nama }} <span
                        class="badge badge-info">{{ session('info_login')->level }}</span></p> -->
                <a class="nav-link btn btn-danger" style="color: white;line-height: 20px;height: 40px;"
                    href="/logout">logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid mt-5">
    <h2>Hasil Kerja : {{ $dok->nama }}</h2>
    <p style="color: whitesmoke;font-family: montserrat;">{{ $dok->keterangan }}</p>
    <br>
    <div class="row">
    <div class="col-5">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
        @endif
    </div>
    </div>
    <div class="row">
        <div class="col-9">
            <form class="form-inline" action="" method="get">
                <div class="form-group mr-sm-3 mb-2">
                    <input type="username" name="username" class="form-control" id="username" placeholder="Cari unit">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                <a href="/unit/submit-hasil/{{ $dok->id }}" class="btn btn-warning mb-2 ml-1">Refresh</a>
            </form>
        </div>
        <div class="col-3">
            <button class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal"><b>+</b>
                Tambah Hasil Kerja</button>
        </div>
    </div>
    <!--  -->
    <table class="table table-striped">
        <thead class="bg-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Hasil Dari</th>
                <th scope="col">Keterangan</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($hasil as $h)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td><a style="color: lightblue !important"
                        href="/unit/download_hasil_mutu/{{ $h->nama_file }}"><u>{{ $h->user->nama }}</u></a></td>
                <td style="font-size: 13px">{{ $h->keterangan }}</td>
                <td>
                    @if($h->user->id !== session()->get('info_login')->id)
                    @else
                    <a href="/unit/edit-hasil/{{ $h->id }}" class="badge badge-success p-2">edit</a>
                    <a onclick="return confirm('Apakah anda yakin ingin menghapus hasil kerja ini?')" href="/unit/hapus-hasil-kerja/{{ $h->id }}/{{ $h->nama_file }}" class="badge badge-danger p-2">hapus</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Hasil Kerja</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/unit/add-hasil-kerja" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dokumen_mutu_id" value="{{ $dok->id }}">
                    <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="" cols="5" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">File</label>
                                <input type="file" name="file_hasil_kerja">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Data-->
@stop
