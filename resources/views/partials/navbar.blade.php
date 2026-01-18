<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top" style="background-color: #0f172a; padding-top: 15px; padding-bottom: 15px; backdrop-filter: blur(10px); background: rgba(15, 23, 42, 0.95);">
  <div class="container">
    
    {{-- 1. BRAND LOGO --}}
    <a class="navbar-brand fw-bold fs-4 me-5 d-flex align-items-center" href="/">
        <div class="bg-primary rounded-3 d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
            <i class="fa-solid fa-robot text-white fs-5"></i>
        </div>
        <span style="letter-spacing: -0.5px;">UAS<span class="text-primary">Blog</span></span>
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars-staggered text-white"></i>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      
      {{-- 2. MENU UTAMA (Kiri) --}}
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link px-3 d-inline-flex align-items-center {{ ($active ?? '') === 'home' ? 'active fw-semibold' : '' }}" href="/">
            <i class="fa-solid fa-house me-2"></i> 
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 d-inline-flex align-items-center {{ ($active ?? '') === 'about' ? 'active fw-semibold' : '' }}" href="/about">
            <i class="fa-solid fa-circle-info me-2"></i> 
            <span>About</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 d-inline-flex align-items-center {{ ($active ?? '') === 'posts' ? 'active fw-semibold' : '' }}" href="/posts">
            <i class="fa-solid fa-newspaper me-2"></i> 
            <span>Blog</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 d-inline-flex align-items-center {{ ($active ?? '') === 'categories' ? 'active fw-semibold' : '' }}" href="/categories">
            <i class="fa-solid fa-layer-group me-2"></i> 
            <span>Categories</span>
          </a>
        </li>
      </ul>

      {{-- 3. MENU USER (Kanan) --}}
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active d-flex align-items-center gap-3 ps-3 pe-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="avatar-wrapper rounded-circle p-1" style="background: linear-gradient(45deg, #3b82f6, #6366f1);">
                  <div class="rounded-circle overflow-hidden bg-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    @if(auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="profile" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random&color=fff" style="width: 100%; height: 100%; object-fit: cover;">
                    @endif
                  </div>
              </div>
              <span class="d-none d-sm-inline fw-medium">Hi, {{ strtok(auth()->user()->name, " ") }}</span>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-2 mt-3 animate-slide" style="border-radius: 15px; min-width: 220px;">
              <li>
                  <a class="dropdown-item rounded-3 py-2 d-flex align-items-center" href="/dashboard">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-2 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <div>
                        <span class="d-block fw-bold" style="font-size: 14px;">My Dashboard</span>
                        <small class="text-muted" style="font-size: 11px;">Manage content</small>
                    </div>
                  </a>
              </li>
              <li>
                  <a class="dropdown-item rounded-3 py-2 d-flex align-items-center mt-1" href="/dashboard/profile">
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-2 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <div>
                        <span class="d-block fw-bold" style="font-size: 14px;">My Profile</span>
                        <small class="text-muted" style="font-size: 11px;">Settings</small>
                    </div>
                  </a>
              </li>
              <li><hr class="dropdown-divider opacity-50 my-2"></li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item rounded-3 py-2 text-danger fw-bold border-0 bg-transparent w-100 text-start d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-2 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fa-solid fa-power-off"></i>
                    </div>
                    Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a href="/login" class="btn btn-primary px-4 py-2 rounded-pill fw-bold shadow d-flex align-items-center gap-2" style="background: linear-gradient(45deg, #3b82f6, #2563eb); border: none;">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
            </a>
          </li>
        @endauth
      </ul>
      
    </div>
  </div>
</nav>

{{-- CSS Tambahan --}}
<style>
    nav {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Memaksa Link Navigasi berada di tengah vertikal */
    .navbar-nav .nav-link {
        display: inline-flex !important;
        align-items: center; 
        justify-content: center;
        color: rgba(255,255,255,0.7) !important;
        transition: all 0.3s ease;
        position: relative;
        padding-top: 8px;
        padding-bottom: 8px;
    }
    
    /* Penyelarasan Ikon */
    .navbar-nav .nav-link i {
        font-size: 0.9rem;
        line-height: 1;
        display: flex;
        align-items: center;
        margin-top: 1px; /* Koreksi optik agar sejajar teks */
    }

    .navbar-nav .nav-link:hover, 
    .navbar-nav .nav-link.active {
        color: #ffffff !important;
    }

    /* Garis Bawah yang sejajar dengan Container Navigasi */
    @media (min-width: 992px) {
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px; 
            left: 50%;
            background-color: #3b82f6;
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 10px;
        }
        
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 60%;
        }
    }

    /* Dropdown Animation */
    .dropdown-menu.animate-slide {
        display: block !important;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: all 0.2s ease-in-out;
    }
    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
</style>