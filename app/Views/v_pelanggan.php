<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css') ?>">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-6.6.0-web/css/all.min.css') ?>">
    <!-- Link jQuery-->
    <script src="<?= base_url('asset/jquery-3.7.1.min.js') ?>"></script>
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="text-center">Data Pelanggan</h3>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan"> <i class="fa-solid fa-user"></i>Tambah Pelanggan</button>
            </div>
            <div class="row">
                <div class="container mt-5">
                    <table class="table table-borderes" id="pelangganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal untuk tambah pelanggan -->
        <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahPelanggan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="modalTambahPelangganLabel">Tambah Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPelanggan">
                            <div class="row mb-3">
                                <label for="namaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamatPelanggan" class="col-sm-4 col-from-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" step="0.01" class="form-control" id="alamatPelanggan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomorTelepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="nomorTelepon">
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="simpanPelanggan" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalSimpanPelanggan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir modal tambah pelanggan -->

        <!-- Ini modal untuk edit -->
        <div class="modal fade" id="modalEditPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditPelanggan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h1 class="modal-title fs-5" id="modalEditPelanggan">Edit Pelanggan</h1>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPelanggan">
                            <div class="row mb-3">
                                <label for="namaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namaPelangganEdit" name="namaPelanggan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamatPelanggan" class="col-sm-4 col-from-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" step="0.01" class="form-control" id="alamatPelangganEdit">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomorTeleponEdit" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="nomorTeleponEdit">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="editPelangganSimpan">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir modal edit pelanggan-->


        <script>
            //ini kode untuk menampilkan tabel produk
            $(document).ready(function() {
                function tampilPelanggan() {
                    $.ajax({
                        url: '<?= base_url('pelanggan/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(hasil) {
                            // console.log(hasil);

                            if (hasil.status === 'success') {
                                var pelangganTable = $('#pelangganTable tbody');
                                pelangganTable.empty();

                                var pelanggan = hasil.pelanggan;
                                var no = 1;

                                //looping untuk memasukkan data ke dalam table
                                pelanggan.forEach(function(item) {
                                    // console.log(item.id_pelanggan);
                                    var row = '<tr>' +
                                        '<td>' + no + '</td>' + //0
                                        '<td>' + item.nama_pelanggan + '</td>' + //1
                                        '<td>' + item.alamat + '</td>' + //2
                                        '<td>' + item.nomor_tlpn + '</td>' + //3
                                        '<td>' +
                                        '<button class="btn btn-warning btn-dm editPelanggan" id="' + item.id_pelanggan + '" data-bs-toggle="modal" data-bs-target="#modalEditPelanggan"><i class="fa-solid fa-pencil"-ca></i> Edit </button> ' +
                                        '<button class="btn btn-danger btn-sm hapusPelanggan" id="' + item.id_pelanggan + '"><i class="fa-solid fa-trash-can"></i>Hapus</button>' +
                                        '</td>'
                                    '</tr>'
                                    pelangganTable.append(row) //maksudnya pelanggan tabel di append/ditambahkan row diatas ini
                                    no++
                                });
                            } else {
                                alert('Gagal Mengambil Data. ');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                }

                //tambah
                tampilPelanggan(); //ini digunakan untuk menampilkan daftar pelanggan dari database
                $("#simpanPelanggan").on("click", function() {
                    var formData = {
                        nama_pelanggan: $('#namaPelanggan').val(),
                        alamat: $('#alamatPelanggan').val(),
                        nomor_tlpn: $('#nomorTelepon').val()

                    };
                    $.ajax({
                        url: '<?= base_url('pelanggan/simpan'); ?>',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {

                                Swal.fire({
                                    title: "Good job!",
                                    text: "Data berhasil ditambahkan",
                                    icon: "success"
                                });
                                $('#modalTambahPelanggan').modal('hide');

                            } else {
                                Swal.fire({
                                    title: "Woopss1",
                                    text: "Data tidak berhasil di tambah",
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi Kesalahan: ' + error);
                        }
                    });
                });

                //hapus
                $('#pelangganTable').on('click', '.hapusPelanggan', function() {
                    var row = $(this).closest('tr');
                    var id = $(this).attr('id');

                    if (confirm('Apakah anda yakin ingin menghapus pelanggan ini')) {
                        $.ajax({
                            url: '<?= base_url('pelanggan/hapus/') ?>' + id,
                            type: 'delete',
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.success) {
                                    Swal.fire({
                                        title: "Yess!",
                                        text: "Data Berhasil di Hapus",
                                        icon: "success"
                                    });
                                    tampilPelanggan();
                                } else {
                                    Swal.fire({
                                        title: "Woopss1",
                                        text: "Data tidak berhasil di hapus",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('terjadi kesalahan saat menghapus item. ');
                            }
                        });
                    }
                });

                //edit
                $('#pelangganTable').on('click', '.editPelanggan', function() {
                    var row = $(this).closest('tr');
                    document.getElementById('namaPelangganEdit').value = row.find('td:eq(1)').text() // ini untuk memanggil data dari data yang lama
                    document.getElementById('alamatPelangganEdit').value = row.find('td:eq(2)').text() // ini untuk memamnggil data dari data yang lama
                    document.getElementById('nomorTeleponEdit').value = row.find('td:eq(3)').text() // ini untuk memanggil data dari data yang lama
                    var id = $(this).attr('id');
                    $('#editPelangganSimpan').off('click').on('click', function() {
                        var formData = {
                            'id_pelanggan': id,
                            'nama_pelanggan': document.getElementById('namaPelangganEdit').value,
                            'alamat': document.getElementById('alamatPelangganEdit').value,
                            'nomor_tlpn': document.getElementById('nomorTeleponEdit').value
                        }

                        if (confirm('Apakah anda yakin ingin edit pelanggan ini')) {
                            $.ajax({
                                url: '<?= base_url('pelanggan/updatePelanggan') ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: formData,
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            title: "Yess!",
                                            text: "Data Berhasil di Edit",
                                            icon: "success"
                                        });
                                        // alert(response.message);
                                        $("#modalEditPelanggan").modal('hide') // untuk menyembunyikan modal ketika sudah selesai di edit
                                        tampilPelanggan();
                                    } else {
                                        Swal.fire({
                                            title: "Woopss1",
                                            text: "Data tidak berhasil di edit",
                                            icon: "error"
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('terjadi kesalahan saat edit item. ');
                                }
                            });
                        }
                    })
                });
            });
        </script>
</body>

<!-- Link jQuery-->
<script src="<?= base_url('asset/jquery-3.7.1.min.js') ?>"></script>
<!-- Link Bootstrap JS -->
<script src="<?= base_url('asset/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ini untuk swetallert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>