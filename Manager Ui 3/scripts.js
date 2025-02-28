document.addEventListener("DOMContentLoaded", function() {
    const createCourseButton = document.querySelector("#createCourseButton");
    const saveCourseButton = document.querySelector("#saveCourseButton");
    const courseContainer = document.querySelector("#courseContainer");
    const courseForm = document.querySelector("#courseForm");
    const contentTypeFilter = document.querySelector("#contentType");
    const categoryFilter = document.querySelector("#category");
    const totalCoursesElement = document.getElementById('totalCourses');

    let editingCourseCard = null;

    createCourseButton.addEventListener("click", function() {
        editingCourseCard = null;
        courseForm.reset();
        $('#courseModal').modal('show');
    });

    saveCourseButton.addEventListener("click", function() {
        const courseName = document.querySelector("#courseName").value;
        const contentType = document.querySelector("#contentTypeModal").value;
        const category = document.querySelector("#categoryModal").value;
        const courseDescription = document.querySelector("#courseDescription").value;
        const courseLevel = document.querySelector("#courseLevel").value;
        const endDate = document.querySelector("#endDate").value;
        const rating = document.querySelector("#rating").value;
        const courseImage = document.querySelector("#courseImage").files[0];

        if (courseName && contentType && category && courseDescription && courseLevel && endDate && rating && courseImage) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageUrl = e.target.result;

                if (editingCourseCard) {
                    updateCourseCard(editingCourseCard, courseName, contentType, category, courseDescription, courseLevel, endDate, rating, imageUrl);
                } else {
                    createCourseCard(courseName, contentType, category, courseDescription, courseLevel, endDate, rating, imageUrl);
                }

                $('#courseModal').modal('hide');
                updateTotalCourses();
            };
            reader.readAsDataURL(courseImage);
        } else {
            alert("All fields are required!");
        }
    });

    function createCourseCard(name, contentType, category, description, level, endDate, rating, imageUrl) {
        const dateCreated = new Date().toLocaleDateString();
        const courseCard = document.createElement("div");
        courseCard.className = "col-md-3 course-card";
        courseCard.dataset.contentType = contentType;
        courseCard.dataset.category = category;
        courseCard.innerHTML = `
            <div class="card">
                <img src="${imageUrl}" class="card-img-top" alt="Course Image">
                <div class="card-body">
                    <h5 class="card-title">Course Supervisor Name</h5>
                    <p class="card-text">Course Name: <span class="course-name">${name}</span></p>
                    <p class="card-text">Content Type: <span class="content-type">${contentType}</span></p>
                    <p class="card-text">Category: <span class="category">${category}</span></p>
                    <p class="card-text">Course Description: <span class="course-description">${description}</span></p>
                    <p class="card-text">Course Level: <span class="course-level">${level}</span></p>
                    <p class="card-text">Last Updated: <span class="date-created">${dateCreated}</span></p>
                    <p class="card-text">End Date: <span class="end-date">${endDate}</span></p>
                    <p class="card-text">Rating: <span class="rating">${rating}</span> <span class="fa fa-star checked"></span></p>
                    <button class="btn btn-secondary edit-course">Edit</button>
                </div>
            </div>
        `;
        courseContainer.appendChild(courseCard);

        const editButton = courseCard.querySelector(".edit-course");
        editButton.addEventListener("click", function() {
            editingCourseCard = courseCard;
            document.querySelector("#courseName").value = name;
            document.querySelector("#contentTypeModal").value = contentType;
            document.querySelector("#categoryModal").value = category;
            document.querySelector("#courseDescription").value = description;
            document.querySelector("#courseLevel").value = level;
            document.querySelector("#endDate").value = endDate;
            document.querySelector("#rating").value = rating;
            $('#courseModal').modal('show');
        });
    }

    function updateCourseCard(card, name, contentType, category, description, level, endDate, rating, imageUrl) {
        card.querySelector(".course-name").textContent = name;
        card.querySelector(".content-type").textContent = contentType;
        card.querySelector(".category").textContent = category;
        card.querySelector(".course-description").textContent = description;
        card.querySelector(".course-level").textContent = level;
        card.querySelector(".end-date").textContent = endDate;
        card.querySelector(".rating").textContent = rating;
        card.querySelector("img").src = imageUrl;
        card.dataset.contentType = contentType;
        card.dataset.category = category;
    }

    function filterCourses() {
        const selectedContentType = contentTypeFilter.value;
        const selectedCategory = categoryFilter.value;

        document.querySelectorAll(".course-card").forEach(card => {
            const matchesContentType = selectedContentType === "" || card.dataset.contentType === selectedContentType;
            const matchesCategory = selectedCategory === "" || card.dataset.category === selectedCategory;

            if (matchesContentType && matchesCategory) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });

        updateTotalCourses();
    }

    function updateTotalCourses() {
        const visibleCourses = document.querySelectorAll(".course-card:not([style*='display: none'])").length;
        totalCoursesElement.textContent = `Total courses: ${visibleCourses}`;
    }

    contentTypeFilter.addEventListener("change", filterCourses);
    categoryFilter.addEventListener("change", filterCourses);
}); 