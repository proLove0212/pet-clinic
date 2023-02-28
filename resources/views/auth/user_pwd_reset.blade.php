@extends('layout.auth')

@section('title')
    Reset
@endsection

@section('content')

    <form class="form-horizontal" action="{{url('user/pwd_reset')}}" method="POST">
        @csrf

        <div class="mb-3">
            <p> <span class="card-title"> 病院ID :</span> {{$ClinicID}}</p>
        </div>
        <div class="mb-3">
            <label class="form-label">パスワード</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" name="password" class="form-control" >
            </div>
            @error('password')
                <div class="msg-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">パスワード確認用</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" name="password_confirmdation" class="form-control" >
            </div>
            @error('password_confirmdation')
                <div class="msg-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">設定</button>
        </div>

        <div class="mb-3">
            <ul>
                <li>Web顧客検索サービスを始めて利用する場合はパスワードを設定してください。</li>
                <li>パスワードはアルファベット(大文字小文字)、数字、記号(!#$%&[]+-/*\?)を使い8文字以上で設定してください。</li>
            </ul>
        </div>
    </form>

@endsection
