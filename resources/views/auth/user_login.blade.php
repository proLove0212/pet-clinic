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
              <input type="text" class="form-control" name="name" value="{{old('id')}}" placeholder="IDもしくはメールアドレスと病院の電話番号を入力してください。">
            </div>
            @error('id')
                <div class="msg-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">パスワード</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください。" aria-label="Password" aria-describedby="password-addon">
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
        <form action="{{url('user/request_1')}}" method="post">
            @csrf
            <button class="btn btn-light waves-effect waves-light text-left" type="submit">パスワードがわからない方</button>
        </form>
        <form action="{{url('user/request_2')}}" method="post">
            @csrf
            <button class="btn btn-light waves-effect waves-light text-left" type="submit">IDがわからない方、または両方ともわからない方</button>
        </form>

    </div>
@endsection
