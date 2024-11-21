<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use CodeIgniter\HTTP\ResponseInterface;
use PHPUnit\Framework\TestStatus\Success;

class Pelanggan extends BaseController
{
    protected $PelangganModel;
    public function __construct()
    {
        $this->PelangganModel = new PelangganModel();
    }
    public function index()
    {
        $data['pelanggans'] = $this->PelangganModel->findAll();
        return view('v_pelanggan', $data);
    }
    public function tampil_pelanggan()
    {
        $pelanggan = $this->PelangganModel->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan
        ]);
    }
    public function simpan_pelanggan()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_tlpn' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'nomor_tlpn' => $this->request->getVar('nomor_tlpn'),
        ];

        $this->PelangganModel->save($data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data pelanggan berhasil disimpan',
        ]);
    }

    public function delete($id)
    {
        $model = new PelangganModel();
        if ($model->delete($id)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus data']);
        }
    }

    // method untuk mengupdate data pelanggan
    public function updatePelanggan()
    {
        $id = $this->request->getPost('id_pelanggan');
        $data = [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'alamat'       => $this->request->getPost('alamat'),
            'nomor_tlpn'        => $this->request->getPost('nomor_tlpn'),
        ];

        if ($this->PelangganModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Pelanggan berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui pelanggan']);
        }
    }
}
