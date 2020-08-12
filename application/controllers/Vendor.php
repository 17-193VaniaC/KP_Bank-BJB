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
        $vendor = $this->Vendor_model;
        $validation = $this->form_validation;
        $validation->set_rules($vendor->rules());
        $var=0;
        if ($validation->run() == TRUE) {
            $var = 1;
            $vendor->update();
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            $data["vendor"] = $this->Vendor_model->getAll();

        } 

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/vendor", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {   $this->session->set_flashdata('success', '');
        $this->session->set_flashdata('failed', '');
        $title['title'] = 'Vendor';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $vendor = $this->Vendor_model;
            $validation = $this->form_validation;
            $validation->set_rules($vendor->rules());

            if ($validation->run() == TRUE) {
                $vendor->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            else{
                $this->session->set_flashdata('failed', 'Data yang dimasukan kosong atau sudah ada');
            }

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('templates/footer.php');
        redirect('vendor');
        }
        else {
            redirect('dashboard');
        }
    }

    public function delete($vendor = null)
    {
        if(empty("vendor")) redirect('termin');
        $thisdata = $this->Vendor_model->getById($vendor);
        if($thisdata->STATUS <1){
            $this->Vendor_model->delete($vendor);
            $this->session->set_flashdata('delete_success', 'Data berhasil dihapus');
        }
        else{
            $this->session->set_flashdata('delete_failed', 'Gagal menghapus data. Jenis project sedang digunakan.');
        }
        redirect('vendor');
    }


}
