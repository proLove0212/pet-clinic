@extends('layout.auth')

@section('title')
    Login
@endsection

@section('content')

    <form class="form-horizontal" action="{{url('user/login')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">ID</label>
            <div class="input-group auth-pass-inputgroup">
              <input type="text" class="form-control" name="id" value="{{old('id')}}"  >
            </div>
            @error('id')
                <div class="msg-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">パスワード</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" name="password" class="form-control" aria-describedby="password-addon">
                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
            @error('password')
                <div class="msg-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">ログイン</button>
        </div>
    </form>

    <div class="mt-5 d-grid">
        <a href="{{url('password_reset_requests/new')}}" class="mb-3" >パスワードがわからない方</a>
        <a href="{{url('password_reset_requests/all')}}" class="mb-3">IDがわからない方、または両方ともわからない方</a>
    </div>
@endsection
