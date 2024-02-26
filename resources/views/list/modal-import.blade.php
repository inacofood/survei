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
                <form id="importModuleForm" action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group text-left">
                        <a href="/download">Download Template </a>
                    </div>
                    <div class="form-group text-left">
                        <input type="file" name="excelFile" id="importFromExcel" accept=".xls,.xlsx">
                    </div>
                    <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary ml-2" id="submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
