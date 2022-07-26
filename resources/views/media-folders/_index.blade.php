@extends('alphanews::layout.layout')

@push('styles')
    <style>
        td {
            vertical-align: middle !important;
        }

        .image-url {
            display: none;
        }
    </style>
@endpush

@section('title')
    Media
    <a data-toggle="modal" data-target="#create-folder-modal" class="btn btn-sm btn-primary">Create Folder</a>
@stop

@section('breadcrumb')
    <li class="breadcrumb-item active">Media</li>
@stop

@section('content')

    @if ($rootFolder !== null)
        <div class="row mb-2">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#upload-image-modal" class="btn btn-primary btn-sm"><i
                        class="fa fa-upload"></i> Upload Image
                </button>
            </div>
        </div>
        @include('alphanews::media-folders._upload-image-modal')

    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="2">Name</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Type</th>
                            <th colspan="2">Size</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($rootFolder !== null)
                            @permission('folders-read')
                            <tr>
                                <td>
                                    <a href="{{ route('alphanews.media-folders.index', ['id' => $rootFolder->media_folder_id]) }}">
                                        <i class="fa fa-level-up-alt "></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('alphanews.media-folders.index', ['id' => $rootFolder->media_folder_id]) }}">
                                        Back
                                    </a>
                                </td>
                                <td colspan="4"></td>
                            </tr>
                            @endpermission
                        @endif
                        @foreach($subFolders as $folderItem)
                            <tr>
                                @permission('folders-read')
                                <td width="50" class="folder">
                                    <a href="{{ route('alphanews.media-folders.index', $folderItem->id) }}">
                                        <i class="fa fa-folder"></i>
                                    </a>
                                </td>
                                <td class="folder">
                                    <a href="{{ route('alphanews.media-folders.index', $folderItem->id) }}">
                                        <span>{{ $folderItem->name }}</span>
                                    </a>
                                </td>
                                @permission('folders-read')
                                <td>
                                    {{ $folderItem->created_at }}
                                </td>
                                <td>
                                    {{ $folderItem->updated_at }}
                                </td>
                                <td>
                                    Folder
                                </td>
                                <td colspan="2">

                                </td>
                            </tr>
                        @endforeach
                        @foreach($images as $image)
                            <tr>
                                <td width="50" class="image">
                                    <a href="{{ $image->getFullUrl() }}" target="_blank">
                                        <img src="{{ $image->getFullUrl() }}" alt="" width="50">
                                    </a>
                                </td>
                                <td>
                                    {{ $image->name }}
                                </td>
                                <td>
                                    {{ $image->created_at }}
                                </td>
                                <td>
                                    Image
                                </td>
                                <td>
                                    {{ $image->size }} KB
                                </td>
                                <td>
                                    <p class="image-url" id="p{{ $image->id }}">{{ $image->getFullUrl() }}</p>
                                    <button onclick="copyToClipboard(this, '#p{{ $image->id }}')"
                                            class="btn btn-sm btn-default copy">
                                        <i class="fa fa-copy"></i>
                                        Copy
                                    </button>
                                    {{--                                    <form action="{{ route('admin.mediaFolders.updateImage', $image->id) }}" method="POST"--}}
                                    {{--                                          enctype="multipart/form-data" style="display: inline-block;">--}}
                                    {{--                                        @csrf--}}
                                    {{--                                        <input type="hidden" name="media_folder_id" value="{{ $image->media_folder_id }}">--}}
                                    {{--                                        <span class="btn btn-default btn-file btn-sm">--}}
                                    {{--                                            <i class="fa fa-image"></i>--}}
                                    {{--                                            Update <input type="file" name="image" class="update-image"--}}
                                    {{--                                                          data-url="">--}}
                                    {{--                                        </span>--}}
                                    {{--                                    </form>--}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('alphanews::media-folders._create-folder-modal')
@stop
