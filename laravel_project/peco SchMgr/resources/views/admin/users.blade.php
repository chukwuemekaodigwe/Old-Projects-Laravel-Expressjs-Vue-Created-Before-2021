@extends('layouts.admin')

@section('content')

<!-- Page Heading -->

    <h1 class="h3 mb-1 text-gray-800"> Manage Users</h1>

    
          <p class="mb-4">These persons were granted access to this system. They are employees of the institution</p>


@include('includes.feedback')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> System Users
                </h6>
                <a href="/dash/users/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float:right"><i
            class="fas fa-plus fa-sm text-white-50"></i>  Add</a>


            </div>
            <!-- Card Body -->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> S/No </th>
                                <th> Name</th>
                                <th> Username</th>

                                <th> Type of User </th>
                                <th> Options </th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th> S/No </th>
                                <th> Name</th>
                                <th> Username</th>

                                <th> Type of User </th>
                                <th> Options </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            {{$i = ''}}
                            @foreach($users as $quote)
                            <tr>
                                <td> {{ ++$i }} </td>
                                <td> {{ ucwords($quote->name) }} </td>
                                <td> {{ $quote->email }} </td>

                                <td> {{ $quote->ulevel }}
                                </td>
                                <td>
                                    <form action="{{url('/dash/users/'.$quote->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete')}}

                                        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" title="update"
                                            name="req" type="button" onclick="return window.location='/dash/users/{{$quote->id}}/edit';"><i class="fas fa-edit"> </i>
                                        </button>


                                        <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" type="submit" title="remove"
                                            name="req"><i class="fas fa-trash-alt"> </i>
                                        </button>

                                    </form>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection