<?php

class M_kelas extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('kelas');
    }

    public function tampil_data_by_id($id)
    {
        $this->db->select('*,kelas.id as kelas');
        $this->db->join('kelas_kategori', 'kelas.kategori_id = kelas_kategori.id','left');
        $this->db->join('kelas_mapel', 'kelas_kategori.id = kelas_mapel.id_kelas','left');
        $this->db->where('id_mapel',$id);
        return $this->db->get('kelas');
    }

    public function tampil_data_by_nip($nip)
    {
        $this->db->select('*,kelas.id as kelas');
        $this->db->join('kelas', 'kelas.id = kelas_guru.id_kelas','left');
        $this->db->where('kelas_guru.id_guru',$nip);
        return $this->db->get('kelas_guru');
    }

    public function tampil_data_by_id_kelas($id)
    {
        $this->db->select('*');
        $this->db->where('kelas.id',$id);
        return $this->db->get('kelas');
    }

    function get_category(){
        return $this->db->get('kelas_kategori');
    }

    public function delete_mapel($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_kelas($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

}
