<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UAS Blog | Dashboard</title>

    {{-- Script Pencegah Flash Putih --}}
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
        background-color: var(--bs-body-bg); /* Mengikuti tema */
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

      /* Trix Editor Fix agar teks terlihat di mode gelap */
      trix-editor {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
      }
      trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
    </style>
  </head>
  <body>

    @include('dashboard.layouts.header')

    <div class="container-fluid">
      <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
          {{-- Pastikan tombol toggle ada di header atau bisa ditambah di sini sementara --}}
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

        // Fungsi bantu untuk update UI jika tombol ganti tema diklik di header
        function syncTheme() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            // Tambahkan logika tambahan di sini jika dashboard butuh perubahan manual
        }
    </script>
  </body>
</html>