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
                            <th style="text-align: center">Nama Kategori</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                        <td style="text-align: left">{{ $category->nama_kategori }}</td>
                        <td>
                            <button class="btn btn-primary ml-2 btn-edit" data-toggle="modal" data-target="#editKategoriModal"
                                data-id="{{ $category->id_kategori }}"
                                data-nama="{{ $category->nama_kategori }}">Edit</button>
                            <form action="{{ route('kategori.destroy') }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$category->id_kategori}}">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                                    Delete
                                </button>
                            </form>
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
<!-- Edit Modal -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" role="dialog" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editKategoriForm" method="POST" action="">
                @csrf
                @method('PUT') <!-- method PUT untuk update data -->
                <div class="modal-body">
                    <input type="hidden" id="editKategoriId" name="id">
                    <div class="form-group">
                        <label for="editNamaKategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="editNamaKategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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

    // Edit Kategori
    $('.btn-edit').click(function() {
        var itemId = $(this).data('id'); // Ambil ID dari data-id tombol
        $.get("{{ url('/kategori') }}" + '/' + itemId + '/edit', function(data) {
            if (data) {
                $('#editKategoriId').val(data.id); // Set ID ke hidden input
                $('#editNamaKategori').val(data.nama_kategori); // Set nama kategori ke input
                $('#editKategoriForm').attr('action', "{{ url('/kategori') }}" + '/' + itemId); // Set action form
                $('#editKategoriModal').modal('show'); // Tampilkan modal
            } else {
                toastr.error('Data kategori tidak ditemukan.');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            toastr.error('Terjadi kesalahan saat mengambil data: ' + textStatus);
        });
    });
});
</script>


@endsection
