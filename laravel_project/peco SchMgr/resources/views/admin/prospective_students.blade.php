@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Prospective Students</h1>
    <a href="/dash/students/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Register New</a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> Prospective Students</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Other Options</div>
                        <a class="dropdown-item" href="/dash/students/all">Active Students</a>
                        <a class="dropdown-item" href="/dash/students/acc_code"> Get Access Code</a>

                    </div>
                </div>

            </div>
            <!-- Card Body -->
            <div class="card-body">

                <div class="table-responsive">

                    <form method="post" action="/dash/students/upd">
                        {{ csrf_field() }}

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th> S/No </th>
                                    <th> Name</th>
                                    <th> Email Address</th>
                                    <th>Phone No</th>
                                    <th> Requested Exam(s) </th>
                                    <th> Date of Request </th>
                                    <th>
                                        <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                            name="req" value="accept">
                                            Submit
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th> S/No </th>
                                    <th> Name</th>
                                    <th> Email Address</th>
                                    <th>Phone No</th>
                                    <th> Requested Exam(s) </th>
                                    <th> Date of Request </th>
                                    <th>
                                        <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"
                                            name="req" value="accept">
                                            Submit
                                        </button>
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                {{$i = ''}}
                                @foreach($students as $quote)
                                <tr>
                                    <td> {{ ++$i }} </td>
                                    <td> {{ ucwords($quote->name) }} </td>
                                    <td> {{ $quote->email }} </td>
                                    <td> {{ $quote->phone_no }} </td>
                                    <td> {{ $quote->exam }} </td>
                                    <td> {{ date('Y-m-d', strtotime($quote->created_at)) }}</td>
                                    <td>

                                        <div class="confirm-checkbox" style="margin:0 auto!important;">
                                            <input id="{{$quote->id}}" type="checkbox" value="{{$quote->id}}"
                                                name="student_id[]">

                                            <label for="{{$quote->id}}"></label>
                                        </div>


                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>

                    </form>
                </div>

                More Pages..
            </div>
        </div>
    </div>

    @endsection