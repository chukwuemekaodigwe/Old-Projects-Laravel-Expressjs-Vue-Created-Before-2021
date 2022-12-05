@extends('layouts.admin')

@section('content')


<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Registered Students</h1>
    <a href="/dash/students/pending" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-universal-access fa-sm text-white-50"></i> View Prospective</a>
</div>
@include('includes.feedback')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> All Active Students
                    <select name="year" class="" onchange="window.location='/dash/students/all/'+this.value+'/';">

                        
                    <?php 
                                    $now = date('Y', strtotime('today')); 
                                    $last = '2019';
                                    $date = isset($date) ? $date : $now;
                                    ?>
                                    
                                    @for ($i = ($last - 1); $i <= $now; $i++) 
                                    <?php $select = ($i == $date)  ? 'selected' : ''; ?>

                                    <option value="{{ $i }}" {{ ($i == $date)  ? 'selected' : '' }}>
                                        {{ $i }}
                                        </option>
                                        @endfor


                    </select>
                </h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Other Options</div>
                        <a class="dropdown-item" href="/dash/students/add">Register Students</a>
                        <a class="dropdown-item" href="/dash/students/acc_code"> Get Access
                            Code</a>

                    </div>
                </div>

            </div>
            <!-- Card Body -->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> S/No </th>
                                <th> Name</th>
                                <th> Email Address</th>
                                <th>Phone No</th>
                                <th> Exam(s) </th>
                                <th> CBT Access Code </th>
                                <th> Date of Registration </th>

                                <th> Options </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>

                                <th> S/No </th>
                                <th> Name</th>
                                <th> Email Address</th>
                                <th>Phone No</th>
                                <th> Exam(s) </th>
                                <th> CBT Access Code </th>
                                <th> Date of Registration </th>
                                <th> Options </th>
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
                                <td> {{ $quote->access_code }} </td>
                                <td> {{ date('Y-m-d', strtotime($quote->updated_at)) }}
                                </td>

                                <td>
                                    <form method="post" action="/dash/students/upd">
                                        {{ csrf_field()}}
                                        <input type="hidden" name="student_id" value="{{$quote->id}}" />
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6">
                                                <button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm req"
                                                    title="modify" name="req" value="edit"><i class="fas fa-edit"></i> 
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button
                                                    class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm req"
                                                    title="suspend" name="req" value="suspend"><i class="fas fa-trash-alt"></i
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>
                {{ $students->links()}}

            </div>
        </div>
    </div>

    @endsection