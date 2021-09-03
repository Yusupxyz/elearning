<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('disqus');
        $this->load->model('m_materi');
    }

    function lihatNilai($mapel,$tugas_id){
    
    
        $this->load->model('m_siswa');
        $this->load->model('m_tugas');
        $data['jawaban'] = $this->m_tugas->tampil_jawabanById($tugas_id,$this->session->userdata('nis'))->row();
            $data['kunci']= $this->m_tugas->kunci($tugas_id)->result_array();
        $data['user'] = $this->m_siswa->tampil_databyid($this->session->userdata('nis'))->row();
        $this->load->view('nilai/lihatNilai', $data);
        $this->load->view('template/footer');
    }

    public function belajar($id)
    {
        $where = array('id' => $id);
        $detail = $this->m_materi->belajar($id);
        $data['detail'] = $detail;
        $data['disqus'] = $this->disqus->get_html();
        $this->load->view('materi/belajar', $data);
    }

}
