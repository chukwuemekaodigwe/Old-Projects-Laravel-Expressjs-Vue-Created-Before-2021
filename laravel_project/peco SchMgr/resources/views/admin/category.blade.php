@extends('layouts.admin')

@section('content')


<!-- Page Heading -->

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Blog Categories</h1>
    <a href="/dash/categories/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Create New</a>
</div>
@include('includes.feedback')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"> All Active Categories
                  
                </h6>
               
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> S/No </th>
                                <th> Name</th>
                               
                                <th> Description </th>
                                          <th> Options </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>

                            <th> S/No </th>
                                <th> Name</th>
                               
                                <th> Description </th>
                                          <th> Options </th>
                            </tr>

                        </tfoot>
                        <tbody>
                            {{$i = ''}}
                            @foreach($categories as $quote)
                            <tr>
                                <td> {{ ++$i }} </td>
                                <td> {{ ucwords($quote->name) }} </td>
                                <td> {{ $quote->description }} </td>
                               
                                

                                <td>
                                    <form method="post" action="/dash/categories/{{ $quote->id }}">
                                        {{ csrf_field()}}
                                        {{ method_field('delete')}}
                                        <div class="form-group row mb-0">
                                            
                                            <div style="margin: 0 auto;">
                                                <button 
                                                    class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm req"
                                                    title="Delete" name="req" value="suspend"><i class="fas fa-trash-alt"></i
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
                

            </div>
        </div>
    </div>

    @endsection