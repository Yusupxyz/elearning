<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome/admin');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/index');
    }

    public function about_developer()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/about_developer');
    }

    public function about()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/about');
    }

    // Management Siswa

    public function data_siswa()
    {
        $this->load->model('m_siswa');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('admin/data_siswa', $data);
    }

    public function detail_siswa($id)
    {
        $this->load->model('m_siswa');
        $where = array('id' => $id);
        $detail = $this->m_siswa->detail_siswa($id);
        $data['detail'] = $detail;
        $this->load->view('admin/detail_siswa', $data);
    }

    public function update_siswa($id)
    {
        $this->load->model('m_siswa');
        $this->load->model('m_kelas');
        $where = array('siswa.id' => $id);
        $data['user'] = $this->m_siswa->update_siswa($where, 'siswa')->result();
        // echo $this->db->last_query();
        $data['kelas'] = $this->m_kelas->tampil_data()->result();
        $this->load->view('admin/update_siswa', $data);
    }

    public function user_edit()
    {
        $this->load->model('m_siswa');

        $id = $this->input->post('id');
        $nis = $this->input->post('nis');
        $nama = $this->input->post('nama');
        $kelas = $this->input->post('kelas');
        $gambar = $_FILES['image']['name'];

        $data = array(
            'nis' => $nis,
            'nama' => $nama,
        );

        $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['max_size'] = '4096';
        $config['upload_path'] = './assets/profile_picture';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('image')) {
            $gambarLama = $data['user']['image'];
            if ($gambarLama != 'default.jpg') {
                unlink(FCPATH . '/assets/profile_picture/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('image', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }
        echo $id;

        $where = array(
            'id' => $id,
        );

        $this->m_siswa->update_data($where, $data, 'siswa');
        $data = array(
            'kelas_id' => $kelas,
        );
        $where = array(
            'siswa_id' => $id,
        );

        $this->m_siswa->update_data($where, $data, 'kelas_siswa');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_siswa');
    }

    public function delete_siswa($id)
    {
        $this->load->model('m_siswa');
        $where = array('siswa_id' => $id);
        $this->m_siswa->delete_siswa($where, 'kelas_siswa');
        $where = array('id' => $id);
        $this->m_siswa->delete_siswa($where, 'siswa');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_siswa');
    }

    public function add_siswa()
    {
        $this->load->model('m_kelas');

        $this->load->model('m_siswa');
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom NIS.',
            'min_length' => 'NIS terlalu pendek.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[2]', [
            'required' => 'Harap isi kolom nama.',
            'min_length' => 'Nama terlalu pendek.',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['kelas'] = $this->m_kelas->tampil_data()->result();
            $this->load->view('user/regis', $data);
        } else {
            if ($this->m_siswa->cek_id(htmlspecialchars($this->input->post('nis', true)))->row()->count != 0) {
                $this->session->set_flashdata('gagal', 'Gagal!');
                $data['kelas'] = $this->m_kelas->tampil_data()->result();
                $this->load->view('user/regis', $data);
            }else{
                $data = [
                    'nis' => htmlspecialchars($this->input->post('nis', true)),
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                ];
    
                $this->db->insert('siswa', $data);
    
                $data = [
                    'kelas_id' => htmlspecialchars($this->input->post('kelas', true)),
                    'siswa_id' => $this->db->insert_id()
                ];
    
                $this->db->insert('kelas_siswa', $data);
    
                $this->session->set_flashdata('success-reg', 'Berhasil!');
                redirect(base_url('admin/data_siswa'));
            }
        }
    }

    // manajemen guru

    public function data_guru()
    {
        $this->load->model('m_guru');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_guru->tampil_data()->result();
        $this->load->view('admin/data_guru', $data);
    }

    public function detail_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $detail = $this->m_guru->detail_guru($nip);
        $data['detail'] = $detail;
        $this->load->view('admin/detail_guru', $data);
    }

    public function update_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $data['user'] = $this->m_guru->update_guru($where, 'guru')->result();
        $this->load->view('admin/update_guru', $data);
    }

    public function guru_edit()
    {
        $this->load->model('m_guru');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $data = array(
            'nip' => $nip,
            'nama_guru' => $nama,
            'email' => $email,

        );

        $where = array(
            'nip' => $nip,
        );

        $this->m_guru->update_data($where, $data, 'guru');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_guru');
    }

    public function update_materi($id)
    {
        $this->load->model('m_materi');
        $where = array('id' => $id);
        $data['user'] = $this->m_materi->update_materi($where, 'materi')->result();
        $this->load->view('admin/update_materi', $data);
    }

    public function materi_edit()
    {
        $this->load->model('m_materi');

        $id = $this->input->post('id');
        $nama_guru = $this->input->post('nama_guru');
        $nama_mapel = $this->input->post('nama_mapel');
        $deskripsi = $this->input->post('deskripsi');

        $data = array(
            'nama_guru' => $nama_guru,
            'nama_mapel' => $nama_mapel,
            'deskripsi' => $deskripsi,

        );

        $where = array(
            'id' => $id,
        );

        $this->m_materi->update_data($where, $data, 'materi');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_materi');
    }

    public function delete_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $where2 = array('id_guru' => $nip);
        $this->m_guru->delete_guru($where, 'guru');
        $this->m_guru->delete_guru($where2, 'kelas_guru');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_guru');
    }

    public function add_guru()
    {
        $this->load->model('m_mapel');
        $this->load->model('m_kelas');

        $this->form_validation->set_rules('nip', 'Nip', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom NIP.',
            'min_length' => 'NIP terlalu pendek.',
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[guru.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[2]', [
            'required' => 'Harap isi kolom nAMA.',
            'min_length' => 'Nama terlalu pendek.',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['mapel'] = $this->m_mapel->tampil_data()->result();
            $data['user'] = $this->m_kelas->tampil_data()->result();  
            $this->load->view('guru/registration', $data);
        } else {
            $kelas=$this->input->post('kelas', true);
            $data = [
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nama_guru' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama_mapel' => htmlspecialchars($this->input->post('mapel', true)),
            ];

            $this->db->insert('guru', $data);
            $id= $this->db->insert_id();
            for ($i=0; $i < count($kelas); $i++) { 
                $data = [
                    'id_guru' => htmlspecialchars($this->input->post('nip', true)),
                    'id_kelas' => $kelas[$i]
                ];
                $this->db->insert('kelas_guru', $data);
            }

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_guru'));
        }
    }

    // manajemen mapel

    public function data_mapel()
    {
        $this->load->model('m_mapel');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_mapel->tampil_data()->result();
        $this->load->view('admin/data_mapel', $data);
    }

    public function add_mapel()
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom nama.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('mapel/registration');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'info' => password_hash($this->input->post('info'), true),
                'aktif' => $this->input->post('mapel', true)=='Aktif'?'1':'0',
            ];

            $this->db->insert('mapel', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_mapel'));
        }
    }

    public function update_mapel($id)
    {
        $this->load->model('m_mapel');
        $where = array('id' => $id);
        $data['user'] = $this->m_mapel->update_mapel($where, 'mapel')->result();
        $this->load->view('admin/update_mapel', $data);
    }

    public function mapel_edit()
    {
        $this->load->model('m_mapel');
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $info = $this->input->post('info');
        $status = $this->input->post('status');

        $data = array(
            'nama' => $nama,
            'info' => $email,
            'aktif' => $status,

        );

        $where = array(
            'id' => $id,
        );

        $this->m_mapel->update_data($where, $data, 'mapel');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_mapel');
    }

    public function delete_mapel($id)
    {
        $this->load->model('m_mapel');
        $where = array('id' => $id);
        $this->m_mapel->delete_mapel($where, 'mapel');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_mapel');
    }

    //manajemen materi

    public function data_materi()
    {
        $this->load->model('m_materi');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_materi->tampil_data()->result();
        $this->load->view('admin/data_materi', $data);
    }

    public function delete_materi($id)
    {
        $this->load->model('m_materi');
        $where = array('id' => $id);
        $this->m_materi->delete_materi($where, 'materi');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_materi');
    }

    public function tambah_materi()
    {
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_materi');
        } else {
            $upload_video = $_FILES['video'];

            if ($upload_video) {
                $config['allowed_types'] = 'mp4|mkv|mov';
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
                'nama_guru' => htmlspecialchars($this->input->post('nama_guru', true)),
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'video' => $video,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_materi'));
        }
    }

    //manajemen kelas

    public function data_kelas()
    {
        $this->load->model('m_kelas');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_kelas->tampil_data()->result();
        $this->load->view('admin/data_kelas', $data);
    }

    public function add_kelas()
    {
        $this->load->model('m_kelas');

        $this->form_validation->set_rules('nama_kelas', 'Kelas', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom nama_kelas.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->m_kelas->get_category()->result();  
            $this->load->view('admin/add_kelas',$data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama_kelas', true)),
                'kategori_id' => htmlspecialchars($this->input->post('kategori', true))
            ];

            $this->db->insert('kelas', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_kelas'));
        }
    }

    public function update_kelas($id)
    {
        $this->load->model('m_kelas');
        $where = array('id' => $id);
        $data['user'] = $this->m_kelas->update_kelas($where, 'kelas')->result();
        $data['kategori'] = $this->m_kelas->get_category()->result();  
        $this->load->view('admin/update_kelas', $data);
    }

    public function kelas_edit()
    {
        $this->load->model('m_kelas');
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $kategori_id = $this->input->post('kategori');
        $aktif = $this->input->post('aktif');

        $data = array(
            'nama' => $nama,
            'kategori_id' => $kategori_id,
            'aktif' => $aktif,

        );

        $where = array(
            'id' => $id,
        );

        $this->m_kelas->update_data($where, $data, 'kelas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_kelas');
    }

    //manajemen kategori kelas

    public function data_kategori_kelas()
    {
        $this->load->model('m_kategori_kelas');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_kategori_kelas->get_category()->result();
        $this->load->view('admin/data_kategori_kelas', $data);
    }

    public function add_kategori_kelas()
    {
        $this->load->model('m_kelas');
        $this->load->model('m_mapel');

        $this->form_validation->set_rules('nama', 'Kategori Kelas', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom nama.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->m_mapel->tampil_data()->result();  
            $this->load->view('admin/add_kategori_kelas',$data);
        } else {
            $mapel=$this->input->post('mapel', true);
            // var_dump($this->input->post('mapel', true));
            $data = [
                'kategori' => htmlspecialchars($this->input->post('nama', true))
            ];

            $this->db->insert('kelas_kategori', $data);
            $id= $this->db->insert_id();
            for ($i=0; $i < count($mapel); $i++) { 
                $data = [
                    'id_kelas' => $id,
                    'id_mapel' => $mapel[$i]
                ];
                $this->db->insert('kelas_mapel', $data);
            }

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_kategori_kelas'));
        }
    }

    public function update_kategori_kelas($id)
    {
        $this->load->model('m_kategori_kelas');
        $this->load->model('m_mapel');
        $where = array('id' => $id);
        $data['user'] = $this->m_kategori_kelas->update_kategori($where, 'kelas_kategori')->result();
        $data['mapel'] = $this->m_mapel->tampil_data()->result();  
        $where = array('id_kelas' => $id);
        $mapel_kategori = $this->m_kategori_kelas->update_kategori($where, 'kelas_mapel')->result(); 
        $x=array();
        foreach ($mapel_kategori as $key => $value) {
            $x[]=$value->id_mapel;
        }
        $data['kapel']=$x;
        $this->load->view('admin/update_kategori_kelas', $data);
    }

    public function kelas_kategori_edit()
    {
        $this->load->model('m_kategori_kelas');
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $mapel=$this->input->post('mapel', true);

        $data = array(
            'kategori' => $nama,

        );

        $where = array(
            'id' => $id,
        );

        $this->m_kategori_kelas->update_data($where, $data, 'kelas_kategori');

        $where = array('id_kelas' => $id);
        $this->m_kategori_kelas->delete($where, 'kelas_mapel');
        for ($i=0; $i < count($mapel); $i++) { 
            $data = [
                'id_kelas' => $id,
                'id_mapel' => $mapel[$i]
            ];
            $this->db->insert('kelas_mapel', $data);
        }
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_kategori_kelas');
    }

    function get_kelas(){
        $this->load->model('m_kelas');

        $mapel_id = $this->input->post('id',TRUE);
        $data = $this->m_kelas->tampil_data_by_id($mapel_id)->result();
        echo json_encode($data);
    }

}
