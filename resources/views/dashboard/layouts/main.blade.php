<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UAS Blog | Dashboard</title>

    {{-- Script Pencegah Flash Putih (Penting: Harus di atas) --}}
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <style>
      /* Sidebar Styling Modern */
      .sidebar {
        min-height: 100vh;
        border-right: 1px solid var(--bs-border-color);
        padding-top: 20px;
        background-color: var(--bs-body-bg);
      }

      .nav-link {
        font-weight: 500;
        color: var(--bs-secondary-color);
        padding: 10px 20px;
        border-radius: 8px;
        margin: 4px 15px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .nav-link:hover {
        background-color: var(--bs-tertiary-bg);
        color: var(--bs-primary);
      }

      .nav-link.active {
        background-color: var(--bs-primary-border-subtle) !important;
        color: var(--bs-primary) !important;
      }

      .sidebar-heading {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        color: var(--bs-secondary-text-emphasis);
        padding: 15px 35px 5px;
      }

      /* Content Area */
      main {
        background-color: var(--bs-tertiary-bg);
        transition: background-color 0.3s ease;
      }

      .dashboard-card {
        border-radius: 15px; 
        min-height: 80vh;
        background-color: var(--bs-body-bg);
      }

      /* Trix Editor Dark Mode Fix */
      trix-editor {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
      }
      trix-toolbar [data-trix-button-group="file-tools"] { display: none; }

      /* Animasi Ikon */
      #themeToggle { text-decoration: none; }
      #themeIcon { transition: transform 0.4s ease; }
      #themeToggle:hover #themeIcon { transform: rotate(20deg); }
    </style>
  </head>
  <body>

    @include('dashboard.layouts.header')

    <div class="container-fluid">
      <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
          <div class="dashboard-card card shadow-sm border-0 p-4">
            @yield('container')
          </div>
        </main>
      </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    
    <script>
        feather.replace();

        // LOGIKA DARK MODE
        const btn = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        const html = document.documentElement;

        // Fungsi Update Ikon
        function updateIcon(theme) {
            if (theme === 'dark') {
                icon.classList.replace('fa-moon', 'fa-sun');
                icon.style.color = '#ffca28'; // Kuning Matahari
            } else {
                icon.classList.replace('fa-sun', 'fa-moon');
                icon.style.color = ''; 
            }
        }

        // Klik Tombol
        if(btn) {
            btn.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateIcon(newTheme);
            });
        }

        // Jalankan saat load untuk set ikon yang benar
        updateIcon(html.getAttribute('data-bs-theme'));
    </script>
  </body>
</html>