@extends('layouts.master', ['title' => 'Edit User '. $user->nama])


@section('url-css', 'admin-data-user.css')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5">
            <h2><a href="/admin/data-user/{{ $user->level }}" style="color: white;font-size: 40px;">&larr;</a> Edit Data
                {{ $user->nama }}</h2>
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
                <form action="/admin/edit-user" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="level" value="{{ $user->level }}">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control" value="{{ $user->password }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
