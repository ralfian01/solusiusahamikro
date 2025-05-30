@extends('template')
@section('content')
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-5">
                        <table style="color: #2D3134;">
                            <tr>
                                <td valign="top" style="height: 40px;"><b>Profile {{ $role[2]->nama }}</b></td>
                            </tr>
                            <tr>
                                <td style="width: 150px; height: 30px;">Nama</td>
                                <td style="width: 15px;">:</td>
                                <td>{{$dt->nama}}</td>
                            </tr>
                            <tr>
                                <td style="width: 150px; height: 30px;">NIK</td>
                                <td style="width: 15px;">:</td>
                                <td>{{$dt->nipp}}</td>
                            </tr>
                            <tr>
                                <td style="width: 150px; height: 30px;">Email</td>
                                <td style="width: 15px;">:</td>
                                <td>{{$dt->email}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-7">
                        <b>Tanda Tangan</b><br>
                        <table style="width: 100%;">
                            <form action="{{route('save-ttd-pengawas',$dt->id)}}" method="POST" enctype="multipart/form-data">
                                <tr>
                                    <td style="width: 50%; padding: 5px;">
                                        @if($dt->ttd == null)
                                        <i>Tanda Tangan belum di upload</i>
                                        @else
                                        <img id="img-ttd" src="data:image/png;base64,{{$dt->ttd}}" style="border: 1px #2D3134 solid;" width="150px" height="150px">
                                        @endif
                                        <p style="color: red; font-size: 11px;">*Pastikan gambar tanda tangan sudah tidak memiliki background</p>
                                    </td>
                                    <td valign="top" style="width: 50%; padding: 3px;">
                                        <div class="basic-form">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input type="file" id="ttd" name="ttd">
                                            </div>
                                            <button type="submit" class="btn btn-primary m-t-20">Submit</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
