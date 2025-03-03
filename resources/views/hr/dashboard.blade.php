<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('src/styles/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h2>HR Management</h2>
                <nav>
                    <a href="#" class="nav-link">Dashboard</a>
                    <a href="#" class="nav-link">Employees</a>
                    <a href="#" class="nav-link">Attendance</a>
                    <a href="#" class="nav-link">Leave Requests</a>
                    <a href="#" class="nav-link">Reports</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <h1>HR Dashboard</h1>
                
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Total Employees</h2>
                                <p class="card-text">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Present Today</h2>
                                <p class="card-text">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h2>Leave Requests</h2>
                                <p class="card-text">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Table -->
                <div class="card">
                    <div class="card-body">
                        <h2>Recent Activity</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">No recent activity</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>HR Dashboard © 2024</p>
    </footer>
</body>
</html> 