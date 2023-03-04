@extends('layout.auth')

@section('title')
    Forgot ID&Password
@endsection


@section('content')

    <form class="form-horizontal" action="{{url('/password_reset_requests/all')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">パスワード再設定</label>
            <div class="input-group auth-pass-inputgroup">
              <input type="text" class="form-control" name="email" value="{{old('email')}}"  >
            </div>
            @error('email')
                <div class="msg-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">パスワード再設定メールを送信する</button>
        </div>

    </form>
    <div class="mb-3">
        <ul>
            <li>ご登録いただいたメールアドレスを入力してください。</li>
            <li>メールアドレス宛にパスワード変更ページのURLが記載されたメールを送信します。</li>
        </ul>
    </div>
@endsection
