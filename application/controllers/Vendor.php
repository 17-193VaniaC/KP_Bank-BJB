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
        $this->load->model("Log_model");
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
        $var = 0;
        if ($validation->run() == TRUE) {
            if ($data['user']['ROLE'] == 'IT FINANCE') {
                $var = 1;
                $kode_vendor = $vendor->update();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'vendor';
                $data_log['KODE_DATA'] = $kode_vendor;
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Data berhasil diubah');
                $data["vendor"] = $this->Vendor_model->getAll();
            } else {
                redirect('vendor');
            }
        }

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/vendor", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $this->session->set_flashdata('success', '');
        $this->session->set_flashdata('failed', '');
        $title['title'] = 'Vendor';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $vendor = $this->Vendor_model;
            $validation = $this->form_validation;
            $validation->set_rules($vendor->rules());

            if ($validation->run() == TRUE) {
                $kode_vendor = $vendor->save();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'vendor';
                $data_log['KODE_DATA'] = $kode_vendor;
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
            } else {
                $this->session->set_flashdata('failed', 'Data yang dimasukan kosong atau sudah ada');
            }

            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $data);
            $this->load->view('templates/footer.php');
            redirect('vendor');
        } else {
            redirect('vendor');
        }
    }

    public function delete($vendor = null)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if (empty("vendor")) redirect('termin');
            $thisdata = $this->Vendor_model->getById($vendor);
            if ($thisdata->STATUS < 1) {

                $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'vendor';
                $data_log['KODE_DATA'] = $vendor;
                $data_log['ACTIVITY'] = 'delete';
                $log->save($data_log);

                $this->Vendor_model->delete($vendor);
                $this->session->set_flashdata('delete_success', 'Data berhasil dihapus');
            } else {
                $this->session->set_flashdata('delete_failed', 'Gagal menghapus data. Jenis project sedang digunakan.');
            }
            redirect('vendor');
        } else {
            redirect('vendor');
        }
    }
}
