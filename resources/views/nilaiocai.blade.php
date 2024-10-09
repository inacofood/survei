@extends('layouts.main')

@section('content')
<section class="section" id="home">
<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('kategori.index') }}" class="btn btn-primary ml-2">Master Kategori</a>
        <a href="{{ route('title.index') }}" class="btn btn-primary ml-2">Master Item</a>
        <a href="{{ route('export.ocai') }}" class="btn btn-primary ml-2">Export to Excel</a>
    </div>

    <div class="container text-center">
        <div style="text-align: center;">
            <br>
            <h3><strong>Nilai OCAI</strong></h3>
            <p class="has-line"></p>
        </div>
    </div>

    <div class="container">
        <table id="dttable" class="table table-striped table-bordered mb-0 align-middle">
            <thead>
                <tr>
                    <th style="display: none;">Id</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Kategori</th>
                    <th>Kondisi Saat Ini</th>
                    <th>Kondisi Ideal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiOcai as $data)
                <tr>
                    <td style="display: none;">{{ $data->id_nilai }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->department }}</td>
                    <td>{{ $data->id_kategori }}</td>
                    <td>
                        @if(is_array($data->nilai_saat_ini))
                            <ol type="A">
                                @foreach($data->nilai_saat_ini as $nilaiSaatIni)
                                    <li>{{ $nilaiSaatIni }}</li>
                                @endforeach
                            </ol>
                        @else
                            {{ $data->nilai_saat_ini }}
                        @endif
                    </td>
                    <td>
                        @if(is_array($data->nilai_ideal))
                            <ol type="A">
                                @foreach($data->nilai_ideal as $nilaiIdeal)
                                    <li>{{ $nilaiIdeal }}</li>
                                @endforeach
                            </ol>
                        @else
                            {{ $data->nilai_ideal }}
                        @endif
                    </td>
                    <td>
                        <!-- Delete Form -->
                        <form action="{{ route('ocai.destroy') }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$data->id_nilai}}">
                            <button type="submit" class="btn btn-danger btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete {{ $data->nama }}?');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('script')
<script>
 $(document).ready(function() {
    var table = $('#dttable').DataTable({
        paging: true,
        searching: true,
        autoWidth: false,
        order: [[0, 'desc']],
        columnDefs: [
            { "targets": 0, "visible": false }
        ],
        initComplete: function() {
            $('#custom-search').on('keyup', function() {
                table.search(this.value).draw();
            });
        }
    });
});
</script>
@endsection
