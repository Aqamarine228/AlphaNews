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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <em class="nav-icon fas fa-newspaper"></em>
                        <p>
                            UI Posts
                            <em class="fas fa-angle-left right"></em>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="{{ route('alphanews.posts.index') }}" class="nav-link">
                                <em class="far fa-circle nav-icon"></em>
                                <p>My Posts</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('alphanews.posts.all') }}" class="nav-link">
                                <em class="far fa-circle nav-icon"></em>
                                <p>All Posts</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" onclick="document.getElementById('post-create').submit()">
                                <em class="far fa-circle nav-icon"></em>
                                <p>Add new</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('alphanews.post-categories.index')}}" class="nav-link">
                                <em class="far fa-circle nav-icon"></em>
                                <p>Post Categories</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('alphanews.tags.index') }}" class="nav-link">
                                <em class="far fa-circle nav-icon"></em>
                                <p>Tags</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item ">
                    <a href="{{ route('alphanews.media-folders.index') }}" class="nav-link ">
                        <em class="nav-icon fas fa-images"></em>
                        <p>
                            Images
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
