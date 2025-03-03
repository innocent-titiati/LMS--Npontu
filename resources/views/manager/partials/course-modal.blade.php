<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseModalLabel">Create/Edit Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="courseForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="courseId" name="id">
                    <div class="form-group">
                        <label for="courseName">Course Name</label>
                        <input type="text" class="form-control" id="courseName" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="instructorName">Instructor</label>
                        <select class="form-control" id="instructorName" name="instructor_id" required>
                            <option value="">Select Instructor</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contentTypeModal">Content Type</label>
                        <select class="form-control" id="contentTypeModal" name="content_type" required>
                            <option value="">Select Content Type</option>
                            <option value="audio">Audio</option>
                            <option value="pdf">PDF</option>
                            <option value="video">Video</option>
                            <option value="images">Images</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryModal">Category</label>
                        <select class="form-control" id="categoryModal" name="category" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="courseDescription">Course Description</label>
                        <textarea class="form-control" id="courseDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="courseLevel">Course Level</label>
                        <input type="text" class="form-control" id="courseLevel" name="level" required>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating (1-5)</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="courseImage">Course Image</label>
                        <input type="file" class="form-control-file" id="courseImage" name="image" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCourseButton">Save changes</button>
            </div>
        </div>
    </div>
</div> 