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
                <form id="editModuleForm">
                    <input type="hidden" id="editModuleId">
                    <div class="form-group">
                        <label for="editTitle">Title:</label>
                        <input type="text" class="form-control" id="editTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="editCategory">Category:</label>
                        <input type="text" class="form-control" id="editCategory" placeholder="Enter category">
                    </div>
                    <div class="form-group">
                        <label for="editSubcategory">Sub-category:</label>
                        <input type="text" class="form-control" id="editSubcategory" placeholder="Enter Sub-category">
                    </div>
                    <div class="form-group">
                        <label for="editLink">Link:</label>
                        <input type="text" class="form-control" id="editLink" placeholder="Enter link">
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status:</label>
                        <select id="editStatus" class="form-control" aria-placeholder="">
                            <option value="Review">Review</option>
                            <option value="Published">Published</option>
                            <option value="Takedown">Takedown</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateModuleBtn">Update Module</button>
            </div>
        </div>
    </div>
</div>
