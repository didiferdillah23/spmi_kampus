@extends('layouts.master', ['title' => 'Edit Hasil Kerja | '.session('info_login')->nama])


@section('url-css', 'admin-data-user.css')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5">
            <h2><a href="/unit/submit-hasil/{{ $data->dokumen_mutu->id }}" style="color: white;font-size: 40px;">&larr;</a> Edit Dokumen
                {{ $data->nama }}</h2>
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
            <div class="card p-3">
                <form action="/unit/edit-hasil" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="hidden" name="dokumen_mutu_id" value="{{ $data->dokumen_mutu_id }}">
                    <input type="hidden" name="file_lama" value="{{ $data->nama_file }}">
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" value="{{ $data->keterangan }}">
                    </div>
                    <div class="form-group">
                        <label for="">File</label>
                        <input type="file" name="file_dokumen" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
