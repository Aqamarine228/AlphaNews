<aside class="main-sidebar sidebar-light-primary elevation-3">
    <a href="#" class="brand-link">
        <img src="{{asset('vendor/alphanews/img/logo.jpg')}}" alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AlphaNews</span>
    </a>

    <div class="sidebar">

        <nav class="mt-2" aria-label="Aside navigation">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('alphanews.dashboard')}}" class="nav-link">
                        <em class="nav-icon fas fa-tachometer-alt"></em>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>
            </ul>
        </nav>
    </div>
</aside>
