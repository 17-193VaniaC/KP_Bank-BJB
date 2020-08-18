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
        $this->load->model("Laporan_model");
        $this->load->library('form_validation');
    }


   public function index(){
<<<<<<< HEAD
<<<<<<< HEAD
        $title['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $res= $this->Laporan_model->getData();
        $data['table'] = $res;
=======
       $title['title'] = 'Laporan';
        $data["RBB"] = $this->RBB_model->getAll();
        $data["PKS"] = $this->PKS_model->getAll();
        $data["Pembayaran"] = $this->Invoice_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
>>>>>>> parent of 078636e... JProject updated
=======
       $title['title'] = 'Laporan';
        $data["RBB"] = $this->RBB_model->getAll();
        $data["PKS"] = $this->PKS_model->getAll();
        $data["Pembayaran"] = $this->Invoice_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
>>>>>>> parent of 078636e... JProject updated
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('Laporan/laporan', $data);
        $this->load->view('templates/footer.php');
   }
 }