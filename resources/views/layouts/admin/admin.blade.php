<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 260px;
            background-color: #212529;
            color: white;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 0px;
        }

        .content {
            flex-grow: 1;
            background: #f8f9fa;
            overflow-y: auto;
        }

        .header {
            background: white;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
        }

        .nav-link {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .nav-link:hover {
            color: #fff;
            background-color: #343a40;
        }

        .submenu a {
            font-size: 0.9rem;
            padding-left: 2.5rem;
        }
    </style>
</head>
<body>

    {{-- Include Sidebar --}}
    @include('layouts.admin.partials.sidebar', ['sidebars' => \App\Models\Sidebar::with('children.children')->whereNull('parent_id')->get()])

    <div class="content">
        {{-- Include Header --}}
        @include('layouts.admin.partials.header')

        {{-- Page Content --}}
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap (if not already included) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

<!-- Your custom JS -->
<script src="{{ asset('assets/js/admin-summernote.js') }}"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
            });
        }

        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.querySelector('input[name="title"]');
            const slugInput = document.querySelector('input[name="slug"]');

            titleInput.addEventListener('input', function() {
                let slug = this.value.toLowerCase()
                    .trim()
                    .replace(/[\s]+/g, '-')        // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')      // Remove all non-word chars
                    .replace(/\-\-+/g, '-')        // Replace multiple - with single -
                    .replace(/^-+/, '')            // Trim - from start
                    .replace(/-+$/, '');           // Trim - from end
                slugInput.value = slug;
            });
        });
    </script>


</body>
</html>
