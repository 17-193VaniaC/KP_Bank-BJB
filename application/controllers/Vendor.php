<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Vendor_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["vendor"] = $this->Vendor_model->getAll();
        $this->load->view("IT_FINANCE/vendor", $data);
    }

    public function add()
    {
        $vendor = $this->Vendor_model;
        $validation = $this->form_validation;
        $validation->set_rules($vendor->rules());

        if ($validation->run()==TRUE) {
            $vendor->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data["vendor"] = $this->Vendor_model->getAll();
        $this->load->view("IT_FINANCE/vendor" , $data);
    }

    public function delete($vendor=null)
    {
        if (!isset($vendor)) show_404();
        
        if ($this->Vendor_model->delete($vendor)) {
            redirect(site_url('vendor'));
        }
    }
}