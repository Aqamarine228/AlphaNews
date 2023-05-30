@extends('alphanews::layout.layout')

@section('title')
    Create tag
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('post-tag.store.index') }}">Tags</a></li>
    <li class="breadcrumb-item active">Create</li>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('alphanews::post-tag._form', [
                        'model' => new (\Illuminate\Support\Facades\Config::get('alphanews.models.tag'))
                    ])
                </div>
            </div>
        </div>
    </div>

@stop
