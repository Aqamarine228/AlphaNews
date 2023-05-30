@extends('alphanews::layout.layout')

@section('title')
    Tag
    <a href="{{ route('tags.create', ['tag_id' => request()->segment(3)]) }}" class="btn btn-sm btn-primary">Create</a>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item active">Tags</li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Posts</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->post_amount }}</td>
                                <td>
                                    <button form="delete-tag-{{ $tag->id }}" class="btn btn-sm btn-danger"
                                            data-ask="1" data-title="Delete tag"
                                            data-message="Are you sure you want to delete the tag - '{{ $tag->name }}'?"
                                            data-type="danger"><i class="fas fa-trash"></i> Delete
                                    </button>

                                    <form id="delete-tag-{{ $tag->id }}" action="{{ route('tags.destroy', $tag->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>

@stop
