<?php

defined('BASEPATH') or exit('No direct script access allowed');

class JProject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->library('pagination');
        $this->load->model("JProject_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }
    public function index()
    {
        $title['title'] = 'Jenis Project';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data['counter'] = 1;
        $data["jenis"] = $this->JProject_model->getAll();
        $jenis = $this->JProject_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        $var = 0;
        if ($validation->run() == TRUE) {
            if ($data['user']['ROLE'] == 'IT FINANCE') {
                $var = 1;
                $kode_jenis = $jenis->update();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'j_project';
                $data_log['KODE_DATA'] = $kode_jenis;
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Data berhasil diubah');
                $data["jenis"] = $this->JProject_model->getAll();
            } else {
                redirect('JProject');
            }
        }

        // Config pagination
        $config['base_url'] = base_url('JProject/index');
        $config['total_rows'] = $this->db->count_all('j_project');
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Pagination style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($id = $this->input->get('searchById')) {
            $data['jenis'] = $this->JProject_model->getPagination($id, $config["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();

            var_dump($data['jenis']);
            die;
        } 
        else{
            $data['jenis'] = $this->JProject_model->getPagination(null, $config["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
        }
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/jenis_project", $data);
        $this->load->view('templates/footer.php');
    }
    // public function index()
    // {
    //     $title['title'] = 'Jenis Project';
    //     $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

    //     $data['counter'] = 1;
    //     $data["jenis"] = $this->JProject_model->getAll();

    //     $jp = $this->JProject_model;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($jp->rules());
    //     $var = 0;
    //     if ($validation->run() == TRUE) {
    //         if ($data['user']['ROLE'] == 'IT FINANCE') {
    //             $var = 1;
    //             $kode_jp = $jp->update();

    //             // ADD LOG
    //             $log = $this->Log_model;
    //             $data_log['USER'] = $data['user']['NAMA'];
    //             $data_log['TABLE_NAME'] = 'j_project';
    //             $data_log['KODE_DATA'] = $kode_jp;
    //             $data_log['ACTIVITY'] = 'edit';
    //             $log->save($data_log);

    //             $this->session->set_flashdata('success', 'Data berhasil diubah');
    //             $data["jenis"] = $this->JProject_model->getAll();
    //         } else {
    //             redirect('jenis_project');
    //         }
    //     }
    //     $this->load->view('templates/header.php', $title);
    //     $this->load->view('templates/navbar.php', $data);
    //     $this->load->view("IT_FINANCE/jenis_project", $data);
    //     $this->load->view('templates/footer.php');
    // }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $jenis = $this->JProject_model;
            $validation = $this->form_validation;
            $validation->set_rules($jenis->rules());

            if ($validation->run() == TRUE) {
                $kode_jenis = $jenis->save();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'jenis project';
                $data_log['KODE_DATA'] = $kode_jenis;
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            else {
                $this->session->set_flashdata('failed', 'Data yang dimasukan kosong atau sudah ada');
            }
            redirect('jenis_project');
        } 
        else {
            redirect('dashboard');
        }
    }

    public function delete($jenis = null)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        // if ($data['user']['ROLE'] == 'IT FINANCE') {
        if (empty("jenis")) redirect('jproject');
        $thisdata = $this->JProject_model->getById($jenis);
        if ($thisdata->STATUS < 1) {
            // ADD LOG
            $log = $this->Log_model;
            $data_log['USER'] = $data['user']['NAMA'];
            $data_log['TABLE_NAME'] = 'jenis project';
            $data_log['KODE_DATA'] = $jenis;
            $data_log['ACTIVITY'] = 'delete';
            $log->save($data_log);

            $this->JProject_model->delete($jenis);
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Gagal menghapus data. Jenis project sedang digunakan.');
        }
        redirect('jproject');
        // }
    }
}
