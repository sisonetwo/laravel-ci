<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="{{ config('app.url') }}/css/app.css" rel="stylesheet"/>
    <script src="{{ config('app.url') }}/js/app.js"></script>
</head>
<body class="antialiased">

<div class="container">

    <p>jQuery not work!!! enable JS now</p>

    <h3>Daftar Mahasiswa</h3>
    <table id="mahasiswaList" class="table table-bordered table-striped dataTable">
        <thead>
        <tr>
            <td>No</td>
            <td>NIM</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Semester</td>
        </tr>
        </thead>
    </table>

</div>

<script>
    $(document).ready(function () {
        $('p').html('jQuery works!');
        $('#mahasiswaList').DataTable({
            ajax: '{{ config('app.url') }}/api/mahasiswa',
            columns: [
                {data: 'id'},
                {data: 'nim'},
                {data: 'name'},
                {data: 'email'},
                {data: 'semester'}
            ]
        });
    });
</script>
</body>
</html>
