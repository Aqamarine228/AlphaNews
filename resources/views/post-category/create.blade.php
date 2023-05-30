@extends('alphanews::layout.layout')

@section('title')
    Create post category
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('post-categories.index') }}">Post Categories</a></li>
    <li class="breadcrumb-item active">Create</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('alphanews::post-category._form', [
                        'model' => new (\Illuminate\Support\Facades\Config::get('alphanews.models.post_category'))
                    ])
                </div>
            </div>
        </div>
    </div>

@stop
