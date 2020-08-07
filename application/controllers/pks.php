<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('RBB_model');
        $this->load->model('Pks_model');
        $this->load->model('Vendor_model');
    }

    public function index()
    {
        $title['title'] = 'PKS';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $hupla = $this->input->get('searchById');
        $data['pks'] = $this->Pks_model->getAll($hupla);

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('pks/index', $data);
        $this->load->view('templates/footer.php');
    }

    public function create()
    {
        $title['title'] = 'Create PKS';
        $dataa['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $dataa['no_rbb'] = $this->RBB_model->getKode();
        $dataa['vendor'] = $this->Vendor_model->getAll();

        $this->form_validation->set_rules('no_pks', 'No_pks', 'required|trim|is_unique[pks.no_pks]');
        $this->form_validation->set_rules('kode_rbb', 'Kode_rbb', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('kode_project', 'Kode_project', 'required|trim');
        $this->form_validation->set_rules('nama_project', 'Nama_project', 'required|trim');
        $this->form_validation->set_rules('tgl_pks', 'Tgl_pks', 'required|trim');
        $this->form_validation->set_rules('nominal_pks', 'Nominal_pks', 'required|trim');
        $this->form_validation->set_rules('nama_vendor', 'Nama_vendor', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $dataa);
            $this->load->view('pks/create', $dataa);
            $this->load->view('templates/footer.php');
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
            $n_termin = $this->input->post('termin');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your program has been created.</div>');
            if (empty($n_termin)) { //termin lebih dari satu, diarahkan ke halaman termin
                redirect('pks/index');
            } else {
                redirect('Termin/add/' . $data['no_pks'] . "/" . $n_termin . "/1");
            }
        }
    }


    public function edit($no_pks)
    {
        $title['title'] = 'Edit PKS';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data['pks'] = $this->Pks_model->getById($no_pks);
        $data['no_rbb'] = $this->RBB_model->getKode();
        $data['vendor'] = $this->Vendor_model->getAll();

        $this->form_validation->set_rules('kode_rbb', 'Kode_rbb', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('kode_project', 'Kode_project', 'required|trim');
        $this->form_validation->set_rules('nama_project', 'Nama_project', 'required|trim');
        $this->form_validation->set_rules('tgl_pks', 'Tgl_pks', 'required|trim');
        $this->form_validation->set_rules('nominal_pks', 'Nominal_pks', 'required|trim');
        $this->form_validation->set_rules('nama_vendor', 'Nama_vendor', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php');
            $this->load->view('templates/navbar.php', $data);
            $this->load->view('pks/edit', $data);
            $this->load->view('templates/footer.php');
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

    public function search()
    { //Auto complete search
        if (isset($_GET['term'])) {
            $res = $this->Pks_model->seeThisPKS($_GET['term']);
            if (count($res) > 0) {
                foreach ($res as $reskey)
                    $arr_res[] = $reskey->NO_PKS;
                echo json_encode($arr_res);
            }
        }
    }
}
