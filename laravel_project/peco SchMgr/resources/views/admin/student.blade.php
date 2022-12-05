@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Student Details</h1>
    <a href="/dash/students/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Students</a>
</div>

<div class="row">
    <div class="col-md-6" style="margin: 0 auto;">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> Details of {{ucwords($student->name)}} </h6>
            </div>
            <style>
.row{
    border-bottom: 1px solid gray;
    padding: 10px;
}
            </style>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Name: </h5>
                    </div>

                    <div class="col-md-6">
                        <h5> {{ $student->name}} </h5>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Access Code: </h5>
                    </div>

                    <div class="col-md-6 ">
                        <h5> {{ $student->access_code}} </h5>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Email Address: </h5>
                    </div>

                    <div class="col-md-6 ">
                        <h5> {{ $student->email}} </h5>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Phone No: </h5>
                    </div>

                    <div class="col-md-6 ">
                        <h5> {{ $student->phone_no}} </h5>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Registered Exam(s): </h5>
                    </div>

                    <div class="col-md-6 ">
                        <h5> {{ $student->exam}} </h5>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Session </h5>
                    </div>

                    <div class="col-md-6 ">
                        <h5> {{ $student->session}} </h5>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold"> Status </h5>
                    </div>

                    <div class="col-md-6 ">
                        <h5> {{ $student->status}} </h5>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

@endsection