<nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top" style="background-color: #0f172a; padding-top: 12px; padding-bottom: 12px;">
  <div class="container">
    
    {{-- 1. BRAND LOGO (Diberi margin kanan 'me-5' agar berjarak dengan menu) --}}
    <a class="navbar-brand fw-bold fs-4 me-5" href="/">
        <i class="bi bi-robot me-2"></i>UAS Blog
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      
      {{-- 2. MENU UTAMA (Kiri) --}}
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link px-3 {{ ($active ?? '') === 'home' ? 'active fw-semibold' : '' }}" href="/">
            <i class="bi bi-house-door-fill me-1"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ ($active ?? '') === 'about' ? 'active fw-semibold' : '' }}" href="/about">
            <i class="bi bi-info-circle-fill me-1"></i> About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ ($active ?? '') === 'posts' ? 'active fw-semibold' : '' }}" href="/posts">
            <i class="bi bi-newspaper me-1"></i> Blog
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ ($active ?? '') === 'categories' ? 'active fw-semibold' : '' }}" href="/categories">
            <i class="bi bi-grid-fill me-1"></i> Categories
          </a>
        </li>
      </ul>

      {{-- 3. MENU USER (Kanan) --}}
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{-- Avatar Placeholder --}}
              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 0.9rem;">
                 {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
              </div>
              <span>Hi, {{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 animate-slide">
              <li>
                  <a class="dropdown-item py-2" href="/dashboard">
                    <i class="bi bi-speedometer2 me-2"></i> My Dashboard
                  </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item py-2 text-danger fw-medium">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a href="/login" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </a>
          </li>
        @endauth
      </ul>
      
    </div>
  </div>
</nav>

{{-- CSS Tambahan untuk Efek Hover Garis Bawah --}}
<style>
    /* Efek Hover Menu */
    .navbar-nav .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }
    
    /* Garis bawah animasi saat hover */
    @media (min-width: 992px) {
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #3b82f6; /* Warna garis biru muda */
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 80%;
        }
    }

    /* Dropdown Animation */
    .dropdown-menu.animate-slide {
        display: block;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.2s ease;
    }
    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
</style>