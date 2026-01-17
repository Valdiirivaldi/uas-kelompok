<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UAS Blog | Dashboard</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <style>
      /* Sidebar Styling Modern */
      .sidebar {
        background-color: #ffffff;
        min-height: 100vh;
        border-right: 1px solid #dee2e6;
        padding-top: 20px;
      }

      .nav-link {
        font-weight: 500;
        color: #6c757d;
        padding: 10px 20px;
        border-radius: 8px;
        margin: 4px 15px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .nav-link:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
      }

      .nav-link.active {
        background-color: #e7f1ff !important;
        color: #0d6efd !important;
      }

      .nav-link svg {
        width: 18px;
        height: 18px;
      }

      .sidebar-heading {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
        color: #adb5bd;
        padding: 15px 35px 5px;
      }

      /* Content Area */
      main {
        background-color: #fdfdfd;
      }

      /* Trix Editor Fix */
      trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
    </style>
  </head>
  <body>

    @include('dashboard.layouts.header')

    <div class="container-fluid">
      <div class="row">
        @include('dashboard.layouts.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
          <div class="card shadow-sm border-0 p-4" style="border-radius: 15px; min-height: 80vh;">
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
    </script>
  </body>
</html>