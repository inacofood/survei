@extends('layouts.main')

@section('content')
<section class="section" id="home">
        <div class="container text-center">
        <div style="text-align: center;">
        <br>
        <h3><strong>Title OCAI</strong></h3>
    </div>
            <p class="has-line"></p>
            <div class="row mt-3">
                <div class="col-md-12 mt-3">
                    <div class="float-right">
                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#addtitleModal">Tambah Title</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
            <table id="dttable" class="table table-striped mb-0 align-middle">
            <thead>
                <tr>
                    <th class="text-center">Nama Title</th>
                    <th class="text-center" style="width: 5%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($title as $title)
                <tr>
                <td style="max-width: 100%; white-space: normal; text-align: left;">{{ $title->nama_title }}</td>
                    <td class="text-center">
                        <button class="btn btn-primary ml-2 btn-edit" data-toggle="modal" data-target="#edittitleModal"
                            data-id="{{ $title->id }}"
                            data-nama="{{ $title->nama_title }}">Edit</button>
                        <button class="btn btn-danger ml-2 btn-delete" data-id="{{ $title->id }}" data-nama="{{ $title->nama_title }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Tambah title -->
<div class="modal fade" id="addtitleModal" tabindex="-1" role="dialog" aria-labelledby="addtitleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addtitleModalLabel">Tambah Data title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('title.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_title">Nama title</label>
                        <input type="text" class="form-control" id="nama_title" name="nama_title" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Pilih Kategori</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
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

<!-- Modal Edit title -->
<div class="modal fade" id="edittitleModal" tabindex="-1" role="dialog" aria-labelledby="edittitleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edittitleModalLabel">Edit Data title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edittitleForm" method="POST" action="" class="p-3">
                @csrf
                @method('PUT')
                <input type="hidden" id="edittitleId" name="id_title">
                <div class="form-group mt-3">
                    <label for="editNamatitle">Nama title</label>
                    <input type="text" class="form-control" id="editNamatitle" name="nama_title" required>
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
    // Inisialisasi Select2 dengan ID yang benar
    $('#id_kategori').select2({
        placeholder: 'Pilih kategori',
        allowClear: true
    });

    // Inisialisasi DataTables
    $('#dttable').DataTable({
        "order": [[0, 'desc']],
    });

    // Edit button click event
    $('.btn-edit').click(function() {
        var itemId = $(this).data('id');
        $.get("{{ url('/title') }}" + '/' + itemId + '/edit', function(data) {
            if (data) {
                $('#edittitleId').val(data.id);
                $('#editNamatitle').val(data.nama_title); 
                $('#edittitleForm').attr('action', "{{ url('/title') }}" + '/' + itemId); 
                $('#edittitleModal').modal('show'); 
            } else {
                toastr.error('Data title tidak ditemukan.');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            toastr.error('Terjadi kesalahan saat mengambil data: ' + textStatus);
        });
    });

    // Delete button click event
    $('.btn-delete').click(function() {
        var itemId = $(this).data('id');
        var itemName = $(this).data('nama');
        if (confirm("Are you sure you want to delete " + itemName + "?")) {
            $.ajax({
                url: "{{ url('/title') }}" + '/' + itemId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE"
                },
                success: function(response) {
                    window.location.reload();
                    toastr.success("title berhasil dihapus");
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
