<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - Npontu LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-md w-64 min-h-screen fixed">
            <div class="p-4">
                <img src="{{ asset('images/sign_in_sign_up/logo_u45.svg') }}" alt="Logo" class="mb-8 w-40">
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('manager.dashboard') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manager.courses') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                <i class="fas fa-book mr-3"></i>
                                Manage Courses
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('enrollments.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                <i class="fas fa-users mr-3"></i>
                                Enrollment
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                <i class="fas fa-user-cog mr-3"></i>
                                User Management
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                <i class="fas fa-chart-bar mr-3"></i>
                                Reports & Analytics
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64 p-8 w-full">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Manager Dashboard</h1>
                <div class="flex items-center">
                    <div class="mr-4">
                        <span class="text-gray-600">Welcome, {{ auth()->user()->first_name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm mb-2">Total Courses</h3>
                    <p class="text-3xl font-bold">{{ $stats['totalCourses'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm mb-2">Active Enrollments</h3>
                    <p class="text-3xl font-bold">{{ $stats['activeEnrollments'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm mb-2">Total Users</h3>
                    <p class="text-3xl font-bold">{{ $stats['totalUsers'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm mb-2">Completion Rate</h3>
                    <p class="text-3xl font-bold">{{ $stats['completionRate'] }}%</p>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Recent Activities</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left bg-gray-50">
                                <th class="p-3">User</th>
                                <th class="p-3">Course</th>
                                <th class="p-3">Action</th>
                                <th class="p-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentActivities as $activity)
                            <tr class="border-t">
                                <td class="p-3">{{ $activity->user->name }}</td>
                                <td class="p-3">{{ $activity->course->title }}</td>
                                <td class="p-3">{{ $activity->action }}</td>
                                <td class="p-3">{{ $activity->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js setup (if you want to add charts later)
        // const ctx = document.getElementById('myChart').getContext('2d');
        
        // Refresh dashboard data periodically
        function refreshDashboardData() {
            fetch('/manager/dashboard-data')
                .then(response => response.json())
                .then(data => {
                    // Update statistics
                    document.querySelector('[data-stat="totalCourses"]').textContent = data.stats.totalCourses;
                    document.querySelector('[data-stat="activeEnrollments"]').textContent = data.stats.activeEnrollments;
                    document.querySelector('[data-stat="totalUsers"]').textContent = data.stats.totalUsers;
                    document.querySelector('[data-stat="completionRate"]').textContent = data.stats.completionRate + '%';
                })
                .catch(error => console.error('Error:', error));
        }

        // Add data attributes to your stat elements
        document.querySelectorAll('.stats-card').forEach(card => {
            const statType = card.getAttribute('data-stat-type');
            card.querySelector('p').setAttribute('data-stat', statType);
        });

        // Sidebar active state
        const currentPath = window.location.pathname;
        document.querySelectorAll('.sidebar nav a').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('bg-gray-200');
            }
        });

        // Notification system
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        // Add data-refresh attribute to elements that need periodic updates
        const refreshInterval = setInterval(refreshDashboardData, 30000); // Refresh every 30 seconds

        // Clean up on page unload
        window.addEventListener('unload', () => {
            clearInterval(refreshInterval);
        });

        // Activity table row hover effect
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.classList.add('bg-gray-50');
            });
            row.addEventListener('mouseleave', () => {
                row.classList.remove('bg-gray-50');
            });
        });

        // Update your stats cards HTML to include data attributes
        const statsCards = `
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow stats-card" data-stat-type="totalCourses">
                    <h3 class="text-gray-500 text-sm mb-2">Total Courses</h3>
                    <p class="text-3xl font-bold">{{ $stats['totalCourses'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow stats-card" data-stat-type="activeEnrollments">
                    <h3 class="text-gray-500 text-sm mb-2">Active Enrollments</h3>
                    <p class="text-3xl font-bold">{{ $stats['activeEnrollments'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow stats-card" data-stat-type="totalUsers">
                    <h3 class="text-gray-500 text-sm mb-2">Total Users</h3>
                    <p class="text-3xl font-bold">{{ $stats['totalUsers'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow stats-card" data-stat-type="completionRate">
                    <h3 class="text-gray-500 text-sm mb-2">Completion Rate</h3>
                    <p class="text-3xl font-bold">{{ $stats['completionRate'] }}%</p>
                </div>
            </div>
        `;
    });
    </script>
</body>
</html>
