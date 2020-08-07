<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Invoice_model");
        $this->load->model("Termin_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["invoice"] = $this->Invoice_model->getAll();
        $this->load->view("Invoice/invoice", $data);
    }

    public function add()
    {
        $post = $this->input->post();
        $invoice = $this->Invoice_model;
        $termin= $this->Termin_model;
        $validation = $this->form_validation;
        $validation->set_rules($invoice->rules());
        if ($validation->run()) {
            $invoice->save();
            // $termin->hupla();
            $termin->paid($post["KODE_TERMIN"]);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        else if(!empty($post["nopks"])){
        if(count($termin->hasBeenPaid($post["nopks"]))>0){//kalau ada data di pks=udah lunas
            $this->session->set_flashdata('failed', "Invoice PKS sudah lunas");
        }
        else{//kalau gak ketemu salah input berarti
            $this->session->set_flashdata('not_found', "PKS tidak ditemukan");
        }
    }
        else{
            $this->session->set_flashdata('empty', "Harap masukan Kode ");

        }
        $this->load->view("Invoice/create_invoice");
    }


    public function delete($invoice=null)
    {
        if (!isset($invoice)) show_404();
        if ($this->Invoice_model->delete($invoice)) {
            redirect(site_url('Invoice'));
        }
    }
    function search(){//Auto complete search for Termin
        if (isset($_GET['nim'])) {
            $this->load->model("Termin_model");
            $res= $this->Termin_model->seeThisTermin2($_GET['nim']);
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