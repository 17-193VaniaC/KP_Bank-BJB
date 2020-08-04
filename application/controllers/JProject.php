<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class JProject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("JProject_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["jenis"] = $this->JProject_model->getAll();
        $this->load->view("IT_FINANCE/jenis_project", $data);
    }

    public function add()
    {
        $jenis = $this->JProject_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        if ($validation->run()==TRUE) {
            $jenis->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data["jenis"] = $this->JProject_model->getAll();
        $this->load->view("IT_FINANCE/jenis_project" , $data);
    }

    public function delete($jenis=null)
    {
        if (!isset($vendor)) show_404();
        if ($this->Vendor_model->delete($jenis)) {
            redirect(site_url('jenis_project'));
        }
    }
}