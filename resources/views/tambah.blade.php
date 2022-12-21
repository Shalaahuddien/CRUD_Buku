<!DOCTYPE html>
<html>
<head>
<title>Membuat CRUD sederhana menggunakan Laravel 9</title>
<link
rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
crossorigin="anonymous">
<script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
crossorigin="anonymous"></script>
<link
rel="stylesheet"
type="text/css"
href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
 
</head>
<body>
<center>
<h1>Membuat CRUD sederhana menggunakan Laravel 9</h1>
<!-- <h3>Afrizal's Blog</h3> -->
</center>
<br/>
<br/>
<div class="container">
@if(session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif
<form action="/tambah" method="POST" enctype="multipart/form-data">
@csrf
<table style="margin:20px auto;">

<tr>
<td>Judul Buku</td>
<td>
<input type="text" name="judul_buku" value="{{ old('judul_buku') }}">
<br>
<small class="text-danger">{{ $errors->first('judul_buku') }}</small>
</td>
</tr>

<tr>
<td>Deskripsi Buku</td>
<td>
<textarea id="w3review" name="deskripsi_buku" rows="4" cols="50">{{ old('deskripsi_buku') }}</textarea>
<br>
<small class="text-danger">{{ $errors->first('deskripsi_buku') }}</small>
</td>
</tr>

<tr>
<td>Tahun Terbit</td>
<td>
<input type="text" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
<br>
<small class="text-danger">{{ $errors->first('tahun_terbit') }}</small>
</td>
</tr>

<tr>
<td>Stok Buku</td>
<td>
<input type="number" name="stok_buku" value="{{ old('stok_buku') }}">
<br>
<small class="text-danger">{{ $errors->first('stok_buku') }}</small>
</td>
</tr>

<tr>
<td>File Gambar Sampul</td>
<td>
<input type="file" name="gambar_buku" value="{{ old('gambar_buku') }}">
<br>
<small class="text-danger">{{ $errors->first('gambar_buku') }}</small>
</td>
 
</tr>
<td></td>
<td><input type="button" onclick="window.history.back()" value="kembali"></td>
<td><input type="submit" value="Simpan"></td>
</tr>
</table>
</form>
</div>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script
src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
<script
src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
crossorigin="anonymous"></script>
<script
type="text/javascript"
src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script
type="text/javascript"
src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
$('#example').DataTable();
});
</script>
</body>
</html>