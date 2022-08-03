@extends('alphanews::layout.layout')

@section('title')
    Post
    <a onclick="document.getElementById('post-create').submit()" class="btn btn-sm btn-primary">Create</a>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item active">Posts</li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title ?? '-' }}</td>
                                <td>{{ $post->category->name ?? '' }}</td>
                                <td>
                                    @if ($post->published_at === null)
                                        <span class="badge badge-warning">Not published</span>
                                    @else
                                        <span class="badge badge-success">Published</span>
                                    @endif
                                </td>
                                <td>
                                    @include('alphanews::posts.blocks._actions')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
