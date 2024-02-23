<div class="modal fade" id="importModuleModal" tabindex="-1" role="dialog" aria-labelledby="importModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModuleModalLabel">Import New Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="importModuleForm">
                    <div class="form-group text-center">
                        <a href="/download">Download Template </a>
                    </div>
                    <div class="form-group text-center">
                        <label for="importFromExcel" class="btn btn-primary ml-2">Import from Excel</label>
                        <input type="file" name="excelFile" id="importFromExcel" accept=".xls,.xlsx" style="display: none;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
