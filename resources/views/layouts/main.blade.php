<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ $title ?? 'Blog Uas' }}</title>

    {{-- Script Pencegah 'Flash' Putih (Harus di atas) --}}
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

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Google Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- My Style --}}
    <link rel="stylesheet" href="/css/style.css">

    <style>
        /* Transisi halus saat ganti tema */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .nav-link { cursor: pointer; }
    </style>
</head>
<body>
    
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Tombol Dark Mode (Jika tidak ingin ditaruh di dalam file navbar.blade.php) --}}
    <div class="container d-flex justify-content-end mt-3">
        <button class="btn btn-outline-secondary btn-sm" id="themeToggle">
            <i class="fa-solid fa-moon" id="themeIcon"></i>
        </button>
    </div>

    <div class="container mt-4">
        @yield('container')
    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script Logika Tombol --}}
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const htmlElement = document.documentElement;

        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        }

        // Inisialisasi ikon saat halaman dimuat
        updateIcon(htmlElement.getAttribute('data-bs-theme'));
    </script>
</body>
</html>