<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ asset('others')}}/{{$shareData['admin_logo'] }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{ url('/')}}"><img src="{{ asset('admin/images/logo2.png') }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ url('/back')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('/back/permission')}}"> <i class="menu-icon fa fa-laptop"></i>Permissions</a>
                </li>
                <li>
                    <a href="{{ url('/back/roles')}}"> <i class="menu-icon fa fa-user"></i>Roles</a>
                </li>
                <li>
                    <a href="{{ url('/back/author')}}"> <i class="menu-icon fa fa-users"></i>Authors</a>
                </li>
                <li>
                    <a href="{{ url('/back/categories')}}"> <i class="menu-icon fa fa-archive"></i>Categories</a>
                </li>
                <li>
                    <a href="{{ url('/back/posts')}}"> <i class="menu-icon fa fa-desktop"></i>Posts</a>
                </li>
                <li>
                    <a href="{{ url('/back/settings')}}"> <i class="menu-icon fa fa-gear"></i>Settings</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
