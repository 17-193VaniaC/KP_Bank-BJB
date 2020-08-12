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
        $this->load->model("JProject_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Jenis Project';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data['counter'] = 1;
        $data["jenis"] = $this->JProject_model->getAll();

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/jenis_project", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $jenis = $this->JProject_model;
            $validation = $this->form_validation;
            $validation->set_rules($jenis->rules());

            if ($validation->run() == TRUE) {
                $jenis->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            redirect('jenis_project');
        } else {
            redirect('dashboard');
        }
    }

    public function delete($jenis = null)
    {
        // $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        // if ($data['user']['ROLE'] == 'IT FINANCE') {
        if(empty("jenis")) redirect('jproject');
        $thisdata = $this->JProject_model->getById($jenis);
        if($thisdata->STATUS <1){
            $this->JProject_model->delete($jenis);
            $this->session->set_flashdata('delete_success', '<div class="alert alert-danger" role="alert"> Your data has been deleted.</div>');
        }
        else{
            $this->session->set_flashdata('delete_failed', '<div class="alert alert-danger" role="alert"> Your data has been deleted.</div>');
        }
            redirect('jproject');
        // }
    }
}
