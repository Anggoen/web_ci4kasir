<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('products', 'Product::index');
$routes->get('/produk/tampil', 'Product::tampil_produk');
$routes->post('produk/simpan', 'Product::simpan_produk');
$routes->delete('produk/hapus/(:num)', 'Product::delete/$1');
$routes->post('produk/updateProduk', 'Product::updateProduk');



$routes->get('pelanggans', 'Pelanggan::index');
$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');
$routes->post('pelanggan/simpan', 'Pelanggan::simpan_pelanggan');
$routes->delete('pelanggan/hapus/(:num)', 'Pelanggan::delete/$1');
$routes->post('pelanggan/updatePelanggan', 'Pelanggan::updatePelanggan');
