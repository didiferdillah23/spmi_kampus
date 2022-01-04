@extends('layouts.master', ['title' => 'Login SPMI Kaputama'])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 mt-lg-5">
            <div class="card mt-5 px-3">
                <center class="py-3">
                    <h2 style="font-family: nunito">Login SPMI Kaputama</h2>
                    <hr>
                </center>
                <div class="card-body">
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" style="font-family: montserrat">Username :</label>
                            <input type="text" name="username" class="form-control" id="" placeholder="Masukkan username anda"
                                value="{{ old('username') }}">
                            <!-- <small style="color: red;"><i>{{ session('emailSalah') }}</i></small> -->

                        </div>
                        <div class="form-group">
                            <label for="" style="font-family: montserrat">Password :</label>
                            <input type="password" name="password" class="form-control" id=""
                                placeholder="Masukkan password anda">
                            @error('password')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        <small style="color: red;"><i>{{ session('passwordSalah') }}</i></small>
                        </div>
                        <button style="font-family: nunito" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
