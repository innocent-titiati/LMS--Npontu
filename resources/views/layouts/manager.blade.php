<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manager Dashboard')</title>
    <link href="{{ asset('src/styles/styles.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h2>Management Portal</h2>
                <nav>
                    <a href="{{ route('manager.dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="#" class="nav-link">Courses</a>
                    <a href="#" class="nav-link">Employees</a>
                    <a href="#" class="nav-link">Reports</a>
                    <a href="#" class="nav-link">Settings</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Npontu LMS</p>
    </footer>
</body>
</html> 