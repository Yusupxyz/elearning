<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Materi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('disqus');
        $this->load->model('m_materi');
        $this->load->model('m_mapel');
    }

    function generateMateri($materi,$kelas){
    
        $data['materi'] = $this->m_materi->data($materi,$kelas)->result();
        $data['mapel'] = $this->m_mapel->tampil_data_byId($materi)->row();
        echo $this->db->last_query();
        $this->load->model('m_siswa');
        $data['user'] = $this->m_siswa->tampil_databyid($this->session->userdata('nis'))->row();
        $this->load->view('materi/matematika-x', $data);
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
