@extends('layouts.main')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@section('content')
<section class="section" id="home">
    <div class="container text-center">
        <br>
        <h3><strong>ITEM OCAI</strong></h3>
        <p class="has-line"></p>
        <div class="row mt-3">
            <div class="col-md-12 mt-3">
                <div class="float-right">
                    <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#addtitleModal">Tambah Item</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <table id="dttable" class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Item</th>
                        <th class="text-center" style="width: 5%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($title as $title)
                        <tr>
                        <td style="max-width: 100%; white-space: normal; text-align: left;">
                            {{ $title->kategori->nama_kategori ?? '-' }}
                        </td>

                            <td style="max-width: 100%; white-space: normal; text-align: left;">{{ $title->nama_title }}</td>
                            <td class="text-center">
                            <button class="btn btn-primary ml-2 edit-button"  
                data-toggle="modal" 
                data-target="#EdittitleModal"
                data-id="{{ $title->id_title }}"
                data-nama="{{ $title->nama_title }}"
                data-kategori="{{ $title->id_kategori }}">
                Edit
            </button>
                                <form action="{{ route('title.destroy') }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$title->id_title}}">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
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

<!-- Add title Modal -->
<div class="modal fade" id="addtitleModal" tabindex="-1" role="dialog" aria-labelledby="addtitleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 20px;"> 
            <div class="modal-header">
                <h5 class="modal-title" id="addtitleModalLabel">Tambah Data Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('title.store') }}">
                @csrf
                @method('POST')
                <input type="hidden" name="id_title">
                <div class="form-group mt-3" style="margin-bottom: 15px;">
                    <label for="editKategori">Kategori</label>
                    <select class="form-control" name="id_kategori" required> <!-- Ubah kategori_id menjadi id_kategori -->
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3" style="margin-bottom: 15px;">
                    <label for="editNamatitle">Nama Item</label>
                    <textarea class="form-control" name="nama_title" rows="3" required style="width: 100%; padding: 10px; margin-bottom: 15px;"></textarea> <!-- Menambahkan margin-bottom -->
                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Title -->
<div class="modal fade" id="EdittitleModal" tabindex="-1" role="dialog" aria-labelledby="EdittitleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EdittitleLabel">Edit Data Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="editTitleForm" method="POST" action="{{ route('title.update') }}">
                @csrf
                @method('PUT') 
                <input type="hidden" id="id_title" name="id_title">
                <div class="form-group">
                    <label for="id_kategori" class="col-form-label">Kategori:</label>
                    <select class="form-control" id="id_kategori" name="id_kategori">
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                  <div class="form-group mt-3" style="margin-bottom: 15px;">
                        <label for="nama_title" class="col-form-label">Nama Title:</label>
                        <textarea class="form-control" id="nama_title" name="nama_title" rows="3" required style="width: 100%; padding: 10px; margin-bottom: 15px;"></textarea> <!-- Mengubah input menjadi textarea -->
                    </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
$(document).ready(function() {
    $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var kategori = $(this).data('kategori');

        $('#id_title').val(id);
        $('#nama_title').val(nama);
        $('#id_kategori').val(kategori);  
        $('#EdittitleModal').modal('show');
    });

    $('#saveChangesButton').on('click', function() {
        $('#editTitleForm').submit();
    });
});
</script>


@endsection
