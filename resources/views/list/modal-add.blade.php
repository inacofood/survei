<div class="modal fade" id="addModuleModal" tabindex="-1" role="dialog" aria-labelledby="addModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModuleModalLabel">Add New Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addModuleForm" action="{{ route('add') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="newTitle">Courses</label>
                        <input type="text" class="form-control" id="newTitle" name="title" placeholder="Enter courses" required>
                    </div>
                    <div class="form-group">
                        <label for="newcategory">Category</label>
                        <select id="newCategory" name="category" class="form-control" required>
                            <option value="" selected disabled>Choose</option>
                            <option value="Basic Skills">Basic Skills</option>
                            <option value="Soft Skills">Soft Skills</option>
                            <option value="Technical Skills">Technical Skills</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newSubcategory">Sub-category</label>
                        <input type="text" class="form-control" id="newSubcategory" name="subcategory" placeholder="Enter Sub-category" required>
                    </div>
                    <div class="form-group">
                        <label for="newLink">Link</label>
                        <input type="text" class="form-control" id="newLink" name="link" placeholder="Enter link" required>
                    </div>
                    <div class="form-group">
                        <label for="newVideo">Video</label>
                        <input type="number" class="form-control" id="newVideo" name="video" placeholder="Enter video" required>
                    </div>
                    <div class="form-group">
                        <label for="newStatus">Status</label>
                        <select id="newStatus" name="status" class="form-control" required>
                            <option value="" selected disabled>Choose</option>
                            <option value="Review">Review</option>
                            <option value="Published">Published</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addModuleBtn">Add Module</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
