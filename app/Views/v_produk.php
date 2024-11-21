<?php

use App\Models\ProdukModel;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
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
                <h3 class="text-center">Data Produk</h3>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahProduk"> <i class="fa-solid fa-cart-plus"></i> Tambah Produk</button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="container mt-5">
                        <table class="table table-bordered" id="produkTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal untuk tambah produk -->
            <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahProduk" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h1 class="modal-title fs-5" id="modalTambahProdukLabel">Tambah Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formProduk">
                                <div class="row mb-3">
                                    <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="hargaProduk" class="col-sm-4 col-from-label">Harga</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.01" class="form-control" id="hargaProduk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="stokProduk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gambarProduk" class="col sm-4 col-form-label">Gambar Produk</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="gambarProduk" name="gambarProduk" accept="image/*">
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="simpanProduk" class="btn btn-primary float-end">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir modal tambah produk -->

            <!-- Ini modal untuk edit -->
            <div class="modal fade" id="modalEditProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditProduk" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h1 class="modal-title fs-5" id="modalEditProduk">Edit Produk</h1>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formProduk">
                                <div class="row mb-3">
                                    <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="namaProdukEdit" name="namaProduk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="hargaProduk" class="col-sm-4 col-from-label">Harga</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.01" class="form-control" id="hargaProdukEdit">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="stokProdukEdit">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gambarProdukedit" class="col sm-4 col-form-label">Gambar Produk</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="gambarProdukedit" name="gambarProduk" accept="image/*">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="editProdukSimpan">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir modal edit produk-->

            <script>
                //ini kode untuk menampilkan tabel produk
                function tampilProduk() {
                    $.ajax({
                        url: '<?= base_url('produk/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {
                                var produkTable = $('#produkTable tbody');
                                produkTable.empty(); //kosongkan tabel terlebih dahulu

                                var produk = hasil.produk;
                                var no = 1;

                                //looping untuk memasukkan data ke dalam table
                                produk.forEach(function(item) {
                                    var row = '<tr>' +
                                        '<td>' + no + '</td>' + //0
                                        '<td>' + item.nama_produk + '</td>' + //1
                                        '<td>' + item.harga + '</td>' + //2
                                        '<td>' + item.stok + '</td>' + //3
                                        '<td>' + item.produk + '</td>' + //4
                                        '<td>' +
                                        '<button class="btn btn-warning btn-sm editProduk" data-id="' + item.produk_id + '" data-bs-toggle="modal" data-bs-target="#modalEditProduk"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger btn-sm hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash-can"></i>Hapus</button> ' +
                                        '</td>' +
                                        '</tr>';
                                    produkTable.append(row); // maksudnya produk tabel di append/ditambahkan row diatas ini
                                    no++;
                                });

                            } else {
                                alert('Gagal mengambil data. ');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                        // xhr: Objek XMLHttpRequest yang memuat informasi tentang permintaan,
                        // termasuk respons server jika ada.
                        // status: Status kesalahan,
                        // seperti "timeout",
                        // "error",
                        // atau "abort".
                        // error: Pesan kesalahan, 
                        // biasanya berisi deskripsi masalah.
                    });
                }

                // tambah
                $(document).ready(function() {
                    tampilProduk(); //ini digunakan untuk menampilkan daftar produk dari database
                    $("#simpanProduk").on("click", function() { //maksdunya fungsi simpan ini akan berfungsi jika tombol click nya ditekan
                        var formData = {
                            nama_produk: $('#namaProduk').val(),
                            harga: $('#hargaProduk').val(),
                            stok: $('#stokProduk').val(),
                            produk: $('#gambarProduk').val()

                        };

                        $.ajax({
                            url: '<?= base_url('produk/simpan'); ?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function(hasil) {
                                if (hasil.status === 'success') {
                                    Swal.fire({
                                        title: "Good job!",
                                        text: "You clicked the button!",
                                        icon: "success"
                                    });
                                    $('#modalTambahProduk').modal('hide');
                                    $('#gambarProduk').files[0];
                    
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
                    $(document).on('click', '.hapusProduk', function() {
                        var row = $(this).closest('tr');
                        var id = $(this).data('id');

                        if (confirm('Apakah anda yakin ingin menghapus produk ini')) {
                            $.ajax({
                                url: '<?= base_url('produk/hapus/') ?>' + id,
                                type: 'DELETE',
                                dataType: 'json',
                                success: function(response) {
                                    console.log(response);
                                    if (response.success) {
                                        Swal.fire({
                                            title: "Yess!",
                                            text: "Data Berhasil di Hapus",
                                            icon: "success"
                                        });
                                        tampilProduk();
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
                });

                //edit
                $(document).on('click', '.editProduk', function() {
                    var row = $(this).closest('tr');
                    document.getElementById('namaProdukEdit').value = row.find('td:eq(1)').text() // ini untuk memanggil data dari data yang lama
                    document.getElementById('hargaProdukEdit').value = row.find('td:eq(2)').text() // ini untuk memamnggil data dari data yang lama
                    document.getElementById('stokProdukEdit').value = row.find('td:eq(3)').text() // ini untuk memanggil data dari data yang lama
                    var id = $(this).data('id');
                    $('#editProdukSimpan').off('click').on('click', function() {
                        var formData = {
                            'id_produk': id,
                            'nama_produk': document.getElementById('namaProdukEdit').value,
                            'harga': document.getElementById('hargaProdukEdit').value,
                            'stok': document.getElementById('stokProdukEdit').value
                        }

                        if (confirm('Apakah anda yakin ingin edit produk ini')) {
                            $.ajax({
                                url: '<?= base_url('produk/updateProduk') ?>',
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
                                        $("#modalEditProduk").modal('hide') // untuk menyembunyikan modal ketika sudah selesai di edit
                                        tampilProduk();
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
            </script>
        </div>
    </div>
</body>

<!-- Link jQuery-->
<script src="<?= base_url('asset/jquery-3.7.1.min.js') ?>"></script>
<!-- Link Bootstrap JS -->
<script src="<?= base_url('asset/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ini untuk swetallert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</html>