@extends('alphanews::layout.layout')

@push('styles')
    <style>
        td {
            vertical-align: middle!important;
        }
        .image-url {
            display: none;
        }

        .file-manager .image-preview {
            height: 50px;
            width: 50px;
        }

        .full-height {
            height: calc(100% - 15px);
        }

        .file-manager .dropdown {
            position: absolute;
            top: 0;
            right: 0;
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
                <button data-toggle="modal" data-target="#upload-image-modal" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Upload Image</button>
            </div>
        </div>
        @include('alphanews::media-folders._upload-image-modal')

    @endif
    <div class="row file-manager">
        @if ($rootFolder !== null)
            @component('alphanews::media-folders._preview', [
                'title' => 'Back',
                'link' => route('alphanews.media-folders.index', ['id' => $rootFolder->media_folder_id]),
            ])
                <i class="fa fa-level-up-alt fa-3x"></i>
            @endcomponent
        @endif
        @foreach($subFolders as $folderItem)
            @component('alphanews::media-folders._preview', [
               'title' => $folderItem->name,
               'link' => route('alphanews.media-folders.index', $folderItem->id),
            ])
                <i class="fa fa-folder fa-3x"></i>
            @endcomponent
        @endforeach
        @foreach($images as $image)
            @component('alphanews::media-folders._preview', [
              'title' => $image->name,
              'link' => '#',
            ])
                @slot('adds')
                    <div class="dropdown">
                        <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <p class="image-url" id="p{{ $image->id }}">{{ $image->getFullUrl() }}</p>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a onclick="copyToClipboard(this, '#p{{ $image->id }}')" class="dropdown-item" >Copy Url</a>
                        </div>
                    </div>
                @endslot
                <img class="image-preview" src="{{ $image->getFullUrl() }}">
            @endcomponent
        @endforeach
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <table class="table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th colspan="2">Name</th>--}}
{{--                            <th>Created</th>--}}
{{--                            <th>Updated</th>--}}
{{--                            <th>Type</th>--}}
{{--                            <th colspan="2">Size</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @if ($rootFolder !== null)--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('admin.folders.index', ['id' => $rootFolder->media_folder_id]) }}">--}}
{{--                                        <i class="fa fa-level-up-alt "></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('admin.folders.index', ['id' => $rootFolder->media_folder_id]) }}">--}}
{{--                                        Back--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td colspan="4"></td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
{{--                        @foreach($subFolders as $folderItem)--}}
{{--                            <tr>--}}
{{--                                <td width="50" class="folder">--}}
{{--                                    <a href="{{ route('admin.folders.index', $folderItem->id) }}">--}}
{{--                                        <i class="fa fa-folder"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td class="folder">--}}
{{--                                    <a href="{{ route('admin.folders.index', $folderItem->id) }}">--}}
{{--                                        <span>{{ $folderItem->name }}</span>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $folderItem->created_at }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $folderItem->updated_at }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    Folder--}}
{{--                                </td>--}}
{{--                                <td colspan="2">--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        @foreach($images as $image)--}}
{{--                            <tr>--}}
{{--                                <td width="50" class="image">--}}
{{--                                    <a href="{{ $image->getFullUrl() }}" target="_blank">--}}
{{--                                        <img src="{{ $image->getFullUrl() }}" alt="" width="50">--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $image->name }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $image->created_at }}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    Image--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    {{ $image->size }} KB--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <p class="image-url" id="p{{ $image->id }}">{{ $image->getFullUrl() }}</p>--}}
{{--                                    <button onclick="copyToClipboard(this, '#p{{ $image->id }}')" class="btn btn-sm btn-default copy">--}}
{{--                                        <i class="fa fa-copy"></i>--}}
{{--                                        Copy--}}
{{--                                    </button>--}}
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

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @include('alphanews::media-folders._create-folder-modal')
@stop
