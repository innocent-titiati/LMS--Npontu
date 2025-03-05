async function fetchCourseDetails() {
    try {
        const response = await fetch('/api/course-details');
        const data = await response.json();
        displayCourseDetails(data);
    } catch (error) {
        console.error('Error fetching course details:', error);
    }
}

function displayCourseDetails(details) {
    const courseDetails = document.getElementById('course-details');
    courseDetails.innerHTML = `
        <p>${details.description}</p>
        <h2>Course Contents</h2>
        <ul>
            ${details.contents.map(content => `<li>${content}</li>`).join('')}
        </ul>
    `;
}

// Initial fetch of course details
fetchCourseDetails();

document.querySelectorAll('.collapsible').forEach(header => {
    header.addEventListener('click', () => {
        header.classList.toggle('active');
        const content = header.nextElementSibling;
        if (content.style.display === 'block') {
            content.style.display = 'none';
        } else {
            content.style.display = 'block';
        }
    });
});
