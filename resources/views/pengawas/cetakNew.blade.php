<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="{{storage_path('app/public/img/kai.png')}}">
    <style>
        .table1 {
            border-collapse: collapse;
            border-spacing: 10px;
            font-size: 15px;
        }

        .table1 th,
        .table1 td {
            border: 1px solid black;
            padding: 2px;
        }

        .table2 {
            border-collapse: collapse;
            border-spacing: 10px;
        }

        .table2 th,
        .table2 td {
            border: 1px solid black;
            padding: 2px;
        }
    </style>
</head>

<body>
    <header>
        <table style="width: 100%;" class="table1">
            <tr>
                <td rowspan="4" style="width: 20%; margin-top: 5px;" align="center">
                    <img src="{{storage_path('app/public/img/kai.png')}}" width="100" height="60" />
                </td>
                <td rowspan="2" style="width: 30%;">
                    UMKM
                </td>
                <td style="width: 10%;">Nomor</td>
                <td style="width: 25%;">{{$kop->nomor}}</td>
            </tr>
            <tr>
                <td>Tanggal</td> 
                <td>{{$tanggal_f}}</td>
            </tr>
            <tr>
                <td rowspan="2">
                    Complaint Management System
                </td>
                <td>Versi</td>
                <td>{{$kop->versi}}</td>
            </tr>
            <tr>
                <td>Halaman</td>
                <td>{{$kop->halaman}}</td>
            </tr>
        </table>
    </header>
    <!-- <footer>
        <p>Halaman <span class="page-number"></span> dari <span class="total-pages"></span> (total halaman)</p>
    </footer> -->
    <main>
        <div class="container">
            <div style="font-family: Arial, sans-serif; font-size: 10;">
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td style="padding: 2px; width: 15%;">No. Ref</td>
                        <td style="padding: 2px; width: 2%;">:</td>
                        <td style="padding: 2px; width: 85%;">{{$lap->no_ref}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{$lap->tgl_awal_pengerjaan}}</td>
                    </tr>
                    <tr>
                        <td>Business Area</td>
                        <td>:</td>
                        <td>{{$lap->bisnis_area}}</td>
                    </tr>
                </table>
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td colspan="3" style="width: 100%;">Permintaan Layanan dari</td>
                    </tr>
                    <tr>
                        <td style="width: 20%;">Nama</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 78%;">{{$lap->nama_pelapor}}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td>{{$lap->nipp_pelapor}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$lap->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Posisi</td>
                        <td>:</td>
                        <td>{{$lap->posisi}}</td>
                    </tr>
                    <tr>
                        <td>Telepon / Email</td>
                        <td>:</td>
                        <td>{{$lap->telepon}} / {{$lap->email}}</td>
                    </tr>
                    <tr>
                        <td>Waktu Pengerjaan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{$tgl_awal_pengerjaan}} {{$lap->waktu_awal_pengerjaan}} s/d {{$tgl_akhir_pengerjaan}} {{$lap->waktu_akhir_pengerjaan}}</td>
                    </tr>
                </table>
                <br>
                <table style="width: 100%; table-layout:fixed;" class="table2">
                    <tr>
                        <td style="width: 19%;" colspan="2">Nomor Inventaris Aset</td>
                        <td style="width: 70%;" colspan="6">: {{$lap->no_inv_aset}}</td>
                    </tr>
                    <tr align="center">
                        <td style="width: 4%;" rowspan="2">No</td>
                        <td style="width: 20%;" rowspan="2">Kategori Layanan</td>
                        <td rowspan="2" colspan="2">Jenis Layanan</td>
                        <td style="width: 25%;" rowspan="2">Detail Pekerjaan</td>
                        <td style="width: 6%;" colspan="2">Status</td>
                        <td style="width: 25%;" rowspan="2">Keterangan</td>
                    </tr>
                    <tr align="center">
                        <td style="width: 3%;">V</td>
                        <td style="width: 3%;">X</td>
                    </tr>
                    <?php $no = 0; $kat = ''; $notes = ""; ?>
                    @foreach ($katjns as $row)
                    <tr>
                        <?php if ($kat != $row[1]) { $no++; $kat = $row[1]; $sub = 1; $note = ""; ?>
                            <td align="center" valign="top" rowspan="{{ $row[0] }}" style="width: 4%;">{{ $no }}</td>
                            <td valign="top" rowspan="{{ $row[0] }}" >{{ $row[1] }}</td>
                        <?php } ?>
                        <td align="center" style="width: 5%;">{{ $no }}.{{ $sub }}</td>
                        <td>{{ $row[2] }}</td>
                        <td>
                        @foreach ($detlap as $rowd)
                            @if ($rowd->kat_layanan == $kat && $rowd->jenis_layanan == $row[2])
                            {{ $rowd->det_pekerjaan }}
                            <?php if ($note != $kat) { $note = $kat; $notes = $notes . strtolower($kat) . ', '; } ?>
                            @endif
                        @endforeach
                        </td>
                        <td>
                        @foreach ($detlap as $rowd)
                            @if ($rowd->kat_layanan == $kat && $rowd->jenis_layanan == $row[2] && $rowd->status == NULL)
                            <img src="{{ storage_path('app/public/img/check.png') }}" width='15' height='15' /></i>
                            @endif
                        @endforeach
                        </td>
                        <td>
                        @foreach ($detlap as $rowd)
                            @if ($rowd->kat_layanan == $kat && $rowd->jenis_layanan == $row[2] && $rowd->status != NULL)
                            <img src="{{ storage_path('app/public/img/check.png') }}" width='15' height='15' /></i>
                            @endif
                        @endforeach
                        </td>
                        <td>
                        @foreach ($detlap as $rowd)
                            @if ($rowd->kat_layanan == $kat && $rowd->jenis_layanan == $row[2] && $rowd->status != NULL)
                            {{ $rowd->ket_pekerjaan }}
                            @endif
                        @endforeach
                        </td>
                    </tr>
                    <?php $sub++; ?>
                    @endforeach
                </table>
                <p>*v: selesai; x : gagal <br>
                    Menyatakan bahwa penanganan {{ substr($notes, 0, -2) }} telah diperiksa dan dilakukan oleh pihak sistem
                    informasi dan pihak {{$lap->nama_pelapor}} dengan hasil seperti dijelaskan diatas.</p>
                <br>
                <table style="width: 100%;">
                    <tr>
                        <td style="padding: 5px; width: 33%;" align="center">
                            {{ $role[1]->nama }}<br>
                            <img src="data:image/png;base64,{{$lap->ttd_teknisi}}" width="130px" height="100px">
                            <br>
                            <u>{{$lap->nama_teknisi}}</u><br>
                            NIP. {{$lap->nipp_teknisi}}
                        </td>
                        <td style="padding: 5px; width: 33%;"></td>
                        <td style="padding: 5px; width: 33%;" align="center">
                            {{ $role[0]->nama }}<br>
                            @if($lap->ttd_pelapor != null)
                            <img src="data:image/png;base64,{{$lap->ttd_pelapor}}" width="130px" height="100px">
                            @else
                            <img src="" alt="Tanda tangan belum ada" width="130px" height="100px">
                            @endif
                            <br>
                            <u>{{$lap->nama_pelapor}}</u><br>
                            NIP. {{$lap->nipp_pelapor}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">
                            Mengetahui,<br>
                            {{ $role[2]->nama }}<br>
                            <img src="data:image/png;base64,{{$lap->ttd_pengawas}}" width="130px" height="100px">
                            <br>
                            <u>{{$lap->nama_pengawas}}</u><br>
                            NIP. {{$lap->nipp_pengawas}}
                        </td>
                        <td> </td>
                    </tr>
                </table>
            </div>
        </div>
    </main>

</body>

</html>