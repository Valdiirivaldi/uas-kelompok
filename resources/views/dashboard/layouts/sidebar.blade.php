<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">UAS Blog</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            
            {{-- Menu Utama Dashboard --}}
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                        <span data-feather="home"></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    {{-- Tanda bintang (*) agar sub-menu (create/edit) tetap dianggap active --}}
                    <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                        <span data-feather="file-text"></span>
                        My Posts
                    </a>
                </li>
            </ul>

            {{-- PEMBATAS (Separator) --}}
            <hr class="my-3">

            {{-- TOMBOL KEMBALI KE BLOG --}}
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 text-secondary" href="/">
                        <span data-feather="layout"></span>
                        Back to Blog
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>