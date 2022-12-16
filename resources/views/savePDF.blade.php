<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan.pdf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="row g-0">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h1 class="text-center">{{$title}}</h1>
            <h2 class="text-center">{{$toko}}</h2>
            <h5 class="text-center">Untuk Periode {{$periode}} pada Tahun {{$tahun}} terhitung hingga tanggal {{$last_period}}</h5>
            <p class="text-center">{{$date}}</p><br><br>
            <div class="row">
              <div class="col-sm-8">
                Kesimpulan Laporan Periode ini = <br>
                <br>Total Barang:
                <br>Total Transaksi:
                <br>Total Kategori:
              </div>
              <div class="col-sm-4">Keseluruhan = <br>
                <br>Total Barang:
                <br>Total Transaksi:
                <br>Total Kategori:
              </div>
            </div>
            <br><hr><br>
            <div>
              <table class="table table-striped">
                <thead>
                  <th>No</th>
                  <th>Barang</th>
                  <th>Kategori</th>
                  <th>Status</th>
                  <th>jumlah</th>
                </thead>
                @php
                    $i = 1;
                @endphp
                @foreach ($laporan as $laporan)
                  <tbody>
                    <td>{{$i++}}</td>
                    <td>{{$laporan->nama}}</td>
                    <td>{{$laporan->kategori}}</td>
                    <td>{{$laporan->status}}</td>
                    <td>{{$laporan->jumlah}}</td>
                  </tbody>
                @endforeach

              </table>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
