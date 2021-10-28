<?php

class M_tugas extends CI_Model
{
    public function tampil_data_bynip($nip)
    {
        $this->db->select('*,tugas.id as tugas_id');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->join('guru', 'guru.nip = tugas.nip','left');
        $this->db->join('tugas_kelas', 'tugas_kelas.tugas_id = tugas.id','left');
        $this->db->join('kelas', 'tugas_kelas.kelas_id = kelas.id','left');
        $this->db->where('tugas.nip',$nip);
        return $this->db->get('tugas');
    }

    public function tampil_data_byid($id)
    {
        $this->db->select('*, tugas.id as tugas, mapel.nama as mapel, guru.nama_guru as guru, kelas.nama as kelas');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->join('guru', 'guru.nip = tugas.nip','left');
        $this->db->join('tugas_kelas', 'tugas_kelas.tugas_id = tugas.id','left');
        $this->db->join('kelas', 'tugas_kelas.kelas_id = kelas.id','left');
        $this->db->where('tugas.id',$id);
        return $this->db->get('tugas');
    }

    public function tampil_soal($id)
    {
        $this->db->select('*,tugas_pertanyaan.id as pertanyaan_id');
        $this->db->join('tugas', 'tugas_pertanyaan.tugas_id = tugas.id','left');
        $this->db->where('tugas_pertanyaan.tugas_id',$id);
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get('tugas_pertanyaan');
    }

    public function tampil_jawaban($id)
    {
        $this->db->select('*, kelas.nama as kelas, jawaban.id as jawaban, siswa.nama as nama_siswa');
        $this->db->join('siswa', 'siswa.nis = jawaban.siswa_id','left');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        $this->db->where('tugas_id',$id);
        // $this->db->order_by('urutan', 'ASC');
        return $this->db->get('jawaban');
    }

    public function tampil_jawabanById($tugas_id,$id)
    {
        $this->db->select('*, kelas.nama as kelas, jawaban.id as jawaban_id, siswa.nama as nama_siswa');
        $this->db->join('siswa', 'siswa.nis = jawaban.siswa_id','left');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        $this->db->where('jawaban.tugas_id',$tugas_id);
        $this->db->where('jawaban.id',$id);
        // $this->db->order_by('urutan', 'ASC');
        return $this->db->get('jawaban');
    }

    public function tampil_pilihan($id)
    {
        $this->db->select('*,pilihan.urutan as pilihan_urutan,pilihan.id as pilihan_id');
        $this->db->join('tugas_pertanyaan', 'tugas_pertanyaan.id = pilihan.pertanyaan_id','left');
        $this->db->where('pilihan.pertanyaan_id',$id);
        return $this->db->get('pilihan');
    }

    public function kunci($id)
    {
        $this->db->select('*,pilihan.urutan as pilihan_urutan,pilihan.id as pilihan_id');
        $this->db->join('tugas_pertanyaan', 'tugas_pertanyaan.id = pilihan.pertanyaan_id','left');
        $this->db->where('tugas_pertanyaan.tugas_id',$id);
        $this->db->where('kunci','1');
        return $this->db->get('pilihan');
    }

    public function count_pertanyaan($id)
    {
        $this->db->select('count(*) as count');
        $this->db->where('tugas_pertanyaan.tugas_id',$id);
        return $this->db->get('tugas_pertanyaan');
    }

    public function update_soal($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_tugas($where, $table)
    {
        $this->db->select('*, tugas.info as tugas_info, tugas.id as tugas_id');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->join('tugas_kelas', 'tugas_kelas.tugas_id = tugas.id','left');
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete_soal($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function tampil_databyid1($nis)
    {
        $this->db->select('*,mapel.nama as mapel,mapel.id as mapel_id,tugas.id as tugas_id');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->join('tugas_kelas', 'tugas_kelas.id = kelas.id','left');
        $this->db->join('tugas', 'tugas.id = tugas_kelas.tugas_id','right');
        $this->db->where('nis',$nis);
        $this->db->where('tgl_akhir < now()');
        $this->db->group_by("tugas.mapel_id");
        return $this->db->get('siswa');
    }

    public function tampil_databyid($nis)
    {
        $this->db->select('*,mapel.nama as mapel,mapel.id as mapel_id, jawaban.id as jawaban, tugas.id as tugas_id');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        $this->db->join('tugas_kelas', 'tugas_kelas.kelas_id = kelas.id','left');
        $this->db->join('tugas', 'tugas.id = tugas_kelas.tugas_id','right');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->join('guru', 'guru.nip = tugas.nip','left');
        $this->db->join('jawaban', 'jawaban.tugas_id = tugas.id','left');
        $this->db->where('nis',$nis);
        // $this->db->where('date(tgl_akhir) >= now()');
        $this->db->where('tampil_siswa','1');
        $this->db->group_by("tugas.mapel_id");
        return $this->db->get('siswa');
    }

    public function tampil_dataNilaibyid($nis)
    {
        $this->db->select('*,mapel.nama as mapel,mapel.id as mapel_id, jawaban.id as jawaban, tugas.id as tugas_id');
        $this->db->join('kelas_siswa', 'kelas_siswa.siswa_id = siswa.id','left');
        $this->db->join('kelas', 'kelas.id = kelas_siswa.kelas_id','left');
        $this->db->join('tugas_kelas', 'tugas_kelas.kelas_id = kelas.id','left');
        $this->db->join('tugas', 'tugas.id = tugas_kelas.tugas_id','right');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->join('guru', 'guru.nip = tugas.nip','left');
        $this->db->join('jawaban', 'jawaban.tugas_id = tugas.id','left');
        $this->db->where('nis',$nis);
        // $this->db->where('date(tgl_akhir) >= now()');
        $this->db->where('tampil_siswa','1');
        $this->db->where('jawaban.id!="null"');
        $this->db->group_by("tugas.mapel_id");
        return $this->db->get('siswa');
    }

    public function data($tugas,$kelas)
    {
        $this->db->select('*,tugas.id as tugas');
        $this->db->join('tugas_kelas', 'tugas_kelas.tugas_id = tugas.id','left');
        $this->db->join('jawaban', 'jawaban.tugas_id = tugas.id','left');
        $this->db->join('guru', 'guru.nip = tugas.nip','left');
        $this->db->where('kelas_id', $kelas);
        $this->db->where('mapel_id', $tugas);
        return $this->db->get('tugas');
    }

    public function kerjakan($id = null)
    {
        $this->db->select('*,mapel.nama as mapel, kelas.nama as kelas,tugas.id as tugas_id ');
        $this->db->join('tugas_kelas', 'tugas_kelas.tugas_id = tugas.id','left');
        $this->db->join('kelas', 'kelas.id = tugas_kelas.kelas_id','left');
        $this->db->join('mapel', 'mapel.id = tugas.mapel_id','left');
        $this->db->where('tugas.id', $id);
        return $this->db->get('tugas')->row();
    }

    public function pertanyaan($id = null)
    {
        $this->db->select('*,tugas_pertanyaan.id as tugas_pertanyaan,tugas.id as tugas_id');
        $this->db->join('tugas', 'tugas.id = tugas_pertanyaan.tugas_id','left');
        $this->db->where('tugas.id', $id);
        return $this->db->get('tugas_pertanyaan');
    }

    public function pilihan($id = null)
    {
        $this->db->where('pilihan.pertanyaan_id', $id);
        return $this->db->get('pilihan');
    }

    public function getDurasi($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tugas')->row();
    }
    

}
