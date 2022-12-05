
@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Add new Quote </h1>
        <a href="/dash/quotes/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Recent Quotes</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('New Daily Quote') }}</div>

                <div class="card-body">
                    <form method="POST" action="{!! url('dash/quotes/add') !!}">
                        @csrf
                        @include('includes.form', ['item'=>'title', 'big'=>'quote', 'id'=>'editor'])
                        
                        @include('includes.form',['item'=>'author'])

                        <div class="col-md-4 col-md-offset-8" style="display: flex; flex-direction: row; justify-content: center">

                        @include('includes.form', ['button' => 'publish', 'class' => 'primary'])
</div>
                    </form>

                </div>

            </div>
        </div>
    </div>


</div>
@endsection