<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RBB extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model("RBB_model");
        $this->load->model("PKS_model");
        $this->load->model("Invoice_model");
        $this->load->library('form_validation');
    }


   public function index(){
   		$data["report"] = $this->Invoice_model->getAll();
   		$this->load->view('laporan', $data);
   }