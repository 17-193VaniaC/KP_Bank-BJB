<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('RBB_model');
        $this->load->model('Pks_model');
        $this->load->model('Vendor_model');
    }

    public function index()
    {
        $pks['pks'] = $this->Pks_model->getData();
        $this->load->view('pks/index', $pks);
    }

    public function create()
    {
        $dataa['no_rbb'] = $this->RBB_model->getKode();
        $dataa['vendor'] = $this->Vendor_model->getData();

        // $dataa['no_rbb'] = $no_rbb;
        // $dataa['vendor'] = $vendor;

        // var_dump($dataa);
        // die;

        $this->form_validation->set_rules('no_pks', 'No_pks', 'required|trim|is_unique[pks.no_pks]');
        $this->form_validation->set_rules('kode_rbb', 'Kode_rbb', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('kode_project', 'Kode_project', 'required|trim');
        $this->form_validation->set_rules('nama_project', 'Nama_project', 'required|trim');
        $this->form_validation->set_rules('tgl_pks', 'Tgl_pks', 'required|trim');
        $this->form_validation->set_rules('nominal_pks', 'Nominal_pks', 'required|trim');
        $this->form_validation->set_rules('nama_vendor', 'Nama_vendor', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('pks/create', $dataa);
            // $this->load->view('pks/create', $dataa);
        } else {
            $data = [
                'no_pks' => $this->input->post('no_pks'),
                'kode_rbb' => $this->input->post('kode_rbb'),
                'jenis' => $this->input->post('jenis'),
                'kode_project' => $this->input->post('kode_project'),
                'nama_project' => $this->input->post('nama_project'),
                'tgl_pks' => $this->input->post('tgl_pks'),
                'nominal_pks' => $this->input->post('nominal_pks'),
                'nama_vendor' => $this->input->post('nama_vendor'),
                'input_user' => $this->input->post('nama_vendor'),
                'input_date' => time()
            ];

            $this->db->insert('pks', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your program has been created.</div>');
            redirect('pks/index');
        }
    }

    public function edit($no_pks)
    {
        $data['pks'] = $this->Pks_model->getById($no_pks);
        $data['no_rbb'] = $this->RBB_model->getKode();
        $data['vendor'] = $this->Vendor_model->getData();

        $this->form_validation->set_rules('kode_rbb', 'Kode_rbb', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('kode_project', 'Kode_project', 'required|trim');
        $this->form_validation->set_rules('nama_project', 'Nama_project', 'required|trim');
        $this->form_validation->set_rules('tgl_pks', 'Tgl_pks', 'required|trim');
        $this->form_validation->set_rules('nominal_pks', 'Nominal_pks', 'required|trim');
        $this->form_validation->set_rules('nama_vendor', 'Nama_vendor', 'required|trim');

        if ($this->form_validation->run() == false) {
            echo 'oiii';
            $this->load->view('pks/edit', $data);
            // $this->load->view('pks/create', $dataa);
        } else {
            $kode_rbb = $this->input->post('kode_rbb');
            $jenis = $this->input->post('jenis');
            $kode_project = $this->input->post('kode_project');
            $nama_project = $this->input->post('nama_project');
            $tgl_pks = $this->input->post('tgl_pks');
            $nominal_pks = $this->input->post('nominal_pks');
            $nama_vendor = $this->input->post('nama_vendor');

            $this->db->set('kode_rbb', $kode_rbb);
            $this->db->set('jenis', $jenis);
            $this->db->set('kode_project', $kode_project);
            $this->db->set('nama_project', $nama_project);
            $this->db->set('tgl_pks', $tgl_pks);
            $this->db->set('nominal_pks', $nominal_pks);
            $this->db->set('nama_vendor', $nama_vendor);
            $this->db->where('no_pks', $no_pks);
            $this->db->update('pks');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your program has been edited.</div>');
            redirect('pks/index');
        }
    }

    public function delete($no_pks)
    {
        $data['pks'] = $this->Pks_model->deleteData($no_pks);

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Your data has been deleted.</div>');
        redirect('pks/index');
    }
}
