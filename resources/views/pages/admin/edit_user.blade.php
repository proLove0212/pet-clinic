@extends('layout.main')

@section('title')
    {{$title}}
@endsection


@section('content')
<div class="container mt-3">
    <form action="/admin/users/edit/{{$user->id}}" method="POST">
        @csrf
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label">ユーザー番号</label>
            <div class="col-sm-9">
              <input type="text range" name="user_no" class="form-control" value="{{$user->user_no}}" placeholder="Eピークス内のユーザー番号 (000000)">

                @error('user_no')
                    <div class="msg-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label">病院名</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" value="{{$user->clinic_name}}" placeholder="病院の名前を入力してください。">
              @error('name')
                  <div class="msg-danger">{{ $message }}</div>
              @enderror
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label">電話番号</label>
            <div class="col-sm-9">
              <input type="text" name="phone" class="form-control" value="{{$user->tel_no_new}}" placeholder="ハイフンあり">
              @error('phone')
                  <div class="msg-danger">{{ $message }}</div>
              @enderror
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label">メール</label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="メールアドレスを入力。">
                @error('email')
                    <div class="msg-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                更新
            </button>
            <a href="{{url('admin/users/add')}}" class="btn btn-secondary waves-effect">
                キャンセル
            </a>
        </div>
    </form>
</div>
@endsection

