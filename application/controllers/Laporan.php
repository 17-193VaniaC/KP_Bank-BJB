<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
       $title['title'] = 'Laporan';
        $data["RBB"] = $this->RBB_model->getAll();
        $data["PKS"] = $this->PKS_model->getAll();
        $data["Pembayaran"] = $this->Invoice_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('Laporan/laporan', $data);
        $this->load->view('templates/footer.php');
   }
 }