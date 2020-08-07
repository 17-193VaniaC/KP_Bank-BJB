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
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $jeniss = urldecode($jenis);

            if (!isset($jeniss)) show_404();
            if ($this->JProject_model->delete($jeniss)) {
                redirect(site_url('jenis_project'));
            }
        } else {
            redirect('dashboard');
        }
    }
}
