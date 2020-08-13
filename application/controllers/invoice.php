<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Invoice_model");
        $this->load->model("Termin_model");
        $this->load->model("Pks_model");
        $this->load->model("MutasiPKS_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["invoice"] = $this->Invoice_model->getAll();
        $this->load->view("Invoice/invoice", $data);
    }

    public function add()
    {   
        $title['title'] = 'Invoice';
        $post = $this->input->post();
        $invoice = $this->Invoice_model;
        $termin = $this->Termin_model;
        $pks = $this->Pks_model;
        $validation = $this->form_validation;
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $validation->set_rules($invoice->rules());
        if ($validation->run()) {
            $invoice->save();

            // $termin->hupla();
            $termin->paid($post["KODE_TERMIN"]);
            $no_pks = $termin->sisaAnggaran($post['KODE_TERMIN']);


            $data_pks = $pks->getById($no_pks['NO_PKS']);

            $sisa = $data_pks['SISA_ANGGARAN'] - $post['NOMINAL'];

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

            $this->session->set_flashdata('success', 'Berhasil disimpan');
        } else if (!empty($post["nopks"])) {
            if (count($termin->hasBeenPaid($post["nopks"])) < 1) { //kalau ada data di pks=udah lunas
                $this->session->set_flashdata('failed', "Invoice PKS sudah lunas");
            } else { //kalau gak ketemu salah input berarti
                $this->session->set_flashdata('not_found', "PKS tidak ditemukan");
            }
        }
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Invoice/create_invoice", $data);
    }


    public function delete($invoice = null)
    {
        if (!isset($invoice)) show_404();
        if ($this->Invoice_model->delete($invoice)) {
            redirect(site_url('Invoice'));
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
