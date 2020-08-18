<?php

defined('BASEPATH') or exit('No direct script access allowed');

class JProject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model("JProject_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Jenis Project';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data['counter'] = 1;
        $data["jenis"] = $this->JProject_model->getAll();
        $jenis = $this->JProject_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenis->rules());

        $var = 0;
        if ($validation->run() == TRUE) {
            if ($data['user']['ROLE'] == 'IT FINANCE') {
                $var = 1;
                $kode_jenis = $jenis->update();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'j_project';
                $data_log['KODE_DATA'] = $kode_jenis;
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Data berhasil diubah');
                $data["jenis"] = $this->JProject_model->getAll();
            } else {
                redirect('JProject');
            }
        }
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/jenis_project", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $jenis = $this->JProject_model;
            $validation = $this->form_validation;
            $validation->set_rules($jenis->rules());

            if ($validation->run() == TRUE) {
                $kode_jenis = $jenis->save();

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'jenis project';
                $data_log['KODE_DATA'] = $kode_jenis;
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
            redirect('jenis_project');
        } else {
            redirect('JProject');
        }
    }

    public function delete($jenis = null)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if (empty("jenis")) redirect('jproject');
            $thisdata = $this->JProject_model->getById($jenis);
            if ($thisdata->STATUS < 1) {
                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'jenis project';
                $data_log['KODE_DATA'] = $jenis;
                $data_log['ACTIVITY'] = 'delete';
                $log->save($data_log);

                $this->JProject_model->delete($jenis);
                $this->session->set_flashdata('success', 'Your data has been deleted');
            } else {
                $this->session->set_flashdata('failed', 'Gagal menghapus data. Jenis project sedang digunakan.');
            }
            redirect('jproject');
        } else {
            redirect('Jproject');
        }
    }
}
