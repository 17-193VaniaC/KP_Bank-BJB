<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model("Vendor_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Vendor';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data['counter'] = 1;
        $data["vendor"] = $this->Vendor_model->getAll();

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/vendor", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $vendor = $this->Vendor_model;
            $validation = $this->form_validation;
            $validation->set_rules($vendor->rules());

            if ($validation->run() == TRUE) {
                $vendor->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            redirect('vendor');
        } else {
            redirect('dashboard');
        }
    }

    public function edit($vendor =null)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        if (!isset($vendor)) redirect('RBB');
        $vendor = $this->Vendor_model;
        if($vendor->update() == TRUE){
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect("pks");
            
        } 
        $this->session->set_flashdata('failed', 'Data gagal disimpan');
        redirect("rbb");
         
    }

    public function delete($vendor = null)
    {
        if(empty("vendor")) redirect('termin');
        $data['vendor'] = $this->Vendor_model->delete($vendor);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Your data has been deleted.</div>');
        redirect('vendor');
    }


}
