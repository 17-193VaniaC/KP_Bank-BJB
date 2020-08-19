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
        $this->load->model("Log_model");
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

        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $mutasi_rbb = $this->MutasiRBB_model;
            $rbb = $this->RBB_model;
            $validation = $this->form_validation;
            $validation->set_rules($mutasi_rbb->rules());

            if ($validation->run() == TRUE) {
                if ($rbb->isExist() == FALSE) {
                    $this->session->set_flashdata('failed', 'Mutasi RBB tidak ditemukan');
                    $this->load->view("Mutasi_RBB/add_mutasi_rbb", $mutasi_rbb);
                }
                if ($rbb->sych() == FALSE) {
                    $this->session->set_flashdata('failed', 'Anggaran baru kurang dari nominal PKS');
                    $this->load->view("Mutasi_RBB/add_mutasi_rbb", $mutasi_rbb);
                }
                $kode_rbb = $mutasi_rbb->save();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'mutasi_rbb';
                $data_log['KODE_DATA'] = $kode_rbb;
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            // $this->session->set_flashdata('failed', 'Tidak sesuai rule');

            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("Mutasi_RBB/add_mutasi_rbb", $mutasi_rbb);
            $this->load->view('templates/footer.php');
        } else {
            redirect('Mutasi_RBB');
        }
    }
}
