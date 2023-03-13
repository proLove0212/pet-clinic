@extends('layout.auth')

@section('title')

@endsection

@section('content')

    <div class="w-full p-5">
        <div
        class="mb-4 rounded-lg bg-success-100 py-5 px-6 text-base text-success-700"
        role="alert">
        <h4 class="mb-2 text-2xl font-medium leading-tight text-success-700">{{$title}}</h4>
        <p class="mb-4">
            {{$content}}
        </p>
        <hr class="border-success-600 opacity-30" />
        <p class="mt-4 mb-0 text-right">
            From PetClinic
        </p>
        </div>
    </div>
@endsection
