@extends('layouts.master', ['title' => 'Unit Penjamin Mutu'])


@section('url-css', 'admin-data-user.css')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid" style="border-bottom: 1px solid grey;">
        <a class="navbar-brand mb-3" href=""><span class="btn btn-warning">Unit Penjamin Mutu</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-link mr-5 active" href="/admin">Dashboard</a>
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
            <form class="form-inline" action="/upm/cari-dokumen" method="get">
                <div class="form-group mr-sm-3 mb-2">
                    <input type="text" name="nama_kode_dok" class="form-control" placeholder="Cari nama/kode dokumen">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                <a href="/upm" class="btn btn-warning mb-2 ml-1">Refresh</a>
            </form>
        </div>
        <div class="col-3">
            <button class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal"><b>+</b>
                Tambah dokumen</button>
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
                <td><a style="color: lightblue !important"
                        href="/upm/download_dok_mutu/{{ $d->nama_file }}"><u>{{ $d->nama }}</u></a></td>
                <td>{{ $d->jenis_dokumen }}</td>
                <td style="font-size: 13px">{{ $d->keterangan }}</td>
                <td>@if($d->kategori == null) - @else {{ $d->kategori}} @endif</td>
                <td>@if($d->kode == null) - @else {{ $d->kode}} @endif</td>
                <td>
                    @if($d->user->id == session()->get('info_login')->id)
                    <a href="/upm/edit-dok/{{ $d->id }}" class="badge badge-info p-2">Edit</a>
                    <a class="badge badge-danger p-2 mt-1"
                        onclick="return confirm('Apakah anda yakin ingin menghapus, dokumen {{ $d->nama }}?')"  href="/upm/hapus-dokumen/{{ $d->id }}/{{ $d->nama_file }}">Hapus</a>
                    @else
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
                <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Dokumen Mutu Baru</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/upm/add-dokumen" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nama Dokumen Mutu</label>
                                <input type="text" name="nama" class="form-control" id=""
                                    placeholder="Cth. Buku Mutu Pelayanan">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Jenis</label>
                                <select name="jenis_dokumen" class="form-control">
                                    <option value="buku mutu">buku mutu</option>
                                    <option value="instruksi kerja">instruksi kerja</option>
                                    <option value="manual">manual</option>
                                    <option value="standard">standard</option>
                                    <option value="formulir">formulir</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="" cols="5" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option value="">---</option>
                                    <option value="kategori 1">kategori 1</option>
                                    <option value="kategori 2">kategori 2</option>
                                    <option value="kategori 3">kategori 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Kode</label>
                                <input type="text" name="kode" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">File</label>
                                <input type="file" name="file_dokumen">
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
