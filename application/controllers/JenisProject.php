<?php

defined('BASEPATH') or exit('No direct script access allowed');

class JenisProject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->library('pagination');
        $this->load->model("JenisProject_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }
    public function index()
    {
        $title['title'] = 'Jenis Project';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data['counter'] = 1;
        // Config pagination
        $config['base_url'] = base_url('JenisProject/index');
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;

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


        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

       if (!empty($this->input->post('Search'))) {
            $id = $this->input->post('searchById');
            $this->session->set_flashdata(array("search_jp"=>$id));
            $data["search"] = $id;
            $n_row = $this->JenisProject_model->countquery($id)[0]->n_row;
            $config['total_rows'] = $n_row;
            $data['page'] = 0;
        } 
        else{
            if($this->session->flashdata('search_jp') != NULL){
                $data['search']= $this->session->flashdata('search_jp');
                $n_row = $this->JenisProject_model->countquery($data['search'])[0]->n_row;
                $config['total_rows'] = $n_row;
            }
            else{
                $data['search']= '';
                $config['total_rows'] = $this->db->count_all('j_project');
            }
        }
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data['jenis'] = $this->JenisProject_model->getPagination($data['search'], $config["per_page"], $data['page']);

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['counter'] = $data['page'];

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/jenis_project", $data);
        $this->load->view('templates/footer.php');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $jp = $this->JenisProject_model;
        $validation = $this->form_validation;
        $validation->set_rules($jp->rules());
        if ($validation->run() == TRUE) {
            if ($data['user']['ROLE'] == 'IT FINANCE') {
                $var = 1;
                $kode_jp = $jp->update();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'j_project';
                $data_log['KODE_DATA'] = $kode_jp;
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Data berhasil diubah');
            } else {
                redirect('jenis_project');
            }
        }
        redirect('jenis_project');

    }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $jenis = $this->JenisProject_model;
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
        if (empty("jenis")) redirect('jproject');
        $thisdata = $this->JenisProject_model->getById($jenis);

        if ($thisdata->STATUS > 0) {
            $this->session->set_flashdata('failed', 'Gagal menghapus data. Jenis project sedang digunakan.');
            redirect('jproject');        
        } 
            $log = $this->Log_model;
            $data_log['USER'] = $data['user']['NAMA'];
            $data_log['TABLE_NAME'] = 'jenis project';
            $data_log['KODE_DATA'] = $jenis;
            $data_log['ACTIVITY'] = 'delete';
            $log->save($data_log);

            $this->JenisProject_model->delete($jenis);
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('jproject');
    }
}
