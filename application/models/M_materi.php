<?php

class M_materi extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('*,materi.id as materi_id');
        $this->db->join('mapel', 'mapel.id = materi.nama_mapel','left');
        return $this->db->get('materi');
    }

    public function tampil_data_bynip($nip)
    {
        $this->db->select('*,materi.id as materi_id');
        $this->db->join('mapel', 'mapel.id = materi.nama_mapel','left');
        $this->db->join('guru', 'guru.nip = materi.nama_guru','left');
        $this->db->join('kelas', 'kelas.id = materi.kelas','left');
        $this->db->where('nip',$nip);
        return $this->db->get('materi');
    }

    public function belajar($id = null)
    {
        $query = $this->db->get_where('materi', array('id' => $id))->row();
        return $query;
    }

    public function detail_materi($id = null)
    {
        $query = $this->db->get_where('materi', array('id' => $id))->row();
        return $query;
    }

    public function delete_materi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_materi($where, $table)
    {
        $this->db->select('*,materi.id as materi_id');
        $this->db->join('mapel', 'mapel.id = materi.nama_mapel','left');
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function data($mapel,$kelas)
    {
        $this->db->where('kelas', $kelas);
        $this->db->where('nama_mapel', $mapel);
        return $this->db->get('materi');
    }

   
}
