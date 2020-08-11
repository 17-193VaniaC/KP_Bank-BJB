<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi_RBB extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->load->model("MutasiRBB_model");
        $this->load->model("RBB_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Mutasi RBB';
        $data["mutasirbb"] = $this->MutasiRBB_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Mutasi_RBB/mutasi_rbb", $data);
        $this->load->view('templates/footer.php');
    }

    public function Penyesuaian_RBB()
    {
        $title['title'] = 'Penyesuaian RBB';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $mutasi_rbb = $this->MutasiRBB_model;
        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($mutasi_rbb->rules());

        if ($validation->run() == TRUE) {
            if($rbb->isExist() == FALSE){
                var_dump("gak ada rbbnya");
                $this->session->set_flashdata('failed', 'Mutasi RBB tidak ditemukan');    
                $this->load->view("Mutasi_RBB/add_mutasi_rbb", $mutasi_rbb);
            }
            if($rbb->sych() == FALSE){
                var_dump("gak bisa di sych");
                $this->session->set_flashdata('failed', 'Anggaran baru kurang dari nominal PKS');    
                $this->load->view("Mutasi_RBB/add_mutasi_rbb", $mutasi_rbb);   
            }
            $mutasi_rbb->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->session->set_flashdata('failed', 'Tidak sesuai rule');    

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Mutasi_RBB/add_mutasi_rbb", $mutasi_rbb);
        $this->load->view('templates/footer.php');
    }

}
