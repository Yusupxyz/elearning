<?php

class M_mapel extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('mapel');
    }

    public function tampil_data_byId($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        return $this->db->get('mapel');
    }

    public function tampil_data_kelas($nis)
    {
        $this->db->select('*,mapel.nama as nama_mapel,mapel.id as id_mapel');
        $this->db->join('mapel', 'mapel.id = kelas_mapel.id_mapel','left');
        $this->db->join('kelas_kategori', 'kelas_kategori.id = kelas_mapel.id_kelas','left');
        $this->db->join('kelas', 'kelas_kategori.id = kelas.kategori_id','left');
        $this->db->join('kelas_siswa', 'kelas_siswa.kelas_id = kelas.id','left');
        $this->db->join('siswa', 'siswa.id = kelas_siswa.siswa_id','left');
        $this->db->where('nis',$nis);
        return $this->db->get('kelas_mapel');
    }

    public function delete_mapel($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_mapel($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

}
