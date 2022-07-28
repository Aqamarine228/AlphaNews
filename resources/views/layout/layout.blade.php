<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('vendor/alphanews/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/alphanews/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('alphanews::layout._navbar')

    @include('alphanews::layout._aside')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active">Blank Page</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            @include('alphanews::layout._alerts')
           @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <strong>Version</strong> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>

<script src="{{asset('vendor/alphanews/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/alphanews/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/alphanews/js/adminlte.min.js')}}"></script>
<script>
    $(document).ready(function() {
        //option A
        $("button[data-ask=1]").click(function(e, params){
            var localParams = params || {};
            if (!localParams.send) {
                e.preventDefault();
            }
            var button = this;
            let type = $(button).data('type') ? $(this).data('type') : 'warning';

            Swal.fire({
                title: $(button).data('title'),
                text: $(button).data('message'),
                type: type,
                input: $(this).data('input') ? $(this).data('input') : false,
                showCancelButton: true,
                confirmButtonColor: "#1e88e5",
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                // closeOnConfirm: false,
                // closeOnCancel: false,
                showLoaderOnConfirm: true,
                preConfirm: function (amount) {
                    if (amount && $(button).data('form-id')) {
                        let formId = $(button).data('form-id');
                        let inputName = $(button).data('input-name');
                        $('#' + formId + ' input[name = ' + inputName + ']').val(amount);
                    }
                    $(button).trigger('click', {send: true});
                },
                // allowOutsideClick: () => !swal.isLoading()
            });
        });
    });

    function initTinymce(selector, height, newsId, toolbar, plugins) {
        tinymce.init({
            setup: function (editor) {
                editor.on('init', function (args) {
                    editor_id = args.target.id;
                });
            },
            selector: selector,
            theme: "modern",
            height: height,
            style_formats: [
                {
                    title: 'Headers',
                    items: [
                        {title: 'Header 1', format: 'h1'},
                        {title: 'Header 2', format: 'h2'},
                        {title: 'Header 3', format: 'h3'},
                        {title: 'Header 4', format: 'h4'},
                        {title: 'Header 5', format: 'h5'},
                        {title: 'Header 6', format: 'h6'}
                    ]
                },
                {title: 'Highlight', inline: 'span', classes: 'highlight'},
            ],
            fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route('alphanews.media-folders.images.store-from-tinymce') }}');

                xhr.onload = function() {
                    if (xhr.status < 200 || xhr.status >= 300) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    var json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob());
                formData.append('news_id', newsId);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                xhr.send(formData);
            },
            plugins: plugins,
            images_upload_url: '{{ route('alphanews.media-folders.images.store-from-tinymce') }}',
            // TODO: fix media url
            images_upload_base_path: '{{ config('images.media.url') }}',
            images_upload_credentials: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            toolbar: toolbar,
        });

        tinymce.PluginManager.add('charactercount', function (editor) {
            var _self = this;

            function update() {
                editor.theme.panel.find('#charactercount').text(['{0} Characters', _self.getCount()]);
            }

            editor.on('init', function () {
                var statusbar = editor.theme.panel && editor.theme.panel.find('#statusbar')[0];

                if (statusbar) {
                    window.setTimeout(function () {
                        statusbar.insert({
                            type: 'label',
                            name: 'charactercount',
                            text: ['{0} CHARACTERS', _self.getCount()],
                            classes: 'charactercount',
                            disabled: editor.settings.readonly
                        }, 0);

                        editor.on('setcontent beforeaddundo keyup', update);
                    }, 0);
                }
            });

            _self.getCount = function () {
                // var tx = editor.getContent({ format: 'raw' });
                // var decoded = decodeHtml(tx);
                // var decodedStripped = decoded.replace(/(<([^>]+)>)/ig, '');
                //
                // var tc = decodedStripped.length;
                // return tc;
                var tx = editor.getContent({ format: 'raw' });
                var decodedStripped = tx.replace(/(<([^>]+)>)/ig, '');
                var decoded = decodeHtml(decodedStripped);

                var tc = decoded.length;
                return tc;
            };

            function decodeHtml(html) {
                var txt = document.createElement('textarea');
                txt.innerHTML = html;
                return txt.value;
            }
        });
    }

    function copyToClipboard(target, element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        let oldName = $(target).text();
        $(target).text('Copied!');

        setTimeout(function () {
            $(target).text(oldName);
        }, 1000);
    }
</script>
@stack('scripts')
</body>
</html>
