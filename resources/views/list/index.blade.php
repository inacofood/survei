@extends('layouts.main')

@section('content')
    <section class="section" id="home">
        <div class="container text-center">
            <h6 class="display-4">List e-Learning Module</h6>
            <p class="has-line"></p>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="FilterCat">Sub-category:</label>
                    <select id="FilterCat" class="form-control">
                        <option value="">All</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->sub_cat }}">{{ $subCategory->sub_cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="FilterStatus">Status:</label>
                    <select id="FilterStatus" class="form-control">
                        <option value="">All</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->status }}">{{ $status->status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="float-right">
                        <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#addModuleModal">Add New Module</button>
                        <button id="exportToExcel" class="btn btn-primary ml-1">Export to Excel</button>
                        <div class="float-right">
                        <label for="importFromExcel" class="btn btn-primary ml-2">Import from Excel</label>
                        <input type="file" name="excelFile" id="importFromExcel" accept=".xls,.xlsx" style="display: none;">
                    </div>
                    </div>
                </div>

            </div>
            <br>
            <div class="container">
                <table id="dttable" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="display: none;">Id.</th>
                            <th class="text-center">sub-category</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listItems as $list)
                        <tr data-subcat="{{ $list->sub_cat }}">
                            <td style="display: none;">{{ $list->id }}</td>
                            <td>{{ $list->sub_cat }}</td>
                            <td>{{ $list->title }}</td>
                            <td id="status-{{ $list->id }}">
                                @if ($list->status === "Review")
                                    <span class="badge badge-pill badge-secondary">{{ $list->status }}</span>
                                @elseif($list->status === "Published")
                                    <span class="badge badge-pill badge-success">{{ $list->status }}</span>
                                @elseif($list->status === "TakeDown")
                                    <span class="badge badge-pill badge-danger">{{ $list->status }}</span>
                                @endif
                            </td>
                            <td><a href="{{ $list->link }}">{{ $list->link }}</a></td>
                            <td class="d-flex align-items-center">
                                <select class="form-control form-control-sm status-select mr-2">
                                    <option disabled selected>Change Status</option>
                                    <option value="Review">Review</option>
                                    <option value="Published">Published</option>
                                    <option value="TakeDown">TakeDown</option>
                                </select>

                                <button class="btn btn-primary update-status-btn">Update</button>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- MODAL -->
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
                <form id="addModuleForm">
                    <div class="form-group">
                        <label for="newTitle">Title:</label>
                        <input type="text" class="form-control" id="newTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="newSubCategory">Sub-category:</label>
                        <input type="text" class="form-control" id="newSubCategory" placeholder="Enter sub-category">
                    </div>
                    <div class="form-group">
                        <label for="newLink">Link:</label>
                        <input type="text" class="form-control" id="newLink" placeholder="Enter link">
                    </div>
                    <div class="form-group">
                        <label for="newStatus">Status:</label>
                        <select id="newStatus" class="form-control">
                            <option value="Review">Review</option>
                            <option value="Published">Published</option>
                            <option value="TakeDown">TakeDown</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addModuleBtn">Add Module</button>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')

    <script>
        $(document).ready(function() {

            var table = $('#dttable').DataTable({
                "order": [[0, 'asc']],
                "columnDefs": [
                    { "targets": 0, "visible": false } // Menyembunyikan kolom pertama
                ],
                "buttons": [
                    {
                    extend: 'excelHtml5',
                    exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Kolom yang akan diekspor (tidak termasuk Action)
                    }
                    }
                ]
            });

            $('#exportToExcel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            $('#importFromExcel').on('change', function(e) {
                var file = e.target.files[0];
                var formData = new FormData();
                formData.append('excelFile', file);
                $.ajax({
                    url: '/import-from-excel',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert('Data imported successfully.');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error importing data: ' + errorMessage);
                    }
                });
            });

            // Tambahkan fungsi untuk menangani penambahan modul baru
            $('#addModuleBtn').on('click', function() {
                var newTitle = $('#newTitle').val();
                var newSubCategory = $('#newSubCategory').val();
                var newLink = $('#newLink').val();
                var newStatus = $('#newStatus').val();

                $.ajax({
                    url: '/add-new-module',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        title: newTitle,
                        subCategory: newSubCategory,
                        link: newLink,
                        status: newStatus
                    },
                    success: function(response) {
                        alert('Data imported successfully.');
                        window.location.reload();

                        // Bersihkan nilai input setelah entri ditambahkan
                        $('#newTitle').val('');
                        $('#newSubCategory').val('');
                        $('#newLink').val('');
                        $('#newStatus').val('Review');

                        // Tutup modal setelah entri ditambahkan
                        $('#addModuleModal').modal('hide');
                    },
                });
            });


            // Menambahkan dropdown filter untuk kolom sub-category
            $('#FilterCat').on('change', function() {
                var selectedSubcat = $(this).val();
                table.column(1).search(selectedSubcat).draw();
            });

            // Menambahkan dropdown filter untuk kolom status
            $('#FilterStatus').on('change', function() {
            var selectedStatus = $(this).val();
            table.column(3).search(selectedStatus).draw();
            });

            // Menangani pembaruan
            $('#dttable').on('click', '.update-status-btn', function() {
                var rowData = table.row($(this).closest('tr')).data();
                var newStatus = $(this).siblings('.status-select').val();
                var itemId = rowData[0]; // ID item
                var selectDropdown = $(this).siblings('.status-select'); // Declare selectDropdown here
                var statusCell = $('#status-' + itemId); // Get the status cell
                // Kirim permintaan AJAX ke server untuk memperbarui status
                $.ajax({
                    url: '/update-status',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: itemId,
                        status: newStatus
                    },
                    success: function(response) {
                        // Perbarui tampilan status di halaman
                        statusCell.empty(); // Clear the status cell
                        if (newStatus === "Review") {
                            statusCell.append('<span class="badge badge-pill badge-secondary">Review</span>');
                        } else if (newStatus === "Published") {
                            statusCell.append('<span class="badge badge-pill badge-success">Published</span>');
                        } else if (newStatus === "TakeDown") {
                            statusCell.append('<span class="badge badge-pill badge-danger">TakeDown</span>');
                        }
                        selectDropdown.val('Change Status');
                    },
                });
            });

        });

    </script>
@endsection
