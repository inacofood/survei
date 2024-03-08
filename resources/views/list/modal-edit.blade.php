<div class="modal fade" id="editModuleModal" tabindex="-1" role="dialog" aria-labelledby="editModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModuleModalLabel">Edit Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editModuleForm" action="{{ route('update') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" id="editItemId" name="id">
                    <div class="form-group">
                        <label for="editTitle">Courses:</label>
                        <input type="text" class="form-control" id="editTitle" name="title" placeholder="Enter courses" required>
                    </div>
                    <div class="form-group">
                        <label for="editCategory">Category:</label>
                        <select id="editCategory" name="category" class="form-control" aria-placeholder="" required>
                            <option value="Hard Skills">Hard Skills</option>
                            <option value="Soft Skills">Soft Skills</option>
                            <option value="Technical Skills">Technical Skills</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editSubcategory">Sub-category:</label>
                        <input type="text" class="form-control" id="editSubcategory" name="subcategory" placeholder="Enter Sub-category" required>
                    </div>
                    <div class="form-group">
                        <label for="editLink">Link:</label>
                        <input type="text" class="form-control" id="editLink"name="link"  placeholder="Enter link" required>
                    </div>
                    <div class="form-group">
                        <label for="editVideo">Video:</label>
                        <input type="number" class="form-control" id="editVideo" name="video" placeholder="Enter video" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status:</label>
                        <select id="editStatus" class="form-control" name="status" aria-placeholder="" required>
                            <option value="Review">Review</option>
                            <option value="Published">Published</option>
                            <option value="Takedown">Takedown</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="updateModuleBtn">Update Module</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
