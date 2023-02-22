@extends('layout.auth')

@section('title')
    Login
@endsection

@section('content')

    <form class="form-horizontal" action="{{url('admin/login')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">パスワード</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください。" aria-label="Password" aria-describedby="password-addon">
                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">ログイン</button>
        </div>

    </form>
@endsection
