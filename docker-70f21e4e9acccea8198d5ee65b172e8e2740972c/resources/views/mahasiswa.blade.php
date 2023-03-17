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
    <div>
        <form id="formRegister">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" placeholder="NIM" maxlength="8">
            </div>
            <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Mahasiswa"
                       maxlength="20">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                       placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="number" name="semester" class="form-control" id="semester" placeholder="Semester"
                       maxlength="20">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
    <hr>
    <div>
        <h3><i class="fa fa-list"></i> Daftar Mahasiswa</h3>
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
</div>
<script>
    function init() {
        if (typeof datatable == 'undefined')
            datatable = $('#mahasiswaList').DataTable({
                ajax: "{{ config('app.url') }}/api/db/mahasiswa/list",
                columns: [
                    {data: 'id', sClass: "center"},
                    {data: 'nim'},
                    {data: 'nama'},
                    {data: 'email'},
                    {data: 'semester'}
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull, oSettings) {
                    var info = this.api().page.info();
                    var page = info.page;
                    var length = info.length;
                    var index = (page * length + (iDisplayIndex + 1));
                    $('td:eq(0)', nRow).html(index);
                    return nRow;
                }
            });
        else {
            datatable.fnClearTable(0);
            datatable.fnDraw();
        }
    }
    $(document).ready(function () {
        $('p').html('jQuery works!');
        init();
        $('#formRegister').submit(function () {
            event.preventDefault();
            console.log(JSON.stringify($("#formRegister").serializeJSON()));
            $.ajax({
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                type: "POST",
                url: "{{ config('app.url') }}/api/db/mahasiswa/save",
                data: JSON.stringify($("#formRegister").serializeJSON()),
                success: function (data) {
                    init();
                },
                dataType: 'json'
            }).error(function (error) {
                console.log(error);
            });
        })
    });
</script>
</body>
</html>
