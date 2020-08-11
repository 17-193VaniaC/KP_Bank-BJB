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
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'RBB';
        $data["rbb"] = $this->RBB_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php');
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("RBB/rbb", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $title['title'] = 'Create RBB';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data['gl'] = $this->db->get('gl')->result();
        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($rbb->rules());

        if ($validation->run() == TRUE) {
            $rbb->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("RBB/create_rbb", $data);
        $this->load->view('templates/footer.php');
    }

    public function edit($KODE_RBB = null)
    {
        $title['title'] = 'Edit RBB';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        if (!isset($KODE_RBB)) redirect('rbb');

        $rbb = $this->RBB_model;
        $validation = $this->form_validation;
        $validation->set_rules($rbb->rules2());

        if ($validation->run()) {
            $rbb->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        } 
        
        $data["rbb"] = $rbb->getById($KODE_RBB);
        if (!$data["rbb"]) show_404();

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("RBB/edit_rbb", $data);
        $this->load->view('templates/footer.php');
    }

    public function delete($rbb = null)
    {
        if (!isset($rbb)) show_404();

        if ($this->RBB_model->delete($rbb)) {
            redirect(site_url('rbb'));
        }
    }
}
