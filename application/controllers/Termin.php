<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Termin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Termin_model");
        $this->load->model("Pks_model");
        $this->load->library('form_validation');
    }

    public function index($nopks = null)
    {
        $data["termin"] = $this->Termin_model->getAll($nopks);
        $this->load->view("Termin/Termin", $data);
    }

    public function add($NOPKS = NULL, $NTERMIN = NULL, $NPAYMENT = NULL)
    {
        if (empty($NOPKS) | empty($NTERMIN) | empty($NPAYMENT)) {
            redirect(site_url('termin/add'));
        }
        $data['termin'] = $this->Termin_model;
        $validation = $this->form_validation;
        $validation->set_rules($data['termin']->rules());

        if ($validation->run() == TRUE) {
            $data['termin']->save($NOPKS);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $NPAYMENT = $NPAYMENT + 1;
        }
        if ($NTERMIN < $NPAYMENT) {
            redirect(site_url('termin'));
        }
        $data['nopks'] = $NOPKS;
        $data['ntermin'] = $NTERMIN;;
        $data['npayment'] = $NPAYMENT;
        echo $NPAYMENT;
        $this->load->view("Termin/add_termin", $data);
    }

    public function edit($KODETERMIN = null)
    {
        if (!isset($KODETERMIN)) redirect('rbb');

        $termin = $this->Termin_model;
        $validation = $this->form_validation;
        $validation->set_rules($termin->rules());

        if ($validation->run()) {
            $termin->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["termin"] = $termin->getById($KODETERMIN);
        if (!$data["termin"]) show_404();
        $this->load->view("Termin/edit_termin", $data);
    }

    public function delete($KODETERMIN = null)
    {
        if (!isset($KODETERMIN)) show_404();

        if ($this->Termin_model->delete($KODETERMIN)) {
            redirect(site_url('Termin'));
        }
    }
    public function Termin_pks($nopks)
    {
        $data["termin"] = $this->Termin_model->getAll($nopks);
        $data["pks"] = $this->Pks_model->getById($nopks);
        $title['title'] = 'Termin PKS NO. ' . $nopks;
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data['no_pks'] = $nopks;
        $data['total'] = 0;

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Termin/termin_pks", $data);
        $this->load->view('templates/footer.php');
    }

    function search()
    { //Auto complete search for Termin
        if (isset($_GET['term'])) {
            $this->load->model("Termin_model");
            $ress = $this->Termin_model->seeThisTermin($_GET['term']);
            if (count($ress) > 0) {
                foreach ($ress as $reskey)
                    $arr_res[] = $reskey->NO_PKS;
                echo json_encode($arr_res);
            }
        }
    }
}
