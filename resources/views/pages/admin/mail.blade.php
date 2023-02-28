@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')
<link href="{{url('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="me-2">
                    <h5 class="card-title mb-4">メール作成</h5>
                </div>

                <div class="mb-3">
                    <select class="select2 form-control select2-multiple"
                        multiple="multiple">
                        @foreach ($users as $user)
                            <option value="{{$user->email}}">{{$user->ClinicName}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Subject">
                </div>
                <div class="mb-3">
                    <form method="post">
                        <textarea id="email-editor" name="area"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')

<!--tinymce js-->
<script src="{{url('assets/libs/tinymce/tinymce.min.js')}}"></script>

<!-- email editor init -->
<script src="{{url('assets/js/pages/email-editor.init.js')}}"></script>
<script src="{{url('assets/libs/select2/js/select2.min.js')}}"></script>

<script>
    $( document ).ready(function() {
        $(".select2").select2()
    });
</script>
@endsection
