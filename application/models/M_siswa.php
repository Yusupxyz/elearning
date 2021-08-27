<?php

class M_siswa extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('*,kelas.nama as kelas,siswa.nama as siswa,siswa.id as siswa_id,kelas_siswa.kelas_id as kelas_id');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        return $this->db->get('siswa');
    }

    public function tampil_databyid($nis)
    {
        $this->db->select('*,kelas.nama as kelas,siswa.nama as siswa,siswa.id as siswa_id,kelas_siswa.kelas_id as kelas_id,kelas_kategori.id as kategori_id');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        $this->db->join('kelas_kategori', 'kelas_kategori.id = kelas.kategori_id','left');
        $this->db->where('nis',$nis);
        return $this->db->get('siswa');
    }

    public function detail_siswa($id = null)
    {
        $query = $this->db->get_where('siswa', array('id' => $id))->row();
        return $query;
    }

    public function delete_siswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_siswa($where, $table)
    {
        $this->db->select('*,kelas.nama as kelas,siswa.nama as siswa,siswa.id as siswa_id,kelas_siswa.kelas_id as kelas_id');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
