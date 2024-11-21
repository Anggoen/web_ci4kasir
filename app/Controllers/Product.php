<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;
use PHPUnit\Framework\TestStatus\Success;

class Product extends BaseController
{
    protected $ProdukModel;
    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
    }
    public function index()
    {
        $data['products'] = $this->ProdukModel->findAll();
        return view('v_produk', $data);
    }
    public function tampil_produk()
    {
        $produk = $this->ProdukModel->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'produk' => $produk
        ]);
    }
    public function simpan_produk()
    {
        //validasi input dari ajax
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_produk' => 'required',
            'harga' => 'required|decimal',
            'stok' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ];

        $this->ProdukModel->save($data);

        return $this->response->setJSON([
            'status'    => 'success',
            'message'   => 'Data produk berhasil disimpan',
        ]);
    }
    public function delete($id)
    {
        $model = new ProdukModel();
        if ($model->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data']);
        }
    }
    // method untuk mengupdate data produk
    public function updateProduk()
    {
        $id = $this->request->getPost('id_produk');
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
        ];

        if ($this->ProdukModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui produk']);
        }
    }
}
