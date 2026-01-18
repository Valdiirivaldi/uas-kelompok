<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky">
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <span data-feather="home"></span> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                    <span data-feather="file-text"></span>  Posts
                </a>
            </li>
        </ul>

        @if(auth()->user()->is_admin)
        <h6 class="sidebar-heading">Administrator</h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
                    <span data-feather="grid"></span> Post Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                    <span data-feather="users"></span> User Management
                </a>
            </li>
        </ul>
        @endif

        <hr class="mx-4 my-4">
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-danger" href="/">
                    <span data-feather="arrow-left"></span> Back to Blog
                </a>
            </li>
        </ul>
    </div>
</nav>