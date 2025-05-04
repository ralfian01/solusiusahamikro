@extends('template')

@section('content')
<div class="container-fluid">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button> <strong>Terdapat Data Serupa! {{ $error }}</strong>
    </div>
    @endforeach
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex bd-highlight mb-3">
                        <div class="mr-auto p-2 bd-highlight">
                            <h3>Data Kategori & Jenis</h3>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button class="btn btn-add btn-primary" data-toggle="modal" data-target="#formModal" data-whatever="@getbootstrap"><i class="fa fa-plus"></i> Tambah</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table style="color: #2D3134;" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jns Layanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; $kategori = ''; ?>
                                @foreach ($rows as $row)
                                @if($kategori != $row->kategori)
                                <?php $no++; $kategori = $row->kategori; ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $row->kategori }}</td>
                                    <td>
                                        <?php $jenis = ''; ?>
                                        @foreach ($rows as $rowd)
                                        @if($rowd->kategori == $row->kategori)
                                        <?php $jenis = $jenis . $rowd->jenis . ', '; ?>
                                        @endif
                                        @endforeach
                                        {{ substr($jenis, 0, -2) }}
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formModal" data-whatever="{{ json_encode([$row->id,$row->kategori,substr($jenis, 0, -2)]) }}" title="Ubah"><i class="fa fa-pencil text-white" data-whatever="{{ json_encode([$row->id,$row->kategori,substr($jenis, 0, -2)]) }}"></i></button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-whatever="{{ json_encode($row) }}" title="Hapus"><i class="fa fa-eraser"></i></button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                        </table>

                        <div class="modal fade" id="formModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{route('kategori-form')}}" method="post" autocomplete="off">
                                        {{csrf_field()}}
                                        <div class="modal-header">
                                            <h5 class="modal-title"><span></span> Kategori & Jenis</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Nama</label>
                                                    <input name="id" class="key" />
                                                    <input type="text" required class="form-control" name="nama" placeholder="Nama" maxlength="30">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Jns Layanan</label>
                                                    <input type="text" data-role="tagsinput" class="form-control" name="jenis" placeholder="Jns Layanan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="deleteModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{route('kategori-hapus')}}" method="get" autocomplete="off">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus Kategori & Jenis</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label></label>
                                                    <input name="id" class="key" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.btn-add').on('click', function(e) {
        $('#formModal h5 span').text('Tambah')
        $('#formModal input:eq(1)').val(0)
        $('#formModal input:eq(2)').val('')
        $('#formModal input:eq(3)').val('')
    })
    $('.btn-warning').on('click', function(e) {
        $('#formModal h5 span').text('Ubah')
        let button = $(e.target)
        let row = Object(button.data('whatever'))
        $('#formModal input:eq(1)').val(row[0])
        $('#formModal input:eq(2)').val(row[1])
        $('#formModal input:eq(3)').val(row[2])
        $('#formModal input:eq(3)').css('width', 'inherit')
        $('#formModal input:eq(3)').css('min-width', 'inherit')
    })
    $('#deleteModal').on('show.bs.modal', function(e) {
        let button = $(e.relatedTarget)
        let row = Object(button.data('whatever'))
        $('#deleteModal input').val(row.id)
        $('#deleteModal label').text('Apakah anda yakin menghapus '+row.kategori+' ?')
    })
</script>
@endsection