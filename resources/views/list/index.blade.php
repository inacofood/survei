@extends('layouts.main')

@section('content')
    <section class="section" id="home">
        <div class="container text-center">
            <h6 class="display-4">List e-Module</h6>
            <p class="has-line"></p>
            <div class="row mt-3">
                <div class="col-md-12 mt-3">
                    <div class="float-right">
                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#addModuleModal">Add New Module</button>
                        <a href="{{ route('export') }}" class="btn btn-primary ml-1">Export to Excel</a>
                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#importModuleModal">Import New Module</button>
                        <!-- <div class="float-right">
                            <label for="importFromExcel" class="btn btn-primary ml-2">Import from Excel</label>
                            <input type="file" name="excelFile" id="importFromExcel" accept=".xls,.xlsx" style="display: none;">
                        </div> -->
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <label for="FilterCat">Sub-category:</label>
                    <select id="FilterCat" class="form-control">
                        <option value="">All</option>
                        @foreach ($subCategories as $subcategory)
                            <option value="{{ $subcategory->sub_cat }}">{{ $subcategory->sub_cat }}</option>
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
                </div> -->
            </div>
            <br>
            <div class="container">
                <table id="dttable" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="display: none;">Id.</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Sub-category</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($listItems as $list)
                        <tr data-id="{{ $list->id }}">
                            <td style="display: none;">{{ $list->id }}</td>
                            <td>{{ $list->category }}</td>
                            <td>{{ $list->sub_cat }}</td>
                            <td>{{ $list->title }}</td>

                            <td>{{ $list->status }}</td>
                            <td><a href="{{ $list->link }}" target="_blank">Click Here</a></td>
                            <td>
                                <button class="btn btn-primary ml-2" data-toggle="modalEdit" data-target="#editModuleModal">Edit</button>
                                <button class="btn btn-primary ml-2 btn-delete">Delete</button>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@include('list.modal-add')
@include('list.modal-import')
@include('list.modal-edit')
@endsection



@section('script')

    <script>
        $(document).ready(function() {

            var table = $('#dttable').DataTable({
                "order": [[0, 'desc']],
                "columnDefs": [
                    { "targets": 0, "visible": false } // Menyembunyikan kolom pertama
                ],
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                ],
            });

            // $('#importFromExcel').on('change', function(e) {
            //     var file = e.target.files[0];
            //     var formData = new FormData();
            //     formData.append('excelFile', file);
            //     $.ajax({
            //         url: '/import-from-excel',
            //         method: 'POST',
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {
            //             alert('Data imported successfully.');
            //             window.location.reload();
            //         },
            //         error: function(xhr, status, error) {
            //             var errorMessage = xhr.status + ': ' + xhr.statusText;
            //             alert('Error importing data: ' + errorMessage);
            //         }
            //     });
            // });


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
                var newcategory = $('#newcategory').val();
                var newSubcategory = $('#newSubcategory').val();
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
                        category: newcategory,
                        subcategory: newSubcategory,
                        link: newLink,
                        status: newStatus
                    },
                    success: function(response) {
                        alert('Data imported successfully.');
                        window.location.reload();

                        // Bersihkan nilai input setelah entri ditambahkan
                        $('#newTitle').val('');
                        $('#newcategory').val('');
                        $('#newSubcategory').val('');
                        $('#newLink').val('');
                        $('#newStatus').val('Review');

                        // Tutup modal setelah entri ditambahkan
                        $('#addModuleModal').modal('hide');
                    },
                });
            });

            // Fungsi untuk menangani klik tombol Edit
            $(document).on('click', '[data-toggle="modalEdit"]', function() {
                var $row = $(this).closest("tr");
                var itemId = $row.data('id');
                // console.log(itemId)

                // AJAX untuk mendapatkan data modul dari server
                $.ajax({
                    url: "/get-modal-data", // Ubah URL ini sesuai dengan endpoint yang tepat di server Anda
                    method: "GET",
                    data: { id: itemId },
                    success: function(response) {
                        // Set nilai formulir modal dengan data yang diperoleh
                        $("#editModuleId").val(response.id);
                        $("#editTitle").val(response.title);
                        $("#editCategory").val(response.category);
                        $("#editSubcategory").val(response.sub_cat);
                        $("#editLink").val(response.link);
                        $("#editStatus").val(response.status);

                        // Tampilkan modal edit
                        $("#editModuleModal").modal("show");
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ": " + xhr.statusText;
                        alert("Error fetching data: " + errorMessage);
                    }
                });
            });


            // Fungsi untuk menangani permintaan pembaruan data
            $("#updateModuleBtn").on("click", function() {
                var itemId = $("#editModuleId").val();
                var newTitle = $("#editTitle").val();
                var newCategory = $("#editCategory").val();
                var newSubcategory = $("#editSubcategory").val();
                var newLink = $("#editLink").val();
                var newStatus = $("#editStatus").val();

                $.ajax({
                    url: "/update-data",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        id: itemId,
                        title: newTitle,
                        category: newCategory,
                        subcategory: newSubcategory,
                        link: newLink,
                        status: newStatus,
                    },
                    success: function(response) {
                        alert("Data updated successfully.");
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ": " + xhr.statusText;
                        alert("Error updating data: " + errorMessage);
                    },
                });
            });

            // Fungsi untuk menangani klik tombol Delete
            $(document).on('click', '.btn-delete', function() {
                var $row = $(this).closest("tr");
                var itemId = $row.data('id');

                // Konfirmasi terlebih dahulu sebelum menghapus
                if (confirm("Are you sure you want to delete this module?")) {
                    $.ajax({
                        url: "/delete", // Ubah URL ini sesuai dengan endpoint yang tepat di server Anda
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        data: { id: itemId },
                        success: function(response) {
                            alert("Module deleted successfully.");
                            $row.remove(); // Hapus baris dari tabel setelah berhasil dihapus dari database
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ": " + xhr.statusText;
                            alert("Error deleting module: " + errorMessage);
                        },
                    });
                }
            });



            // // Menambahkan dropdown filter untuk kolom sub-category
            // $('#FilterCat').on('change', function() {
            //     var selectedSubcat = $(this).val();
            //     table.column(2).search(selectedSubcat).draw();
            // });

            // // Menambahkan dropdown filter untuk kolom status
            // $('#FilterStatus').on('change', function() {
            // var selectedStatus = $(this).val();
            // table.column(4).search(selectedStatus).draw();
            // });


        });

    </script>
@endsection
