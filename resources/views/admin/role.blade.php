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
                            <h3><span>{{ $page }}<span>Data Role</h3>
                        </div>
                    </div>
                    @if ($page == '')
                    <div class="table-responsive">
                        <table style="color: #2D3134;" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach ($rows as $row)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>
                                        <a href="{{url('role-form',$row->id)}}">
                                            <button class="btn btn-warning btn-sm" title="Ubah"><i class="fa fa-pencil text-white"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                    @endif
                    @if ($page != '')
                    <div class="basic-form">
                        <form action="{{route('role-ubah')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="col-12 col-form-label">Nama</label>
                                        <div class="col-12">
                                            <input type="text" required value="{{ $rows->nama }}" class="form-control" name="nama" placeholder="Nama" maxlength="30" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-12 col-form-label">Route</label>
                                        <div class="col-12">
                                            <input type="text" disabled value="/{{ $rows->route }}" class="form-control bg-white" />
                                        </div>
                                        <input name="id" class="key" value="{{ $rows->id }}" />
                                    </div>
                                    <div class="form-group mx-0 mt-5 px-0">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-3">Update</button>
                                            <a href="{{url('role')}}" class="btn btn-light">Batal</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive col-lg-8 col-sm-12 col-md-12">
                                    <table style="color: #2D3134;" class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th class="text-center bg-light">Menu</th>
                                                <th class="text-center bg-light" colspan="4">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach ($menu as $row)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{ $row->nama }}</td>
                                                <td>
                                                    <input name="check{{ $no }}1" {{ $row->c ? "":"disabled" }} {{ $rowds[$no-1][0] ? "checked":"" }} type="checkbox" class="mr-1" />
                                                    {{ $row->c ? $row->cc:"None" }}
                                                </td>
                                                <td>
                                                    <input name="check{{ $no }}2" {{ $row->r ? "":"disabled" }} {{ $rowds[$no-1][1] ? "checked":"" }} type="checkbox" class="mr-1" />
                                                    {{ $row->r ? $row->cr:"None" }}
                                                </td>
                                                <td>
                                                    <input name="check{{ $no }}3" {{ $row->u ? "":"disabled" }} {{ $rowds[$no-1][2] ? "checked":"" }} type="checkbox" class="mr-1" />
                                                    {{ $row->u ? $row->cu:"None" }}
                                                </td>
                                                <td>
                                                    <input name="check{{ $no }}4" {{ $row->o ? "":"disabled" }} {{ $rowds[$no-1][3] ? "checked":"" }} type="checkbox" class="mr-1" />
                                                    {{ $row->o ? $row->co:"None" }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('table').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false
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
        $('#deleteModal label').text(row.kategori)
    })
</script>
@endsection