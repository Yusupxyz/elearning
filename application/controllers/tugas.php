<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Tugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('disqus');
        $this->load->model('m_tugas');
        $this->load->library('session');

    }

    function generateTugas($tugas,$kelas){
    
        $data['tugas'] = $this->m_tugas->data($tugas,$kelas)->result();
        // echo $this->db->last_query();

        $data['user'] = $this->m_tugas->tampil_databyid($this->session->userdata('nis'))->row();
        $this->load->view('tugas/daftarTugas', $data);
        $this->load->view('template/footer');
    }

    public function kerjakan($id)
    {
        //set session dulu dengan nama $_SESSION["mulai"]
        // unset($_SESSION['mulai']);

        if (isset($_SESSION["mulai"])) { 
            //jika session sudah ada
            $telah_berlalu = time() - $_SESSION["mulai"];
        } else { 
            //jika session belum ada
            $_SESSION["mulai"]  = time();
            $telah_berlalu      = 0;
        } 
        $durasi = $this->m_tugas->getDurasi($id)->durasi;

        $temp_waktu = ($durasi*60) - $telah_berlalu;        //dijadikan detik dan dikurangi waktu yang berlalu
        $temp_menit = (int)($temp_waktu/60);                //dijadikan menit lagi
        $temp_detik = $temp_waktu%60;                       //sisa bagi untuk detik
         
        if ($temp_menit < 60) { 
            /* Apabila $temp_menit yang kurang dari 60 meni */
            $jam    = 0; 
            $menit  = $temp_menit; 
            $detik  = $temp_detik; 
        } else { 
            /* Apabila $temp_menit lebih dari 60 menit */           
            $jam    = (int)($temp_menit/60);    //$temp_menit dijadikan jam dengan dibagi 60 dan dibulatkan menjadi integer 
            $menit  = $temp_menit%60;           //$temp_menit diambil sisa bagi ($temp_menit%60) untuk menjadi menit
            $detik  = $temp_detik;
        }   

        $data['jam'] = $jam;
        $data['menit'] = $menit;
        $data['detik'] = $detik;

        $data['id'] = $id;
        $data['detail'] = $this->m_tugas->kerjakan($id);
        $data['pertanyaan'] = $this->m_tugas->pertanyaan($id)->result();
        // Echo $this->db->last_query();

        foreach ($data['pertanyaan'] as $key => $value) {
            $data['pilihan'][$value->tugas_pertanyaan] = $this->m_tugas->pilihan($value->tugas_pertanyaan)->result();
        }
        // Echo $this->db->last_query();
        $this->load->view('tugas/kerjakan', $data);
    }

    public function jawab($id)
    {
        $telah_berlalu = time() - $_SESSION["mulai"];
        unset($_SESSION['mulai']);
        $data['id'] = $id;
        $jawaban = $this->input->post('pilihan');
        $myObj = new stdClass();
        $myObj->durasi = $telah_berlalu;
        $myObj->jawaban = $jawaban;

        $myJSON = json_encode($myObj);
        $data = [
            'siswa_id' => $this->session->userdata('nis'),
            'jawaban' => $myJSON,
            'tugas_id' => $id,
        ];

        $this->db->insert('jawaban', $data);
        // redirect('user/tugas');    
    }
}
