@extends('layouts.app')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <form action="" method="post">
        @csrf
        <div class="container-fluid" style="max-width: 500px">
            
            <div class="mb-3 mt-3">
                <label for="eamil" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email của bạn"
                    value="{{ old('email') }}" />
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mặt khẩu" />
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-success">Đăng nhập</button>
                <div class="d-flex justify-content-center mt-2">
                    <p>Bạn chưa có tài khoản ?</p>
                    <a href="{{ route('register') }}">Tạo tài khoản</a>
                </div>
            </div>
        </div>
    </form>
@endsection
