@extends('alphanews::layout.layout')

@section('title')
    Edit - {{ $postCategory->name }}
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('alphanews.post-categories.index') }}">Post Categories</a></li>
    <li class="breadcrumb-item active">Edit</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                </div>
                <div class="card-body">
                    @include('alphanews::post-categories._form', [
                        'model' => $postCategory
                    ])
                </div>
            </div>
        </div>
    </div>

@stop
