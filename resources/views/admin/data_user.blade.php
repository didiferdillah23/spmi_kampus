@extends('layouts.master', ['title' => 'Data User '. $level])


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
                <a class="nav-link mr-5" style="color: grey;" href="/admin">Dashboard</a>
                <!-- <p class="nav-link active mr-2">{{ session('info_login')->nama }} <span
                        class="badge badge-info">{{ session('info_login')->level }}</span></p> -->
                <a class="nav-link btn btn-danger" style="color: white;line-height: 20px;height: 40px;"
                    href="/logout">logout</a>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <h2 class="mt-5">Data User @if($level == 'ami') Audit Mutu Internal @elseif($level == 'upm') Unit Penjamin Mutu
        @else Unit @endif</h2>
    <br>
    
    <!--  -->
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
        <div class="col-9">
            <form class="form-inline" action="/admin/data-user/cari/{{ $level }}" method="get">
                <div class="form-group mr-sm-3 mb-2">
                    <input type="username" name="username" class="form-control" id="username"
                        placeholder="Cari username" value="{{ old('username') }}">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                <a href="/admin/data-user/{{ $level }}" class="btn btn-warning mb-2 ml-1">Refresh</a>
            </form>
        </div>
        <div class="col-3">
            <button class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal"><b>+</b>
                Tambah data {{ $level }}</button>
        </div>
    </div>
    <!--  -->
    <table class="table table-striped">
        <thead class="bg-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($data_user as $du)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $du->nama }}</td>
                <td>{{ $du->username }}</td>
                <td>{{ $du->password }}</td>
                <td>
                    <a href="/admin/edit-user/{{ $du->id }}/{{ $level }}" class="badge badge-info p-2">Edit</a>
                    <a href="/admin/hapus-user/{{ $du->id }}" class="badge badge-danger p-2"
                        onclick="return confirm('Apakah anda yakin akan menghapus, {{ $du->nama }}?')">Hapus</a>
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
                <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Data {{ $level }} Baru</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/add-user" method="post">
                    @csrf
                    <input type="hidden" name="level" value="{{ $level }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control" id="" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" name="password" class="form-control" id="">
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
