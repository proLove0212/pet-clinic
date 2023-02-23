@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('content')

<div class="row">
    <div class="col-sm-6">

        <!-- App Search-->
        <form class="app-search d-lg-block">
            <div class="position-relative">
                <input type="text" id="search" class="form-control" placeholder="Search..." value = "{{$key}}">
                <span class="bx bx-search-alt"></span>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Customers</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($users) != 0)
                                @foreach ($users as $user_item)
                                    <tr>
                                        <td>
                                            <img src="{{url('/assets/images/avatar_m.png')}}" alt="" class="rounded-circle header-profile-user">
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{$user_item->clinic_name}}</a></h5>
                                            <p class="text-muted mb-0">{{$user_item->user_no}}</p>
                                        </td>
                                        <td>{{$user_item->email}}</td>
                                        <td>
                                            {{$user_item->tel_no_new}}
                                        </td>
                                        <td>
                                            {{$user_item->customer_cnt}}
                                        </td>
                                        <td>
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                <li class="list-inline-item px-2">
                                                    <a href="{{url('admin/users/edit/'.$user_item->id)}}" title="Message"><i class="bx bx-edit-alt text-primary"></i></a>
                                                </li>
                                                <li class="list-inline-item px-2">
                                                    <a href="javascript: void(0);" title="Profile"><i class="bx bx-trash-alt text-danger"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-secondary text-center mt-3" style="font-size: 24px"> <span class="bx bx-data"></span> No Data</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if (count($users) != 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination pagination-rounded justify-content-center mt-4">
                                @foreach ($links as $key => $item)
                                    @if (array_search($key, array_keys($links)) == 0)
                                        <li class="page-item {{$item->active ? '' : ''}}">
                                            <a href="{{$item->url}}" class="page-link"><i class="bx bx-chevron-left"></i></a>
                                        </li>
                                    @elseif (array_search($key, array_keys($links)) == count($links) - 1)
                                        <li class="page-item {{$item->active ? '' : ''}}">
                                            <a href="{{$item->url}}" class="page-link"><i class="bx bx-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item {{$item->active ? 'active' : ''}}">
                                            <a href="{{$item->url}}" class="page-link">{{$item->label}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')
    <script type="text/javascript">
        var input = document.getElementById("search");
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                window.location.href = "{{url('/admin/users?key=')}}"+document.getElementById("search").value
            }
        });
    </script>
@endsection
