@extends('layouts.main')

@section('content')
<section class="section" id="home">
        <div class="container text-center">
        <div style="text-align: center;">
        <br>
        <h3><strong>Kategori OCAI</strong></h3>
    </div>
            <p class="has-line"></p>
            <div class="row mt-3">
                <div class="col-md-12 mt-3">
                    <div class="float-right">
                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#addKategoriModal">Tambah Data Kategori</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
            <table id="dttable" class="table table-striped mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                        <td>{{ $category->nama_kategori }}</td>
                        <td>
                            <button class="btn btn-primary ml-2 btn-edit" data-toggle="modal" data-target="#editKategoriModal"
                                data-id="{{ $category->id }}"
                                data-nama="{{ $category->nama_kategori }}">Edit</button>
                            <button class="btn btn-danger ml-2 btn-delete" data-id="{{ $category->id }}" data-nama="{{ $category->nama_kategori }}">Delete</button>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Tambah Kategori -->
<div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKategoriModalLabel">Tambah Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" role="dialog" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriModalLabel">Edit Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editKategoriForm" method="POST" action="" class="p-3">
                @csrf
                @method('PUT')
                <input type="hidden" id="editKategoriId" name="id_kategori">
                
                <!-- Nama Kategori Field -->
                <div class="form-group mt-3">
                    <label for="editNamaKategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="editNamaKategori" name="nama_kategori" required>
                </div>

                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection



@section('script')
<script>

   $(document).ready(function() {
    var successMessage = "{{ session('success') }}";
    var errorMessage = "{{ session('error') }}";

    if (successMessage) {
        toastr.success(successMessage);
    }

    if (errorMessage) {
        toastr.error(errorMessage);
    }

    $('#dttable').DataTable({
    "order": [[0, 'desc']],
});


    // Populate edit modal with AJAX request
   // Populate edit modal with AJAX request
$('.btn-edit').click(function() {
    var itemId = $(this).data('id');
    $.get("{{ url('/kategori') }}" + '/' + itemId + '/edit', function(data) {
        if (data) {
            $('#editKategoriId').val(data.id); // Set hidden input with category ID
            $('#editNamaKategori').val(data.nama_kategori); // Set category name
            $('#editKategoriForm').attr('action', "{{ url('/kategori') }}" + '/' + itemId); // Set action URL
            $('#editKategoriModal').modal('show'); // Show the modal
        } else {
            toastr.error('Data kategori tidak ditemukan.');
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        toastr.error('Terjadi kesalahan saat mengambil data: ' + textStatus);
    });
});



    // Handle delete action
    $('.btn-delete').click(function() {
        var itemId = $(this).data('id');
        var itemName = $(this).data('nama');
        if (confirm("Are you sure you want to delete " + itemName + "?")) {
            $.ajax({
                url: "{{ url('/kategori') }}" + '/' + itemId, // Update URL sesuai dengan route
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    window.location.reload();
                    toastr.success("Kategori berhasil dihapus");
                },
                error: function(xhr) {
                    toastr.error("Terjadi kesalahan: " + xhr.responseText);
                }
            });
        }
    });
});
</script>

@endsection
