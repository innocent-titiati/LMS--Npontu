<?php
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Role;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReportController;

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/seed-users', function () {
    User::factory()->count(10)->create();
    return '10 users created!';
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');




Route::get('/home', function () {
    return "Welcome to Home!";
})->name('home')->middleware('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::resource('courses', CourseController::class);

Route::resource('modules', ModuleController::class);

Route::get('/enrollment', function () {
    return view('enrollment');
});


Route::post('/enroll', [EnrollmentController::class, 'enroll']);
Route::get('/enrollments/index', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::resource('enrollments', EnrollmentController::class);

Route::get('/instructors', [InstructorController::class, 'index']);
Route::post('/assign-course', [InstructorController::class, 'assignCourse']);

Route::resource('assessments', AssessmentController::class);

Route::post('/certificates', [CertificateController::class, 'generate']);

Route::get('/dashboard/student', [DashboardController::class, 'studentDashboard']);
Route::get('/dashboard/instructor', [DashboardController::class, 'instructorDashboard']);

Route::post('/notifications/send', [NotificationController::class, 'sendNotification']);
Route::get('/notifications', [NotificationController::class, 'getNotifications'])->middleware('auth');
Route::put('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/courses', [ManagerController::class, 'courses'])->name('manager.courses');
    Route::post('/manager/courses', [ManagerController::class, 'storeCourse'])->name('manager.courses.store');
    Route::get('/manager/courses/{course}/edit', [ManagerController::class, 'editCourse'])->name('manager.courses.edit');
    Route::put('/manager/courses/{course}', [ManagerController::class, 'updateCourse'])->name('manager.courses.update');
    Route::delete('/manager/courses/{course}', [ManagerController::class, 'deleteCourse'])->name('manager.courses.destroy');
    Route::get('/manager/courses/filter', [ManagerController::class, 'filterCourses'])->name('manager.courses.filter');
});

Route::group(['middleware' => ['role:employee']], function () {
    // your routes
});


// Manager Routes
Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/courses', [ManagerController::class, 'courses'])->name('manager.courses');
    Route::post('/manager/courses', [ManagerController::class, 'storeCourse'])->name('manager.courses.store');
    Route::get('/manager/courses/{course}/edit', [ManagerController::class, 'editCourse'])->name('manager.courses.edit');
    Route::put('/manager/courses/{course}', [ManagerController::class, 'updateCourse'])->name('manager.courses.update');
    Route::delete('/manager/courses/{course}', [ManagerController::class, 'deleteCourse'])->name('manager.courses.destroy');
    Route::get('/manager/courses/filter', [ManagerController::class, 'filterCourses'])->name('manager.courses.filter');
});

Route::get('/manager/users', [ManagerController::class, 'users'])->name('manager.users')->middleware('auth');

// HR Routes
Route::get('/hr/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard')->middleware('auth');

// Employee Routes
Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard')->middleware('auth');

// Add dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Update these routes if they don't exist
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/manager/dashboard-data', [ManagerController::class, 'getDashboardData'])
    ->name('manager.dashboard-data')
    ->middleware(['auth', 'role:manager']);

