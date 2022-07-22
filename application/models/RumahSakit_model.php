<?php

class RumahSakit_model extends CI_Model
{
    // function untuk menampilkan data dari tabel rumah_sakit_jakarta
    public function getRumahSakit($kode = null)
    {
        if ($kode === null) {
            return $this->db->get('rumah_sakit_jakarta')->result_array();
        } else {
            return $this->db->get_where('rumah_sakit_jakarta', ['kode_rumah_sakit' => $kode])->result_array();
        }
    }

    // function untuk menghapus data dari tabel rumah_sakit_jakarta
    public function deleteRumahSakit($kode)
    {
        $this->db->delete('rumah_sakit_jakarta', ['kode_rumah_sakit' => $kode]);
        return $this->db->affected_rows();
    }

    // function untuk menambah data dari tabel rumah_sakit_jakarta
    public function createRumahSakit($data)
    {
        $this->db->insert('rumah_sakit_jakarta', $data);
        return $this->db->affected_rows();
    }

    // function untuk memperbarui data dari tabel rumah_sakit_jakarta
    public function updateRumahSakit($data, $kode)
    {
        $this->db->update('rumah_sakit_jakarta', $data, ['kode_rumah_sakit' => $kode]);
        return $this->db->affected_rows();
    }
}
