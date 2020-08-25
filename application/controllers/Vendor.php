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

        $this->load->library('pagination');
        $this->load->model("Vendor_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Vendor';

        // Config pagination
        $config['base_url'] = base_url('vendor/index');
        $config['total_rows'] = $this->db->count_all('vendor');
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;

        // Pagination style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["vendor"] = $this->Vendor_model->getAll();
       
        if (!empty($this->input->post('Search'))) {
            $id = $this->input->post('searchById');
            $this->session->set_flashdata(array("search_vendor"=>$id));
            $data["search"] = $id;
            $n_row = $this->Vendor_model->countquery($id)[0]->n_row;
            $config['total_rows'] = $n_row;
            $data['page'] = 0;
        } 
        else{
            if($this->session->flashdata('search_vendor') != NULL){
                $data['search']= $this->session->flashdata('search_vendor');
                $n_row = $this->Vendor_model->countquery($data['search'])[0]->n_row;
                $config['total_rows'] = $n_row;
            }
            else{
                $data['search']= '';
                $config['total_rows'] = $this->db->count_all('vendor');
            }
        }
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        
        $data['vendor'] = $this->Vendor_model->getPagination($data["search"], $config["per_page"], $data['page']);
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['counter'] = $data['page'];

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("IT_FINANCE/vendor", $data);
        $this->load->view('templates/footer.php');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $data["vendor"] = $this->Vendor_model->getAll();
        $vendor = $this->Vendor_model;
        $validation = $this->form_validation;
        $validation->set_rules($vendor->rules());
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
            } else {
                redirect('vendor');
            }
        }
        redirect('vendor');
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
            } 
            else {
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
                $this->session->set_flashdata('success', 'Data berhasil dihapus');
            } else {
                $this->session->set_flashdata('failed', 'Gagal menghapus data. Jenis project sedang digunakan.');
            }
            redirect('vendor');
        } else {
            redirect('vendor');
        }
    }
}
