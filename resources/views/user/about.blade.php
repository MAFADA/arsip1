<!DOCTYPE html>
<html>
<head>
    <title>Archive Lihat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>About</h2>
            </div>
        </div>
        <div>
            <img src="public/photo/2031710168.jpg" alt="" width="200" height="300">
        </div>
        <div>
            <p>
                Aplikasi ini dibuat oleh: <br>
                Nama: M. Afada Nur Saiva Syahira <br>
                NIM: 2141764168 <br>
                Tanggal: 11 Oktober 2022 <br>
            </p>
        </div>

        <div class="pull-right">
            <br><br><br><br>
            <a class="btn btn-primary" href="{{ route('archive.index') }}"> Kembali</a>
        </div>
    </div>
</div>


</body>
</html>
