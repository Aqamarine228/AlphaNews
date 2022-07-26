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
</body>
</html>
