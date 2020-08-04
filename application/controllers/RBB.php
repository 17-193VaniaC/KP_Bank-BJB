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
        $this->load->view("RBB/rbb", $data);
    }

    public function add()
    {
        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($rbb->rules());

        if ($validation->run()==TRUE) {
            $rbb->save();
            echo "bisa";
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("RBB/create_rbb", $rbb);
    }

    public function edit($KODE_RBB = null)
    {
        if (!isset($KODE_RBB)) redirect('rbb');
       
        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($rbb->rules2());

        if ($validation->run()) {
            $rbb->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            ECHO "BISA";
        }
        else{
            echo "tidak valid";
        }

        $data["rbb"] = $rbb->getById($KODE_RBB);
        if (!$data["rbb"]) show_404();
        
        $this->load->view("RBB/edit_rbb", $data);
    }

    public function delete($rbb=null)
    {
        if (!isset($rbb)) show_404();
        
        if ($this->RBB_model->delete($rbb)) {
            redirect(site_url('rbb'));
        }
    }
}