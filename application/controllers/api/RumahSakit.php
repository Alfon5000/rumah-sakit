<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class RumahSakit extends REST_Controller
{
    // constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RumahSakit_model', 'rumah_sakit');
        $this->methods['index_get']['limit'] = 5;
        $this->methods['index_post']['limit'] = 5;
        $this->methods['index_put']['limit'] = 5;
        $this->methods['index_delete']['limit'] = 5;
    }

    // function menampilkan data
    public function index_get()
    {
        $kode = $this->get('kode_rumah_sakit');

        // menampilkan seluruh data
        if ($kode === null) {
            $rumah_sakit = $this->rumah_sakit->getRumahSakit();
            // menampilkan data berdasarkan kode
        } else {
            $rumah_sakit = $this->rumah_sakit->getRumahSakit($kode);
        }

        // jika berhasil
        if ($rumah_sakit) {
            $this->response([
                'status' => true,
                'data' => $rumah_sakit
            ], REST_Controller::HTTP_OK);
            // jika kode tidak ditemukan
        } else {
            $this->response([
                'status' => false,
                'data' => 'Kode rumah sakit tidak ditemukan!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // function menghapus data
    public function index_delete()
    {
        $kode = $this->delete('kode_rumah_sakit');

        // jika tidak memasukkan kode
        if ($kode === null) {
            $this->response([
                'status' => false,
                'message' => 'Kode rumah sakit belum dimasukkan!'
            ], REST_Controller::HTTP_BAD_REQUEST);
            // jika memasukkan kode
        } else {
            // jika berhasil menghapus
            if ($this->rumah_sakit->deleteRumahSakit($kode) > 0) {
                $this->response([
                    'status' => true,
                    'kode_rumah_sakit' => $kode,
                    'message' => 'Data rumah sakit berhasil dihapus.'
                ], REST_Controller::HTTP_OK);
                // jika kode tidak ditemukan
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Kode rumah sakit tidak ditemukan!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    // function untuk menambahkan data
    public function index_post()
    {
        $data = [
            'kode_rumah_sakit' => $this->post('kode_rumah_sakit'),
            'nama_rumah_sakit' => $this->post('nama_rumah_sakit'),
            'jenis_rumah_sakit' => $this->post('jenis_rumah_sakit'),
            'alamat_rumah_sakit' => $this->post('alamat_rumah_sakit'),
            'kelurahan' => $this->post('kelurahan'),
            'kecamatan' => $this->post('kecamatan'),
            'kota_administrasi' => $this->post('kota_administrasi'),
            'kode_pos' => $this->post('kode_pos'),
            'nomor_telepon' => $this->post('nomor_telepon'),
            'nomor_fax' => $this->post('nomor_fax'),
            'website' => $this->post('website'),
            'email' => $this->post('email'),
            'telepon_humas' => $this->post('telepon_humas')
        ];

        // jika berhasil
        if ($this->rumah_sakit->createRumahSakit($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data rumah sakit berhasil ditambahkan.'
            ], REST_Controller::HTTP_CREATED);
            // jika kode tidak ditemukan
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data rumah sakit gagal ditambahkan!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // function untuk memperbarui data
    public function index_put()
    {
        // kenapa dibedakan agar kode masuk ke where
        $kode = $this->put('kode_rumah_sakit');
        $data = [
            'kode_rumah_sakit' => $this->put('kode_rumah_sakit'),
            'nama_rumah_sakit' => $this->put('nama_rumah_sakit'),
            'jenis_rumah_sakit' => $this->put('jenis_rumah_sakit'),
            'alamat_rumah_sakit' => $this->put('alamat_rumah_sakit'),
            'kelurahan' => $this->put('kelurahan'),
            'kecamatan' => $this->put('kecamatan'),
            'kota_administrasi' => $this->put('kota_administrasi'),
            'kode_pos' => $this->put('kode_pos'),
            'nomor_telepon' => $this->put('nomor_telepon'),
            'nomor_fax' => $this->put('nomor_fax'),
            'website' => $this->put('website'),
            'email' => $this->put('email'),
            'telepon_humas' => $this->put('telepon_humas')
        ];

        // jika berhasil
        if ($this->rumah_sakit->updateRumahSakit($data, $kode) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data rumah sakit berhasil diperbarui.'
            ], REST_Controller::HTTP_OK);
            // jika kode tidak ditemukan
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data rumah sakit gagal diperbarui!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
