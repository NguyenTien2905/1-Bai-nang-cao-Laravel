@extends('layouts.app')

@section('title')
    Đăng ký
@endsection

@section('content')
    <form action="" method="post">
        @csrf
        <div class="container-fluid" style="max-width: 500px">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Tên</label>
                <input type="name" class="form-control" name="name" id="name" placeholder="Nhập tên bạn" />
                @error('name')
                    
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="eamil" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email của bạn"
                    value="{{ old('email') }}" />
                @error('email')
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mặt khẩu " />
                @error('password')
                @enderror
            </div>
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-primary">Dăng ký</button>
            </div>
        </div>
    </form>
@endsection
