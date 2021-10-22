<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->session->set_flashdata('not-login', 'Gagal!');
        // if (!$this->session->userdata('nis')) {
        //     redirect('welcome');
    }

    public function index()
    {
        $this->load->model('m_siswa');
        $data['user'] = $this->db->get_where('siswa', ['nis' =>
            $this->session->userdata('nis')])->row_array();
        $data['kelas'] = $this->m_siswa->tampil_databyid($this->session->userdata('nis'))->row();

        $this->load->view('user/index',$data);
        $this->load->view('template/footer');
    }

    public function kelas10()
    {
        $this->load->model('m_mapel');
        $data['user'] = $this->db->get_where('siswa', ['nis' =>
            $this->session->userdata('nis')])->row_array();
        // $data['mapel'] = $this->m_mapel->tampil_data()->result();
        $data['mapel'] = $this->m_mapel->tampil_data_kelas($this->session->userdata('nis'))->result();
        // echo $this->db->last_query();
        $this->load->view('user/kelas10',$data);
        $this->load->view('template/footer');
    }

    public function kelas11()
    {
        $data['user'] = $this->db->get_where('siswa', ['nis' =>
            $this->session->userdata('nis')])->row_array();

        $this->load->view('user/kelas11');
        $this->load->view('template/footer');
    }

    public function kelas12()
    {
        $data['user'] = $this->db->get_where('siswa', ['nis' =>
            $this->session->userdata('nis')])->row_array();

        $this->load->view('user/kelas12');
        $this->load->view('template/footer');
    }

    private function _sendnis($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlnis.com',
            'smtp_user' => 'ini nis disini',
            'smtp_pass' => 'Isi Password gmail disini',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->nis->initialize($config);

        $data = array(
            'name' => 'syauqi',
            'link' => ' ' . base_url() . 'welcome/verify?nis=' . $this->input->post('nis') . '& token' . urlencode($token) . '"',
        );

        $this->nis->from('LearnifyEducations@gmail.com', 'Learnify');
        $this->nis->to($this->input->post('nis'));

        if ($type == 'verify') {
            $link =
            $this->nis->subject('Verifikasi Akun');
            $body = $this->load->view('template/nis-template.php', $data, true);
            $this->nis->message($body);
        } else {
        }

        if ($this->nis->send()) {
            return true;
        } else {
            echo $this->nis->print_debugger();
            die();
        }
    }

    //tugas
    public function tugas()
    {
        $this->load->model('m_siswa');
        $this->load->model('m_tugas');
        $data['user'] = $this->m_siswa->tampil_databyid($this->session->userdata('nis'))->row();
            // var_dump($data['user']);
        $data['tugas'] = $this->m_tugas->tampil_databyid($this->session->userdata('nis'))->result();
        // echo $this->db->last_query();
        $this->load->view('user/tugas',$data);
        $this->load->view('template/footer');
    }

    //tugas
    public function nilai()
    {
        $this->load->model('m_siswa');
        $this->load->model('m_tugas');
        $data['user'] = $this->m_siswa->tampil_databyid($this->session->userdata('nis'))->row();
            // var_dump($data['user']);
        $data['nilai'] = $this->m_tugas->tampil_dataNilaibyid($this->session->userdata('nis'))->result();
        // echo $this->db->last_query();
        $this->load->view('user/nilai',$data);
        $this->load->view('template/footer');
    }

}
