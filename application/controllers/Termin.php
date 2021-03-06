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
        $this->load->library('pagination');
        $this->load->model("Termin_model");
        $this->load->model("Pks_model");
        $this->load->model("Log_model");
        $this->load->library('form_validation');
    }
    public function index()
    {
        $title['title'] = 'Termin';

        // Config pagination
        $config['base_url'] = base_url('termin/index');
        // $config['total_rows'] = $this->db->count_all('termin_pks');
        $config['per_page'] = 20;
        $config["uri_segment"] = 0;

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
            $this->session->set_flashdata(array("search_termin"=>$id));  
            $data['search']=$id;
            $n_row = $this->Termin_model->countquery($id)[0]->n_row;
            $config['total_rows'] = $n_row;
            $data['page'] = 0;
        } 
        else{
            if($this->session->userdata('search_termin') != NULL){
                $data['search']= $this->session->flashdata('search_termin');
                $n_row = $this->Termin_model->countquery($data['search'])[0]->n_row;
                $config['total_rows'] = $n_row;
            }
            else{
                $data['search']= '';
                $config['total_rows'] = $this->db->count_all('termin_pks');
            }
        }
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data['termin'] = $this->Termin_model->getPagination($data['search'], $config["per_page"], $data['page']);  

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("Termin/termin", $data);
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

            if($this->Termin_model->countTermin($no_pks)==15){
                $no_pks = str_replace('/', '_', $no_pks);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Jumlah termin tidak bisa melebihin 15 termin</div>');
                redirect('Termin/Termin_pks/' . $no_pks);

            }

            if ($validation->run() == FALSE) {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $data);
                $this->load->view("Termin/add_termin_pks", $data);
                $this->load->view('templates/footer.php');
            } 
            else {
                $pks = $this->Pks_model;
                $data_PKS = $pks->getById($data['no_pks']);
                $nominal_total = $this->Termin_model->getRemainingBudget($data['no_pks']);

                if ($data_PKS['NOMINAL_PKS'] < $nominal_total[0]->anggaranpakai + $this->input->post('NOMINAL')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Nominal termin melebihi sisa anggaran PKS</div>');
                    $this->load->view('templates/header.php', $title);
                    $this->load->view('templates/navbar.php', $data);
                    $this->load->view("Termin/add_termin_pks", $data);
                    $this->load->view('templates/footer.php');
                } 
                else {
                    $kode_termin = $data['termin']->save($no_pks);

                    // ADD LOG
                    $log = $this->Log_model;
                    $data_log['USER'] = $data['user']['NAMA'];
                    $data_log['TABLE_NAME'] = 'termin_pks';
                    $data_log['KODE_DATA'] = $kode_termin;
                    $data_log['ACTIVITY'] = 'add';
                    $log->save($data_log);
                    $no_pks = str_replace('/', '_', $no_pks);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil disimpan</div>');
                    redirect('Termin/Termin_pks/' . $no_pks);
                }
            }
        } else {
            $no_pks = str_replace('/', '_', $no_pks);
            redirect('Termin/Termin_pks/' . $no_pks);
        }
    }

    public function getCategoryGL()
    {

        $kategori_y = $this->input->post('KATEGORI', TRUE);
        // var_dump($kategori_);
        if (!strncmp($kategori_y, "Maintenance", 7) || !strncmp('Pembayaran rutin bulanan', $kategori_y, 7)) {
            $k = "Operating Expense";
            // echo strcmp($kategori_y, "Maintenance");
        } else {
            $k = "Capital Expense";
            // redirect('pks');
        }
        $data = $this->Termin_model->getGL($k);
        echo json_encode($data);
    }

    // public function add()
    // {   
    //     $NOPKS = str_replace('_', '/', $_GET["NOPKS"]);
    //     $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
    //     if ($data['user']['ROLE'] == 'IT FINANCE') {

    //         $data['termin'] = $this->Termin_model;
    //         $validation = $this->form_validation;
    //         $validation->set_rules($data['termin']->rules());

    //         if ($validation->run() == TRUE) {
    //             $kode_termin = $data['termin']->save($NOPKS);

    //             // ADD LOG
    //             $log = $this->Log_model;
    //             $data_log['USER'] = $data['user']['NAMA'];
    //             $data_log['TABLE_NAME'] = 'termin_pks';
    //             $data_log['KODE_DATA'] = $kode_termin;
    //             $data_log['ACTIVITY'] = 'add';
    //             $log->save($data_log);

    //             $this->session->set_flashdata('success', 'Berhasil disimpan');
    //             $NPAYMENT = $_GET['n'] + 1;
    //             $NOPKS = str_replace('_', '/', $_GET["NOPKS"]);

    //             redirect("Termin/add/" . $NOPKS . "/" . $NTERMIN . "/" .$NPAYMENT );
    //         }
    //         if ($NTERMIN < $NPAYMENT) {
    //             // var_dump(expression)
    //             redirect(site_url('termin'));
    //         }
    //         // $data['nopks'] = $NOPKS;
    //         // $data['ntermin'] = $NTERMIN;;
    //         // $data['npayment'] = $NPAYMENT;
    //         // echo $NPAYMENT;

    //         $this->load->view("Termin/add_termin/", $data);
    //     } else {
    //         redirect('Termin');
    //     }
    // }

    public function edit($KODETERMIN, $KODE_PKS)
    {
        $NO_PKS = str_replace('/', '_', $KODE_PKS);
        $NOPKS = str_replace('_', '/', $KODE_PKS);
        $title['title'] = 'Edit Termin';

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        // $NO_PKS = str_replace('_', '/', $NO_PKS);
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if ($KODETERMIN == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Termin yang telah dibayar tidak bisa diubah!</div>');
                redirect('Termin/termin_pks/' . $NO_PKS);
            }
            $termin = $this->Termin_model;
            // $KODETERMIN = str_replace('_', '/', $_GET["NOPKS"]);
            $data['termin'] = $this->Termin_model->getById($KODETERMIN);
            $data['GL_'] = $this->db->get('GL')->result();
            $validation = $this->form_validation;
            $validation->set_rules($termin->rules());

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $data);
                $this->load->view('Termin/edit_termin', $data);
                $this->load->view('templates/footer.php');
            } else {
                $pks = $this->Pks_model;
                $data_PKS = $pks->getById($NOPKS);
                $termintotal = $termin->getRemainingBudget($NOPKS);
                $nominal_total = $termin->getNominal($KODETERMIN);
                // var_dump($data_PKS["NOMINAL_PKS"]);
                // var_dump($termintotal[0]->anggaranpakai);
                // var_dump($nominal_total->NOMINAL);
                // die;


                if ($this->input->post('NOMINAL') > $data_PKS["NOMINAL_PKS"] - $termintotal[0]->anggaranpakai + $nominal_total->NOMINAL) {//Nominal input > Nominal PKS - total nominal termin dulu
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Nominal termin melebihi sisa anggaran PKS</div>');
                    $this->load->view('templates/header.php', $title);
                    $this->load->view('templates/navbar.php', $data);
                    $this->load->view('Termin/edit_termin', $data);
                    $this->load->view('templates/footer.php');
                } 
                else {
                    $termin->update($KODETERMIN);
                    $log = $this->Log_model;
                    $data_log['USER'] = $data['user']['NAMA'];
                    $data_log['TABLE_NAME'] = 'termin_pks';
                    $data_log['KODE_DATA'] = $KODETERMIN;
                    $data_log['ACTIVITY'] = 'edit';
                    $log->save($data_log);
                    $NO_PKS = str_replace('/', '_', $NO_PKS);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                    redirect('Termin/termin_pks/' . $NO_PKS);
                }
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

    public function edit2($KODETERMIN)
    {
        $title['title'] = 'Edit Termin';

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if ($KODETERMIN == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Termin yang telah dibayar tidak bisa diubah!</div>');
                redirect('Termin/');
            }
            $termin = $this->Termin_model;
            // $KODETERMIN = str_replace('_', '/', $_GET["NOPKS"]);

            $data['termin'] = $this->Termin_model->getById($KODETERMIN);
            $data['GL_'] = $this->db->get('GL')->result();
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
                // $NO_PKS = str_replace('/', '_', $NO_PKS);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('Termin/');
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
            redirect('Termin');
        }
    }
    public function delete($KODETERMIN, $NO_PKS)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            if ($KODETERMIN == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Termin yang telah dibayar tidak bisa dihapus!</div>');
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

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus</div>');
                redirect(site_url('Termin/termin_pks/' . $NO_PKS));
            }
        } else {
            redirect('Termin/termin_pks/' . $NO_PKS);
        }
    }

    // untuk menampilkan termin per pks
    public function Termin_pks($nopks)
    {
        $nopks = str_replace('_', '/', $nopks);
        $data["termin"] = $this->Termin_model->getByIdPKS($nopks);
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
