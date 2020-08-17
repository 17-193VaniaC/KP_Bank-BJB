<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Termin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->load->model("Termin_model");
        $this->load->model("Pks_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }

    public function index($nopks = null)
    {
        $title['title'] = 'Termin';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data["termin"] = $this->Termin_model->getAll($nopks);

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Termin/Termin", $data);
        $this->load->view('templates/footer.php');
    }

    // untuk menambah termin dari halaman termin
    public function addMore($no_pks, $termin)
    {   
        $no_pks = str_replace('_', '/', $no_pks);
        $title['title'] = 'Create Termin';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $data['termin'] = $this->Termin_model;
            $validation = $this->form_validation;
            $validation->set_rules($data['termin']->rules());

            $data['no_pks'] = $no_pks;
            $data['termin_ke'] = $termin;
            $data['gl'] = $this->db->get('gl')->result();



            if ($validation->run() == FALSE) {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $data);
                $this->load->view("Termin/add_termin_pks", $data);
                $this->load->view('templates/footer.php');
            } else {
                $kode_termin = $data['termin']->save($no_pks);

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'termin_pks';
                $data_log['KODE_DATA'] = $kode_termin;
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);
                $no_pks = str_replace('/', '_', $no_pks);
                redirect('Termin/Termin_pks/' . $no_pks);
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            }
        } 
        else {
            $no_pks = str_replace('/', '_', $no_pks);
            redirect('Termin/Termin_pks/' . $no_pks);
        }
    }

    public function getCategoryGL(){
        $ketegori_ = $this->input->post('KATEGORI',TRUE);
        // var_dump($kategori_);
        if($kategori_= 'Maintenance' | $kategori_ = 'Pembayaran rutin bulanan'){
            $k = "Operating Expense";
            // echo "string";
        }
        else{
            $k = "Capital Expense";
        }
        $data = $this->Termin_model->getGL($k);
        echo json_encode($data);
    }

    public function add()
    {   
        $NOPKS = str_replace('_', '/', $_GET["NOPKS"]);
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {

            $data['termin'] = $this->Termin_model;
            $validation = $this->form_validation;
            $validation->set_rules($data['termin']->rules());

            if ($validation->run() == TRUE) {
                $kode_termin = $data['termin']->save($NOPKS);

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'termin_pks';
                $data_log['KODE_DATA'] = $kode_termin;
                $data_log['ACTIVITY'] = 'add';
                $log->save($data_log);

                $this->session->set_flashdata('success', 'Berhasil disimpan');
                $NPAYMENT = $_GET['n'] + 1;
                $NOPKS = str_replace('_', '/', $_GET["NOPKS"]);

                redirect("Termin/add/" . $NOPKS . "/" . $NTERMIN . "/" .$NPAYMENT );
            }
            if ($NTERMIN < $NPAYMENT) {
                // var_dump(expression)
                redirect(site_url('termin'));
            }
            // $data['nopks'] = $NOPKS;
            // $data['ntermin'] = $NTERMIN;;
            // $data['npayment'] = $NPAYMENT;
            // echo $NPAYMENT;
  
            $this->load->view("Termin/add_termin/", $data);
        } else {
            redirect('Termin');
        }
    }

    public function edit($KODETERMIN, $NO_PKS)
    {
        $title['title'] = 'Edit Termin';

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $NO_PKS = str_replace('_', '/', $NO_PKS);
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if ($KODETERMIN == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Termin yang telah dibayar tidak bisa diubah! .</div>');
                redirect('Termin/termin_pks/' . $NO_PKS);
            }
            $termin = $this->Termin_model;
            $KODETERMIN = str_replace('_', '/', $_GET["NOPKS"]);

            $data['termin'] = $this->Termin_model->getById($KODETERMIN);
            $validation = $this->form_validation;
            $validation->set_rules($termin->rules());

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $data);
                $this->load->view('Termin/edit_termin', $data);
                $this->load->view('templates/footer.php');
            } else {
                $termin->update($KODETERMIN);

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'termin_pks';
                $data_log['KODE_DATA'] = $KODETERMIN;
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);
                $NO_PKS = str_replace('/', '_', $NO_PKS);
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect('Termin/termin_pks/' . $NO_PKS);
            }

            // if (!isset($KODETERMIN)) redirect('rbb');

            // $termin = $this->Termin_model;
            // $validation = $this->form_validation;
            // $validation->set_rules($termin->rules());

            // if ($validation->run()) {
            //     $termin->update();
            //     $this->session->set_flashdata('success', 'Berhasil disimpan');
            // }

            // $data["termin"] = $termin->getById($KODETERMIN);
            // if (!$data["termin"]) show_404();
            // $this->load->view("Termin/edit_termin", $data);
        } else {
            redirect('Termin/termin_pks/' . $NO_PKS);
        }
    }

    public function delete($KODETERMIN, $NO_PKS)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if ($KODETERMIN == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Termin yang telah dibayar tidak bisa dihapus! .</div>');
                redirect('Termin/termin_pks/' . $NO_PKS);
            }

            if (!isset($KODETERMIN)) show_404();

            if ($this->Termin_model->delete($KODETERMIN)) {
                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'termin_pks';
                $data_log['KODE_DATA'] = $KODETERMIN;
                $data_log['ACTIVITY'] = 'delete';
                $log->save($data_log);

                redirect(site_url('Termin/termin_pks/' . $NO_PKS));
            }
        } else {
            redirect('Termin/termin_pks/' . $NO_PKS);
        }
    }

    // untuk menampilkan termin per pks
    public function Termin_pks($nopks)
    {   $nopks = str_replace('_', '/', $nopks);
        $data["termin"] = $this->Termin_model->getAll($nopks);
        $data["pks"] = $this->Pks_model->getById($nopks);
        $title['title'] = 'Termin PKS NO. ' . $nopks;
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data['no_pks'] = $nopks;
        $data['total'] = 0;
        $data['baris'] = 1;

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
