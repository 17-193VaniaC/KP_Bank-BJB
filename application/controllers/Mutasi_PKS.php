<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi_PKS extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->load->model("MutasiPKS_model");
        // $this->load->model("RBB_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Mutasi PKS';
        $data["mutasi_pks"] = $this->MutasiPKS_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Mutasi_PKS/mutasi_pks", $data);
        $this->load->view('templates/footer.php');
    }

    // public function add($data)
    // {
    //     var_dump($data);
    //     die;
    //     $mutasi_pks = $this->MutasiPKS_model;
    //     $mutasi_pks->save();
    // }
}
