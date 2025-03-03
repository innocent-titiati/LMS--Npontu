<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management - Npontu LMS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <img src="{{ asset('images/sign_in_sign_up/logo_u45.svg') }}" alt="Npontu Learning Hub Logo" width="216" height="70">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ route('manager.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('manager.courses') }}">Manage Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('enrollments.index') }}">Enrolment</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">User Management</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Feedback & Surveys</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Report & Analytics</a></li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Courses</h5>
                            <p class="card-text" id="overallCourses">{{ $totalCourses }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Completed</h5>
                            <p class="card-text">{{ $completedCourses }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Performance</h5>
                            <p class="card-text">{{ $performance }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <select class="form-control mr-2" id="contentType">
                                <option value="audio">Audio</option>
                                <option value="pdf">PDF</option>
                                <option value="video">Video</option>
                                <option value="images">Images</option>
                            </select>
                            <select class="form-control" id="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="searchCourse" placeholder="Find your course">
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#courseModal">
                                Create Course
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <p id="totalCourses">Total courses: {{ $totalCourses }}</p>
                </div>
            </div>

            <div id="courseContainer" class="row">
                @foreach($courses as $course)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="Course Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->instructor->name ?? 'No Instructor' }}</h5>
                                <p class="card-text">Course Name: {{ $course->title }}</p>
                                <p class="card-text">Description: {{ Str::limit($course->description, 100) }}</p>
                                <p class="card-text">Level: {{ $course->level }}</p>
                                <p class="card-text">Last Updated: {{ $course->updated_at->format('Y-m-d') }}</p>
                                <p class="card-text">Rating: {{ $course->rating }} <span class="fa fa-star checked"></span></p>
                                <div class="mt-2">
                                    <button class="btn btn-sm btn-primary edit-course" data-id="{{ $course->id }}">Edit</button>
                                    <button class="btn btn-sm btn-danger delete-course" data-id="{{ $course->id }}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{ $courses->links() }}
        </div>
    </div>

    <!-- Course Modal -->
    @include('manager.partials.course-modal')

    <footer class="footer">
        <p>Npontu Learning Hub © {{ date('Y') }}</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchCourse').on('keyup', function() {
                let value = $(this).val().toLowerCase();
                $("#courseContainer .card").filter(function() {
                    $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Filter by content type
            $('#contentType').change(function() {
                filterCourses();
            });

            // Filter by category
            $('#category').change(function() {
                filterCourses();
            });

            function filterCourses() {
                let contentType = $('#contentType').val();
                let category = $('#category').val();
                
                $.get('{{ route("manager.courses.filter") }}', {
                    content_type: contentType,
                    category: category
                }, function(data) {
                    $('#courseContainer').html(data);
                });
            }

            // Handle course creation/editing
            $('#saveCourseButton').click(function(e) {
                e.preventDefault();
                let formData = new FormData($('#courseForm')[0]);
                
                $.ajax({
                    url: '{{ route("manager.courses.store") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#courseModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $(`#${key}`).addClass('is-invalid');
                            $(`#${key}`).after(`<div class="invalid-feedback">${errors[key][0]}</div>`);
                        });
                    }
                });
            });

            // Delete course
            $('.delete-course').click(function() {
                if (confirm('Are you sure you want to delete this course?')) {
                    let courseId = $(this).data('id');
                    $.ajax({
                        url: `/manager/courses/${courseId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });

            // Edit course
            $('.edit-course').click(function() {
                let courseId = $(this).data('id');
                $.get(`/manager/courses/${courseId}/edit`, function(data) {
                    $('#courseForm').trigger('reset');
                    $('#courseId').val(data.id);
                    $('#courseName').val(data.title);
                    $('#instructorName').val(data.instructor_id);
                    $('#courseDescription').val(data.description);
                    $('#courseLevel').val(data.level);
                    $('#rating').val(data.rating);
                    $('#contentTypeModal').val(data.content_type);
                    $('#categoryModal').val(data.category);
                    $('#courseModal').modal('show');
                });
            });
        });
    </script>
</body>
</html> 