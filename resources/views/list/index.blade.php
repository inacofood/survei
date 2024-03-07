@extends('layouts.main')

@section('content')
@if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
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
                            <th class="text-center">Courses</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Video</th>
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
                            <td>{{ $list->video }}</td>
                            <td>
                                <button class="btn btn-primary ml-2 btn-edit" data-toggle="modal" data-target="#editModuleModal" data-id="{{ $list->id }}" data-title="{{ $list->title }}" data-category="{{ $list->category }}" data-subcategory="{{ $list->sub_cat }}" data-link="{{ $list->link }}" data-video="{{ $list->video }}"data-status="{{ $list->status }}">Edit</button>
                                <button type="button" class="btn btn-primary ml-2 btn-delete" data-id="{{ $list->id }}" data-title="{{ $list->title }}">
                                Delete
                                </button>
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
            var successMessage = "{{ session('success') }}";
            var errorMessage = "{{ session('error') }}";

            if (successMessage) {
                alert(successMessage);
            }

            if (errorMessage) {
                alert(errorMessage);
            }

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
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    }
                ],
            });


            // Fungsi untuk mengisi value awal modal edit
            $(document).on('click', '.btn-edit', function() {
                var itemId = $(this).data('id');
                var title = $(this).data('title');
                var category = $(this).data('category');
                var subcategory = $(this).data('subcategory');
                var link = $(this).data('link');
                var video = $(this).data('video');
                var status = $(this).data('status');

                // Isi nilai input pada modal edit dengan data yang sesuai
                $('#editItemId').val(itemId);
                $('#editTitle').val(title);
                $('#editCategory').val(category);
                $('#editSubcategory').val(subcategory);
                $('#editLink').val(link);
                $('#editVideo').val(video);
                $('#editStatus').val(status);
            });

            $('.btn-delete').click(function() {
                var itemId = $(this).data('id');
                var itemTitle = $(this).data('title');
                if (confirm("Are you sure you want to delete " + itemTitle + "?")) {
                    // If the user confirms deletion
                    $.ajax({
                        url: "{{ url('/delete') }}" + '/' + itemId, // Correcting the URL generation
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            alert('Item deleted successfully');
                            window.location.reload(); // Example: reloading the page after successful deletion
                        },
                        error: function(xhr) {
                            alert('Failed to delete item: ' + xhr.responseText);
                        }
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
