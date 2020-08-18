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
        $this->load->model("Pks_model");
        $this->load->model("Log_model");
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
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $data['gl'] = $this->db->get('gl')->result();
            $rbb = $this->RBB_model;
            $validation = $this->form_validation;
            $validation->set_rules($rbb->rules());

            if ($validation->run() == TRUE) {
                $rbb->save();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'rbb';
                $data_log['KODE_DATA'] = $this->input->post('KODE_RBB');
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }

            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("RBB/create_rbb", $data);
            $this->load->view('templates/footer.php');
        } else {
            redirect('RBB');
        }
    }

    public function edit($KODE_RBB = null)
    {
        $title['title'] = 'Edit RBB';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if (!isset($KODE_RBB)) redirect('rbb');

            $rbb = $this->RBB_model;
            $validation = $this->form_validation;
            $validation->set_rules($rbb->rules2());

            if ($validation->run()) {
                $rbb->update();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'rbb';
                $data_log['KODE_DATA'] = $this->input->post('KODE_RBB');
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }

            $data["rbb"] = $rbb->getById($KODE_RBB);
            $data['gl'] = $this->db->get('gl')->result();

            if (!$data["rbb"]) show_404();

            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("RBB/edit_rbb", $data);
            $this->load->view('templates/footer.php');
        } else {
            redirect('RBB');
        }
    }

    public function delete($kode_rbb)
    {
        $pks = $this->Pks_model;
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $data_pks = $pks->getByRBB($kode_rbb);

            if (!$data_pks) {
                $rbb = $this->RBB_model;

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'rbb';
                $data_log['KODE_DATA'] = $kode_rbb;
                $data_log['ACTIVITY'] = 'delete';
                $log->save($data_log);

                $rbb->delete($kode_rbb);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> RBB berhasil dihapus.</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> RBB tidak bisa dihapus karena telah terdapat data PKS. Jika ingin menghapus, silahkan hapus data PKS terlebih dahulu</div>');
            }
        }

        redirect('RBB');
    }
}
