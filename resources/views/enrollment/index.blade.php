<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolment - Npontu LMS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div id="navbar" class="sidebar">
            <img src="{{ asset('images/logo_u45.svg') }}" alt="Npontu Learning Hub Logo" width="216" height="70">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/courses') }}">Manage Courses</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ url('/enrollments') }}">Enrolment</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/users') }}">User Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/feedback') }}">Feedback & Surveys</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/reports') }}">Report & Analytics</a></li>
            </ul>
        </div>
        <div class="container-fluid mt-4">
            <h1 class="text-center">ENROLLMENT</h1>
            
            <div class="row mt-3">
                <div class="col-md-2.5">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">ONGOING COURSES</h5>
                            <p class="card-text">{{ $stats['ongoingCourses'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2.5">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">TOTAL USERS</h5>
                            <p class="card-text">{{ $stats['totalUsers'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2.5">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">ACTIVE USERS</h5>
                            <p class="card-text">{{ $stats['activeUsers'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2.5">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">COURSES COMPLETED</h5>
                            <p class="card-text">{{ $stats['completedCourses'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2.5">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">CERTIFICATES EARNED</h5>
                            <p class="card-text">{{ $stats['certificatesEarned'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="bg-primary text-white p-2">User Table</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enrollModal">
                        New Enrollment
                    </button>
                </div>
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Course Name</th>
                            <th>Start Date</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->user->name }}</td>
                            <td>{{ $enrollment->course->title }}</td>
                            <td>{{ $enrollment->created_at->format('Y-m-d') }}</td>
                            <td>{{ $enrollment->progress }}%</td>
                            <td>{{ $enrollment->status }}</td>
                            <td>
                                <form action="{{ route('enrollments.update', $enrollment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm" name="action" value="toggle_status">
                                        {{ $enrollment->status === 'suspended' ? 'Unsuspend' : 'Suspend' }}
                                    </button>
                                </form>
                                <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- New Enrollment Modal -->
    <div class="modal fade" id="enrollModal" tabindex="-1" role="dialog" aria-labelledby="enrollModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enrollModalLabel">New Enrollment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course_id">Course</label>
                            <select name="course_id" id="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enroll</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>Npontu Learning Hub © 2024</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 