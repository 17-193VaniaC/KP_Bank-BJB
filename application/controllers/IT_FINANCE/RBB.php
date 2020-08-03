<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RBB extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("RBB_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["rbb"] = $this->RBB_model->getAll();
        $this->load->view("IT_FINANCE/rbb", $data);
    }

    public function add()
    {
        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($rbb->rules());

        if ($validation->run()) {
            $rbb->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("IT_FINANCE/create_rbb");
    }

    public function edit($rbb = null)
    {
        if (!isset($rbb)) redirect('IT_FINANCE/edit_rbb');
       
        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($rbb->rules());

        if ($validation->run()) {
            $rbb->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["rbb"] = $menu->getById($rbb);
        if (!$data["rbb"]) show_404();
        
        $this->load->view("IT_FINANCE/edit_rbb", $data);
    }

    public function delete($rbb=null)
    {
        if (!isset($rbb)) show_404();
        
        if ($this->RBB_model->delete($rbb)) {
            redirect(site_url('IT_FINANCE/rbb'));
        }
    }
}