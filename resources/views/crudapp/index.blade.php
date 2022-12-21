<html>
    <head>
        <title>Membuat CRUD sederhana menggunakan Laravel 9</title>
        <link
           rel="stylesheet"
           href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
           integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
           crossorigin="anonymous">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
   
        <script
           src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
           integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
           crossorigin="anonymous"></script>
        <link
           rel="stylesheet"
           type="text/css"
           href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
 
        <!-- Font Awesome JS -->
        <script
           defer="defer"
           src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
           integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
           crossorigin="anonymous"></script>
        <script
           defer="defer"
           src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
           integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
           crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
    </head>
    <body>
        <center>
            <h1>Membuat CRUD sederhana menggunakan Laravel 9</h1>
            <!-- <h3>Afrizal's Blog</h3> -->
        </center>
        <br/>
        <br/>
        <div class="container">
            <a class="btn btn-primary" href="{{ route('tambahData') }}">Tambah data</a>
 
            <table
               id="crudapp"
               class="table table-striped table-bordered"
               style="width:100%">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tahun Terbit</th>
                        <th>Stok Buku</th>
                        <th>Gambar Buku</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($buku as $b)
                    <tr>
                        <td>{{$b->judul_buku}}</td>
                        <td>{{$b->deskripsi_buku}}</td>
                        <td>{{$b->tahun_terbit}}</td>
                        <td><img src="{{$b->gambar_buku}}" alt=""></td>
                        <!-- <td>Action</td> -->
                        <td>
                        <a href="/{{$b->id}}/ubah">
                            <button type="button" class="btn btn-edit">edit</button>
                        </a>
                      
                        <a href="{{$b->id}}/hapus">
                            <button type="button" class="btn btn-destroy">Delete</button>
                        </a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
 
        </div>
 
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
                // tabel data
                $('#crudapp').DataTable({
                    "serverSide": true,
                    "processing": true,
                    "ajax": {
                        "url": "{{ route('index') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            _token: "{{csrf_token()}}"
                        }
                    },
                    "columns": [
                        {
                            "data": "judul_buku"
                        }, {
                            "data": "tahun_terbit"
                        }, {
                            "data": "stok_buku"
                        }, {
                            "data": "gambar_buku"
                        }, {
                            "data": "options"
                        }
                    ],
                    "language": {
                        "decimal": "",
                        "emptyTable": "Tak ada data yang tersedia pada tabel ini",
                        "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                        "infoFiltered": "(difilter dari _MAX_ total entri)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Tampilkan _MENU_ entri",
                        "loadingRecords": "Loading...",
                        "processing": "Sedang Mengambil Data...",
                        "search": "Pencarian:",
                        "zeroRecords": "Tidak ada data yang cocok ditemukan",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        },
                        "aria": {
                            "sortAscending": ": aktifkan untuk mengurutkan kolom ascending",
                            "sortDescending": ": aktifkan untuk mengurutkan kolom descending"
                        }
                    }
 
                });
 
                // hapus data
                $('#crudapp').on('click', '.hapusData', function () {
                    var id = $(this).data("id");
                    var url = $(this).data("url");
                    Swal
                        .fire({
                            title: 'Apa kamu yakin?',
                            text: "Kamu tidak akan dapat mengembalikan ini!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                // console.log();
                                $.ajax({
                                    url: url,
                                    type: 'DELETE',
                                    data: {
                                        "id": id,
                                        "_token": "{{csrf_token()}}"
                                    },
                                    success: function (response) {
                                        // console.log();
                                        Swal.fire('Terhapus!', response.msg, 'success');
                                        $('#crudapp').DataTable().ajax.reload();
                                    }
                                });
                            }
                        })
                });
            });
        </script>
        {{-- <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script> --}}
    </body>
</html>