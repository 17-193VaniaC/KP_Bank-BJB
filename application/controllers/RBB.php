<?php

defined('BASEPATH') or exit('No direct script access allowed');

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
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']) {
            $this->load->view('templates/header.php');
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("RBB/rbb", $data);
            $this->load->view('templates/footer.php');
        } else {
            redirect('login');
        }
    }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']) {

            $rbb = $this->RBB_model;
            $validation = $this->form_validation;
            $validation->set_rules($rbb->rules());

            if ($validation->run() == TRUE) {
                $rbb->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }

            $this->load->view('templates/header.php');
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("RBB/create_rbb", $rbb);
            $this->load->view('templates/footer.php');
        } else {
            redirect('login');
        }
    }

    public function edit($KODE_RBB = null)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']) {

            if (!isset($KODE_RBB)) redirect('rbb');

            $rbb = $this->RBB_model;
            $validation = $this->form_validation;
            $validation->set_rules($rbb->rules2());

            if ($validation->run()) {
                $rbb->update();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            } else {
            }

            $data["rbb"] = $rbb->getById($KODE_RBB);
            if (!$data["rbb"]) show_404();

            $this->load->view('templates/header.php');
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("RBB/edit_rbb", $data);
            $this->load->view('templates/footer.php');
        } else {
            redirect('login');
        }
    }

    public function delete($rbb = null)
    {

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']) {
            if (!isset($rbb)) show_404();

            if ($this->RBB_model->delete($rbb)) {
                redirect(site_url('rbb'));
            }
        } else {
            redirect('login');
        }
    }
}
