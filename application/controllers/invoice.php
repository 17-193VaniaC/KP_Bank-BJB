<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Invoice_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["invoice"] = $this->Invoice_model->getAll();
        $this->load->view("IT_FINANCE/invoice_rbb", $data);
    }

    public function add()
    {
        $invoice = $this->Invoice_model;
        $validation = $this->form_validation;
        $validation->set_rules($invoice->rules());

        if ($validation->run()) {
            $invoice->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("IT_FINANCE/invoice_rbb");
    }


    public function delete($invoice=null)
    {
        if (!isset($invoice)) show_404();
        
        if ($this->Invoice_model->delete($invoice)) {
            redirect(site_url('invoice'));
        }
    }
}