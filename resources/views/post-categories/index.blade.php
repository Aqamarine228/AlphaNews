@extends('alphanews::layout.layout')

@section('title')
    Post Categories
    {{--    @if ($authUser->isAbleTo('news_create'))--}}
    <a href="{{ route('alphanews.post-categories.create', ['category_id' => request()->segment(3)]) }}"
       class="btn btn-sm btn-primary">Create</a>
    {{--    @endif--}}
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('alphanews.post-categories.index') }}">Root Categories</a></li>
    @if ($rootCategory->id)
        <li class="breadcrumb-item"><a
                href="{{ route('alphanews.post-categories.index', $rootCategory->parent_category_id) }}">{{ $rootCategory->name }}</a>
        </li>
    @endif
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Preview</th>
                            <th>News count</th>
                            <th>Nested categories</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>{{ $category->color }}</td>
                                <td>
                                    <span class="badge badge-default"
                                          style="background: {{ $category->color }}; color: white">{{ $category->name }}</span>
                                </td>
                                <td>
                                    {{ $category->posts_count }}
                                </td>
                                <td>
                                    <a href="{{ route('alphanews.post-categories.index', $category->id) }}"><i
                                            class="fas fa-project-diagram"></i> {{ $category->child_categories_count }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('alphanews.post-categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Edit</a>

                                    @if ($category->posts_count === 0)
                                        <button form="delete-category-{{ $category->id }}" class="btn btn-sm btn-danger"
                                                data-ask="1" data-title="Delete category"
                                                data-message="Are you sure you want to delete the category - '{{ $category->name }}'?"
                                                data-type="danger"><i class="fas fa-trash"></i> Delete
                                        </button>
                                        <form id="delete-category-{{ $category->id }}"
                                              action="{{ route('alphanews.post-categories.destroy', $category->id) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </td>
{{--                                <td>--}}
{{--                                    <a class="" href="{{ route('alphanews.posts.index', ['category' => $category->id]) }}">Show--}}
{{--                                        all posts</a>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $categories->render() }}
                </div>
            </div>
        </div>
    </div>

@stop
