
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">UAS BLOG</a>
  
  {{-- Tambahkan Tombol ini di sini --}}
  <div class="navbar-nav">
    <div class="nav-item text-nowrap px-3">
      <button class="btn btn-outline-light btn-sm me-2" id="themeToggle">
        <i class="fa-solid fa-moon" id="themeIcon"></i>
      </button>
      <form action="/logout" method="post" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-dark border-0">Logout <span data-feather="log-out"></span></button>
      </form>
    </div>
  </div>
</header>