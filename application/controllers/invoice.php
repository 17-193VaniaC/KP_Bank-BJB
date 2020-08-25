<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->library('pagination');
        $this->load->model("Invoice_model");
        $this->load->model("Termin_model");
        $this->load->model("Pks_model");
        $this->load->model("MutasiPKS_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Invoice';

        // Config pagination
        $config['base_url'] = base_url('Invoice/index');
        $config['per_page'] = 2;
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

        if (!empty($this->input->post('Search'))) {
            $id = $this->input->post('searchById');
            $this->session->set_flashdata(array("search_invoice"=>$id));  
            $data['search']=$id;
            $n_row = $this->Invoice_model->countquery($id)[0]->n_row;
            $config['total_rows'] = $n_row;
            $data['page'] = 0;
        } 
        else{
            if($this->session->flashdata('search_invoice') != NULL){
                $data['search']= $this->session->flashdata('search_invoice');
                $n_row = $this->Invoice_model->countquery($data['search'])[0]->n_row;
                $config['total_rows'] = $n_row;
            }
            else{
                $data['search']= '';
                $config['total_rows'] = $this->db->count_all('pembayaran');
            }
        }
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
      

        $data['invoice'] = $this->Invoice_model->getPagination($data['search'], $config["per_page"], $data['page']);
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        //initialize pagination and create
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Invoice/invoice", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $title['title'] = 'Add Invoice';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $post = $this->input->post();
            $invoice = $this->Invoice_model;
            $termin = $this->Termin_model;
            $pks = $this->Pks_model;
            $validation = $this->form_validation;
            $validation->set_rules($invoice->rules());

            if ($validation->run()) {
                if (count($termin->hasntBeenPaid($post["nopks"])) < 1) { //kalau ada data di pks=udah lunas
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invoice PKS sudah lunas</div>');
                    redirect('invoice/add');
                }


                $no_pks = $termin->sisaAnggaran($post['KODE_TERMIN']);


                $data_pks = $pks->getById($no_pks['NO_PKS']);

                $sisa = $data_pks['SISA_ANGGARAN'] - $post['NOMINAL'];

                if ($sisa >= 0) {
                    $invoice->save();
                    $termin->paid($post["KODE_TERMIN"]);
                    $this->db->set('sisa_anggaran', $sisa);
                    $this->db->where('no_pks', $no_pks['NO_PKS']);
                    $this->db->update('pks');

                    $data_termin = $termin->getById($post["KODE_TERMIN"]);

                    $mutasi_pks = $this->MutasiPKS_model;
                    $mutasi_pks->save($data_termin);

                    // ADD LOG
                    $log = $this->Log_model;
                    $data_log['USER'] = $data['user']['NAMA'];
                    $data_log['TABLE_NAME'] = 'invoice';
                    $data_log['KODE_DATA'] = $this->input->post('INVOICE');
                    $data_log['ACTIVITY'] = 'add';
                    $log->save($data_log);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                    redirect('Invoice');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nominal Invoice melebihi sisa anggaran PKS. Harap cek kembali nominal termin yang akan dibayarkan</div>');
                    $this->load->view('templates/header.php', $title);
                    $this->load->view('templates/navbar.php', $data);
                    $this->load->view("Invoice/create_invoice", $data);
                    $this->load->view('templates/footer.php', $data);
                }
            } else {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $data);
                $this->load->view("Invoice/create_invoice", $data);
                $this->load->view('templates/footer.php', $data);
            }

            if (empty($this->input->post('termin')) && !empty($this->input->post('nopks'))) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invoice PKS sudah lunas atau tidak ditemukan</div>');
                redirect('Invoice/add');
            }
        }
    }


    public function delete($invoice = null)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if (!isset($invoice)) show_404();
            if ($this->Invoice_model->delete($invoice)) {
                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'invoice';
                $data_log['KODE_DATA'] = $this->input->post('INVOICE');
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                redirect(site_url('Invoice'));
            }
        } else {
            redirect('Invoice');
        }
    }
    function search()
    { //Auto complete search for Termin
        if (isset($_GET['nim'])) {
            $this->load->model("Termin_model");
            $res = $this->Termin_model->seeThisTermin2($_GET['nim']);
            // if(count($res)>0){
            // foreach ($res as $reskey)
            // $arr_res[] = $reskey->NO_PKS;
            $arr_res   = array(
                'NOPKS' => $res["NO_PKS"],
                'kodetermin' => $res["KODE_TERMIN"],
                'termin' => $res["TERMIN"],
                'nominal' => $res["NOMINAL"]
            );

            echo json_encode($arr_res);
        }
    }
}
