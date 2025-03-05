// Current page number
let currentPage = 1;
// Number of courses to display per page
const coursesPerPage = 10;

// Function to fetch courses from the backend
async function fetchCourses(page) {
    try {
        // Fetch courses from the API with pagination
        const response = await fetch(`/api/courses?page=${page}&limit=${coursesPerPage}`);
        const data = await response.json();
        // Display the fetched courses
        displayCourses(data.courses);
        // Update pagination controls
        updatePagination(data.totalCourses);
        // Update total courses count
        document.getElementById('total-courses').textContent = `Total courses: ${data.totalCourses}`;
    } catch (error) {
        console.error('Error fetching courses:', error);
    }
}

// Function to display courses on the page
function displayCourses(courses) {
    const courseList = document.getElementById('course-list');
    courseList.innerHTML = '';
    courses.forEach(course => {
        const courseItem = document.createElement('div');
        courseItem.className = 'course-item';
        courseItem.textContent = course.name;
        courseList.appendChild(courseItem);
    });
}

// Function to update pagination controls
function updatePagination(totalCourses) {
    const totalPages = Math.ceil(totalCourses / coursesPerPage);
    document.getElementById('prev').disabled = currentPage === 1;
    document.getElementById('next').disabled = currentPage === totalPages;
}

// Event listener for previous button
document.getElementById('prev').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        fetchCourses(currentPage);
    }
});

// Event listener for next button
document.getElementById('next').addEventListener('click', () => {
    currentPage++;
    fetchCourses(currentPage);
});

// Initial fetch of courses
fetchCourses(currentPage);
