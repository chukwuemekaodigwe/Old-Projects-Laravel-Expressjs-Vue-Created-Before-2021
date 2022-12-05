@extends('layouts.admin')


@section('content')
<style>
.shadow {
    box-shadow: 0rem 2rem 1.75rem 0 rgba(58, 59, 69, .15) !important;
    cursor: pointer;

}
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4 col-md-12">
    <h1 class="h3 mb-0 text-gray-800"> Dashboard </h1>
</div>

<div class="col-md-12 d-sm-flex align-items-center justify-content-around">

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around" onclick="return window.location='/dash/students/add';">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa fa-user-plus fa-2x"></i>
                Register Student
            </h4>

          
        </div>
        <!-- Card Body -->

    </div>

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around" onclick="return window.location='/dash/students/pending';">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-credit-card fa-2x"></i> Confirm Payment
                </h6>

                <h4 class="text-right badge badge-danger badge-counter">
                    {{count($new_student)}}
                    </h6>
        </div>
        <!-- Card Body -->

    </div>

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around" onclick="return window.location='/dash/quotes/add';">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit fa-2x"></i> Add Quote </h6>

        </div>
        <!-- Card Body -->

    </div>

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around" onclick="return window.location='/dash/blogs/add';">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit fa-2x"></i> Create Post Blog </h6>

                
        </div>
        <!-- Card Body -->

    </div>


</div>


<div class="col-md-12 d-sm-flex align-items-center justify-content-around">

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fa fa-university fa-2x"></i>
                Prospective Students
            </h4>

            <h6 class="text-right badge badge-danger badge-counter">
                {{count($new_student)}}
            </h6>
        </div>
        <!-- Card Body -->

    </div>

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-graduation-cap fa-2x"></i> Active Students
                </h6>

                <h4 class="text-right badge badge-danger badge-counter">
                    {{count($students)}}
                    </h6>
        </div>
        <!-- Card Body -->

    </div>

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit fa-2x"></i> Unpublished Blogs </h6>

                <h4 class="text-right badge badge-danger badge-counter">
                    {{count($drafts)}}
                    </h6>
        </div>
        <!-- Card Body -->

    </div>

    <div class="card shadow mb-4 col-md-2" style="display: inline-block;">
        <!-- Card Header - Dropdown -->
        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-around">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cloud fa-2x"></i> Active Blog </h6>

                <h4 class="text-right badge badge-danger badge-counter">
                    {{count($blogs)}}
                    </h6>
        </div>
        <!-- Card Body -->

    </div>


</div>

@endsection