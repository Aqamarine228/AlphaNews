@extends('alphanews::layout.layout')

@section('title')
    Edit post
@stop

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('alphanews.posts.index') }}">Posts</a></li>
    <li class="breadcrumb-item active">Edit</li>
@stop

@push('styles')
    <link rel="stylesheet" href="{{asset('vendor/alphanews/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/alphanews/plugins/croppie/css/croppie.css')}}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        Edit Content
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#full-content" data-toggle="tab">Full Content</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#preview" data-toggle="tab">Preview</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="full-content">
                            @include('alphanews::posts.blocks._content-form')
                        </div>
                        <div class="chart tab-pane" id="preview">
                            @include('alphanews::posts.blocks._short-content-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('alphanews::posts.blocks._status')
            @include('alphanews::posts.blocks._publish')
            @include('alphanews::posts.blocks._add-to-top')
            @include('alphanews::posts.blocks._category')
            @include('alphanews::posts.blocks._media-type')
            @include('alphanews::posts.blocks._tags')
            @include('alphanews::posts.blocks._image')
        </div>
    </div>
    @include('alphanews::posts.blocks._crop-image-modal')
@stop

@push('scripts')
    <script src="{{asset('vendor/alphanews/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        let contentPlugins = [
            "textcolor colorpicker advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor charactercount autosave preview code"
        ];
        let contentToolbar = "fontsizeselect | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons| code preview twitter_url | instagram";
        initTinymce('#content', '300', {{ $post->id }}, contentToolbar, contentPlugins);
    </script>
    <script>
        let plugins = [
            "textcolor colorpicker advlist autolink link lists charmap preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor charactercount"
        ];
        let toolbar = "styleselect | insertfile undo redo | bold italic preview media fullpage | forecolor backcolor ";
        initTinymce('#short_content', '200', {{ $post->id }}, toolbar, plugins);
    </script>
    <script src="{{asset('vendor/alphanews/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        $('#post_category_id').select2({height: 300});
        $('#media_type').select2();
        $('.select2-selection').css('height', '40px');
    </script>
    <script>
        @php
            $tags = \Illuminate\Support\Facades\Config::get('alphanews.models.tag')::select(['id', 'name'])->when(request()->get('q'), function ($query, $search) {$query->where('name', 'like', '%' . $search . '%');})->limit(5)->get();
        @endphp
        const tags = @json($tags, JSON_THROW_ON_ERROR);
        let results = tags.map((item) => {
            return {
                id: item.name,
                text: item.name
            }
        });
        $('#tags').select2({
            data: results,
            tokenSeparators: [","],
            multiple: true,
        });
    </script>
    <script src="{{asset('vendor/alphanews/plugins/croppie/js/croppie.min.js')}}"></script>
    <script>

        let App = {
            fileId: '#picture',
            modalId: '#post-crop-image-modal',

            init: function () {
                this.listenForInputChange();
                this.listenForModalShow();
            },

            listenForModalShow: function () {
                $(this.modalId).on('shown.bs.modal', function (event) {
                    App.initCroppie()
                })
            },

            listenForInputChange: function () {
                $(this.fileId).change(function (e) {
                    var files = e.target.files || e.dataTransfer.files;
                    var file = files[0];
                    App.readImage(file);

                    $(App.modalId).modal();
                });
            },

            readImage: function (file) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    $(App.modalId + ' img').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            },

            initCroppie: function () {
                var cropBoxData;
                var canvasData;
                var cropper;
                var image = document.getElementById('photo_upload');

                image.addEventListener('crop', (event) => {
                    let detail = event.detail;
                    document.getElementById('x1').value = parseInt(detail.x);
                    document.getElementById('y1').value = parseInt(detail.y);
                    document.getElementById('width').value = parseInt(detail.width);
                    document.getElementById('height').value = parseInt(detail.height);

                });
                cropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
                    autoCropArea: 0.5,
                    viewMode: 1,
                    ready: function () {
                        cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                    },
                });
            }
        }

        App.init();
    </script>
@endpush
