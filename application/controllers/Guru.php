<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./application/third_party/phpspreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome/guru');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('guru/index');
    }

    //materi

    public function add_materi()
    {
        $this->load->model('m_guru');
        $this->load->model('m_kelas');

        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {

            $data['user'] = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row();
            $id = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row()->id;
            $data['kelas'] = $this->m_kelas->tampil_data_by_id($id)->result();
            // echo $this->db->last_query();
            $this->load->view('guru/add_materi',$data);
        } else {
            $upload_video = $_FILES['video'];

            if ($upload_video) {
                $config['allowed_types'] = 'mp4|mkv';
                $config['max_size'] = '0';
                $config['upload_path'] = './assets/materi_video';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('video')) {
                    $video = $this->upload->data('file_name');
                } else {
                    $this->upload->display_errors();
                }
            }
            $data = [
                'nama_guru' => htmlspecialchars($this->input->post('nip', true)),
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'video' => $video,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru'));
        }
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './assets/materi_video';
        $config['allowed_types'] = 'mp4|mkv';
        $config['file_name'] = $this->product_id;
        $config['overwrite'] = true;
        $config['max_size'] = 0; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }

        return "default.mp4";
    }

    public function data_materi()
    {
        $this->load->model('m_materi');

        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['user'] = $this->m_materi->tampil_data_bynip($this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row()->nip)->result();
        $this->load->view('guru/data_materi', $data);
    }

    public function update_materi($id)
    {
        $this->load->model('m_materi');
        $where = array('materi.id' => $id);
        $data['user'] = $this->m_materi->update_materi($where, 'materi')->result();
        $this->load->view('guru/update_materi', $data);
    }

    public function materi_edit()
    {
        $this->load->model('m_materi');

        $id = $this->input->post('id');
        $nama_guru = $this->input->post('nama_guru');
        $deskripsi = $this->input->post('deskripsi');

        $data = array(
            'nama_guru' => $nama_guru,
            'deskripsi' => $deskripsi,

        );

        $where = array(
            'id' => $id,
        );

        $this->m_materi->update_data($where, $data, 'materi');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('guru/data_materi');
    }

    public function delete_materi($id)
    {
        $this->load->model('m_materi');
        $where = array('id' => $id);
        $this->m_materi->delete_materi($where, 'materi');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('guru/data_materi');
    }

    //tugas
    public function data_tugas()
    {
        $this->load->model('m_tugas');

        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['user'] = $this->m_tugas->tampil_data_bynip($this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row()->nip)->result();
        // echo $this->db->last_query();
        $this->load->view('guru/data_tugas', $data);
    }

    public function add_tugas()
    {
        $this->load->model('m_guru');
        $this->load->model('m_kelas');

        $this->form_validation->set_rules('info', 'Informasi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom informasi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom judul.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row();
            $id = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row()->id;
            $data['kelas'] = $this->m_kelas->tampil_data_by_id($id)->result();
            // echo $this->db->last_query();
            $this->load->view('guru/add_tugas',$data);
        } else {
            $data = [
                'judul' => htmlspecialchars($this->input->post('judul', true)),
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'mapel_id' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'info' => htmlspecialchars($this->input->post('info', true)),
                'durasi' => htmlspecialchars($this->input->post('durasi', true)),
                'tgl_akhir' => htmlspecialchars($this->input->post('tgl_akhir', true)),
            ];

            $this->db->insert('tugas', $data);

            $data = [
                'tugas_id' => $this->db->insert_id(),
                'kelas_id' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert('tugas_kelas', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru/data_tugas'));
        }
    }

    public function soal_tugas($id)
    {
        $this->load->model('m_tugas');

        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['tugas'] = $this->m_tugas->tampil_data_byid($id)->row();
        // echo $this->db->last_query();
        // var_dump($data['tugas'] );
        $data['soal'] = $this->m_tugas->tampil_soal($id)->result();
                // echo $this->db->last_query();

        foreach ($data['soal'] as $key => $value) {
            $data['pilihan'][] = $this->m_tugas->tampil_pilihan($value->pertanyaan_id)->result();
        }
        $this->load->view('guru/soal_tugas', $data);
    }

    public function terbit_tugas($id)
    {
        $this->load->model('m_tugas');

        $data = array(
            'tampil_siswa' => '1'
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'tugas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('guru/data_tugas');
    }

    public function tutup($id)
    {
        $this->load->model('m_tugas');

        $data = array(
            'tampil_siswa' => '0'
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'tugas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('guru/data_tugas');
    }

    public function update_tugas($id)
    {
        $this->load->model('m_tugas');
        $this->load->model('m_kelas');
        $where = array('tugas.id' => $id);
        $data['kelas'] = $this->m_kelas->tampil_data()->result();
        $data['user'] = $this->m_tugas->update_tugas($where, 'tugas')->row();
        // echo $this->db->last_query();
        $this->load->view('guru/update_tugas', $data);
    }

    public function tugas_edit($id)
    {
        $this->load->model('m_tugas');

        $judul = $this->input->post('judul');
        $info = $this->input->post('info');
        $kelas = $this->input->post('kelas');
        $durasi = $this->input->post('durasi');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $data = array(
            'judul' => $judul,
            'info' => $info,
            'durasi' => $durasi,
            'tgl_akhir' => $tgl_akhir,
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'tugas');
        $data = array(
            'kelas_id' => $kelas,
        );

        $where = array(
            'tugas_id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'tugas_kelas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect(base_url('guru/data_tugas'));
    }

    public function tambah_soal($id)
    {
        $this->load->model('m_guru');
        $this->load->model('m_tugas');

        $this->form_validation->set_rules('soal', 'Soal', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom Soal.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);

        if ($this->form_validation->run() == false) {
            $data['count'] = $this->m_tugas->count_pertanyaan($id)->row()->count;
            $data['id'] = $id;
            $data['user'] = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row();
            $this->load->view('guru/add_pertanyaan',$data);
        } else {
            $data = [
                'pertanyaan' => $this->input->post('soal', true),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'tugas_id' => htmlspecialchars($this->input->post('id', true)),
            ];
            $this->db->insert('tugas_pertanyaan', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru/soal_tugas/'.$id));
        }
    }

    public function update_soal($id)
    {
        $this->load->model('m_tugas');
        $where = array('tugas_pertanyaan.id' => $id);
        $data['user'] = $this->m_tugas->update_soal($where, 'tugas_pertanyaan')->result();
        $this->load->view('guru/update_soal', $data);
    }

    public function soal_edit($id)
    {
        $this->load->model('m_tugas');

        $id = $this->input->post('id');
        $tugas_id = $this->input->post('tugas_id');
        $pertanyaan = $this->input->post('soal');

        $data = array(
            'pertanyaan' => $pertanyaan,
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'tugas_pertanyaan');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect(base_url('guru/soal_tugas/'.$tugas_id));
    }

    public function delete_soal($tugas_id,$id)
    {
        $this->load->model('m_tugas');
        $where = array('id' => $id);
        $this->m_tugas->delete_soal($where, 'tugas_pertanyaan');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect(base_url('guru/soal_tugas/'.$tugas_id));
    }

    //pilihan

    public function tambah_pilihan($tugas_id,$id)
    {
        $this->load->model('m_guru');
        $this->load->model('m_tugas');

        $this->form_validation->set_rules('pilihan', 'Pilihan', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom pilihan.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);

        if ($this->form_validation->run() == false) {
            $data['count'] = $this->m_tugas->count_pertanyaan($id)->row()->count;
            $data['id'] = $id;
            $data['tugas_id'] = $tugas_id;
            $data['user'] = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row();
            $this->load->view('guru/add_pilihan',$data);
        } else {
            $data = [
                'konten' => $this->input->post('pilihan', true),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'pertanyaan_id' => htmlspecialchars($this->input->post('id', true)),
            ];
            $this->db->insert('pilihan', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru/soal_tugas/'.$tugas_id));
        }
    }

    public function kunci($tugas_id,$pertanyaan_id,$id)
    {
        $this->load->model('m_tugas');

        $data = array(
            'kunci' => '0',
        );

        $where = array(
            'pertanyaan_id' => $pertanyaan_id,
        );

        $this->m_tugas->update_data($where, $data, 'pilihan');
        $data = array(
            'kunci' => '1',
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'pilihan');

        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect(base_url('guru/soal_tugas/'.$tugas_id));
    }

    public function update_pilihan($tugas_id,$id)
    {
        $this->load->model('m_tugas');
        $where = array('pilihan.id' => $id);
        $data['tugas_id'] = $tugas_id;
        $data['user'] = $this->m_tugas->update_soal($where, 'pilihan')->result();
        $this->load->view('guru/update_pilihan', $data);
    }

    public function pilihan_edit($id)
    {
        $this->load->model('m_tugas');

        $id = $this->input->post('id');
        $tugas_id = $this->input->post('tugas_id');
        $konten = $this->input->post('pilihan');
        $urutan = $this->input->post('urutan');

        $data = array(
            'konten' => $konten,
            'urutan' => $urutan,
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'pilihan');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect(base_url('guru/soal_tugas/'.$tugas_id));
    }

    public function delete_pilihan($tugas_id,$id)
    {
        $this->load->model('m_tugas');
        $where = array('id' => $id);
        $this->m_tugas->delete_soal($where, 'pilihan');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect(base_url('guru/soal_tugas/'.$tugas_id));
    }

    //koreksi
    public function koreksi_tugas($id)
    {
        $this->load->model('m_tugas');

        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['tugas'] = $this->m_tugas->tampil_data_byid($id)->row();
        $data['jawaban'] = $this->m_tugas->tampil_jawaban($id)->result();
        // echo $this->db->last_query();
        // foreach ($data['soal'] as $key => $value) {
        //     $data['pilihan'][] = $this->m_tugas->tampil_pilihan($value->pertanyaan_id)->result();
        // }
        $this->load->view('guru/koreksi_tugas', $data);
    }

    //nilai
    public function nilai($tugas_id,$id)
    {
        $this->load->model('m_guru');
        $this->load->model('m_tugas');

        $this->form_validation->set_rules('pilihan', 'Pilihan', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom pilihan.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);

        if ($this->form_validation->run() == false) {
            $data['count'] = $this->m_tugas->count_pertanyaan($id)->row()->count;
            $data['id'] = $id;
            $data['tugas_id'] = $tugas_id;
            $data['jawaban'] = $this->m_tugas->tampil_jawabanById($tugas_id,$id)->row();
            $data['kunci']= $this->m_tugas->kunci($tugas_id)->result_array();
            // var_dump($data['kunci']);
        // echo $this->db->last_query();
        $data['user'] = $this->m_guru->tampil_data_byid($this->session->userdata('email'))->row();
            $this->load->view('guru/nilai',$data);
        } else {
            $data = [
                'konten' => $this->input->post('pilihan', true),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'pertanyaan_id' => htmlspecialchars($this->input->post('id', true)),
            ];
            $this->db->insert('pilihan', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru/soal_tugas/'.$tugas_id));
        }
    }

    public function update_nilai($tugas_id,$id)
    {
        $this->load->model('m_tugas');

        $nilai = $this->input->post('nilai');

        $data = array(
            'nilai' => $nilai,
        );

        $where = array(
            'id' => $id,
        );

        $this->m_tugas->update_data($where, $data, 'jawaban');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('guru/koreksi_tugas/'.$tugas_id);
    }

    public function export($id)
     {
        $this->load->model('m_tugas');

            $tugas = $this->m_tugas->tampil_data_byid($id)->row();
            $jawaban = $this->m_tugas->tampil_jawaban($id)->result();

          $spreadsheet = new Spreadsheet;

          $styleArrayFirstRow = [
                'font' => [
                    'bold' => true,
                ]
            ];
        $midle =[
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
            ];
            $left =[
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ]
                ];
            $border = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ]
                ],
            ];

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'Data Nilai Tugas '.$tugas->mapel)
                      ->setCellValue('A2', 'Guru: '.$tugas->guru)
                      ->setCellValue('A3', 'Judul: '.$tugas->judul)
                      ->setCellValue('A4', 'Kelas: '.$tugas->kelas)
                      ->setCellValue('A5', 'No.')
                      ->setCellValue('B5', 'NIS')
                      ->setCellValue('C5', 'Nama Siswa')
                      ->setCellValue('D5', 'Nilai');
           
           $spreadsheet->getActiveSheet()->getStyle('A1:D5')->applyFromArray($styleArrayFirstRow);
           $spreadsheet->getActiveSheet()->getStyle('A5:D5')->applyFromArray($midle);

          $kolom = 6;
          $nomor = 1;
          foreach($jawaban as $value) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $value->nis)
                           ->setCellValue('C' . $kolom, $value->nama_siswa)
                           ->setCellValue('D' . $kolom, $value->nilai);

               $kolom++;
               $nomor++;

          }

          $spreadsheet->getActiveSheet()->getStyle('A5:D'.$kolom)->applyFromArray($border);
          $spreadsheet->getActiveSheet()->getStyle('A6:A'.$kolom)->applyFromArray($midle);
          $spreadsheet->getActiveSheet()->getStyle('D6:D'.$kolom)->applyFromArray($midle);
          $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
          $spreadsheet->getActiveSheet()->getStyle('B6:B'.$kolom)->applyFromArray($left);

          $writer = new Xlsx($spreadsheet);

          header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="Data Nilai_'.$tugas->mapel.'_'.$tugas->guru.'_'.$tugas->kelas.'.xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
     }

     //evaluasi
    public function evaluasi()
    {
        $this->load->model('m_tugas');

        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['user'] = $this->m_tugas->tampil_kelas($this->db->get_where('guru', ['email' =>
        $this->session->userdata('email')])->row()->nip)->result();
        echo $this->db->last_query();
        $this->load->view('guru/evaluasi', $data);
    }

    public function evaluasi_kelas($id,$nip)
    {
        $this->load->model('m_siswa');
        $this->load->model('m_tugas');

        $data['user'] = $this->db->get_where('guru', ['email' =>
            $this->session->userdata('email')])->row_array();
        $siswa = $this->m_siswa->tampil_databyKelas($id,$nip)->result();

        foreach ($siswa as $key => $value) {
           $x[$value->id] = $this->m_tugas->tampil_rata($id,$nip,$value->nis)->row()->nilai;
        }        
       $data['data']=$x;
       $data['siswa']=$siswa;
       var_dump($data['data']);

        $this->load->view('guru/evaluasi_kelas', $data);
    }
}
