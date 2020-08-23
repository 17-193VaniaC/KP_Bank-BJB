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

        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('RBB_model');
        $this->load->model('MutasiRBB_model');
        $this->load->model('Pks_model');
        $this->load->model('Vendor_model');
        $this->load->model('JProject_model');
        $this->load->model('Termin_model');
        $this->load->model('Log_model');
    }

    public function index()
    {
        $title['title'] = 'PKS';

        if ($hupla = $this->input->get('searchById')) {
            $data['pks'] = $this->Pks_model->getAll($hupla);
            $data['pagination'] = null;
        } else {
            // Config pagination
            $config['base_url'] = base_url('pks/index');

            // $config['total_rows'] = $this->db->where('NO_PKS', $hupla)->from("pks")->count_all_results();
            $config['total_rows'] = $this->db->count_all('pks');
            $config['per_page'] = 25;
            $config["uri_segment"] = 3;
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

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

            $this->pagination->initialize($config);

            $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


            $data['pks'] = $this->Pks_model->getPagination($config["per_page"], $data['page']);

            // $data['pks'] = $this->Pks_model->getAll();

            $data['pagination'] = $this->pagination->create_links();
        }


        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('pks/index', $data);
        $this->load->view('templates/footer.php');
    }

    public function create()
    {
        $title['title'] = 'Create PKS';
        $dataa['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        if ($dataa['user']['ROLE'] == 'IT FINANCE') {
            $dataa['no_rbb'] = $this->RBB_model->getKode();
            $dataa['vendor'] = $this->Vendor_model->getAll();
            $dataa['jenis'] = $this->JProject_model->getAll();

            $this->form_validation->set_rules('no_pks', 'No. PKS', 'required|trim|is_unique[pks.no_pks]');
            $this->form_validation->set_rules('kode_rbb', 'Kode RBB', 'required|trim');
            $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
            $this->form_validation->set_rules('kode_project', 'Kode Project', 'required|trim');
            $this->form_validation->set_rules('nama_project', 'Nama Project', 'required|trim');
            $this->form_validation->set_rules('tgl_pks', 'Tgl. PKS', 'required|trim');
            $this->form_validation->set_rules('nominal_pks', 'Nominal PKS', 'required|trim');
            $this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $dataa);
                $this->load->view('pks/create', $dataa);
                $this->load->view('templates/footer.php');
            } else {
                $rbb = $this->RBB_model;
                $data_rbb = $rbb->getById($this->input->post('kode_rbb'));

                $total = $data_rbb->SISA_ANGGARAN - $this->input->post('nominal_pks');

                if ($total >= 0) {
                    $data = [
                        'no_pks' => $this->input->post('no_pks'),
                        'kode_rbb' => $this->input->post('kode_rbb'),
                        'jenis' => $this->input->post('jenis'),
                        'kode_project' => $this->input->post('kode_project'),
                        'nama_project' => $this->input->post('nama_project'),
                        'tgl_pks' => $this->input->post('tgl_pks'),
                        'nominal_pks' => $this->input->post('nominal_pks'),
                        'nama_vendor' => $this->input->post('nama_vendor'),
                        'sisa_anggaran' => $this->input->post('nominal_pks'),
                        'input_user' => $this->input->post('nama_vendor'),
                        'input_date' => date("Y-m-d h:i:s")
                    ];

                    // ADD LOG
                    $log = $this->Log_model;
                    $data_log['USER'] = $dataa['user']['NAMA'];
                    $data_log['TABLE_NAME'] = 'pks';
                    $data_log['KODE_DATA'] = $this->input->post('no_pks');
                    $data_log['ACTIVITY'] = 'add';
                    $log->save($data_log);

                    $this->db->insert('pks', $data);
                    $this->load->model("Vendor_model");
                    $this->load->model("JProject_model");
                    // $v_pks = $this->Pks_model->getVendor($this->input->post('no_pks'));
                    // $jp_pks = $this->Pks_model->getJP($this->input->post('no_pks'));

                    $this->Vendor_model->updateStatusAdd();
                    $this->JProject_model->updateStatusAdd();

                    // MENGURANGI SISA ANGGARAN RBB
                    $rbb = $this->RBB_model;
                    $data_rbb = $rbb->getById($this->input->post('kode_rbb'));
                    $sisa = $data_rbb->SISA_ANGGARAN - $this->input->post('nominal_pks');

                    $this->db->set('SISA_ANGGARAN', $sisa);
                    $this->db->where('KODE_RBB', $this->input->post('kode_rbb'));
                    $this->db->update('rbb');
                    // END

                    // ADD MUTASI
                    $data_mutasi['KODE_RBB'] = $this->input->post('kode_rbb');
                    $data_mutasi['NOMINAL'] = $this->input->post('nominal_pks');
                    $data_mutasi['NO_PKS'] = $this->input->post('no_pks');
                    $mutasi = $this->MutasiRBB_model;
                    $mutasi->save_pks($data_mutasi);
                    // END

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> PKS baru berhasil dibuat.</div>');
                    // if (empty($n_termin)) { //termin lebih dari satu, diarahkan ke halaman termin
                    //     redirect('pks/index');
                    // } else {
                    //     $i=1;
                    //     $a = str_replace('/', '_', $this->input->post('no_pks'));
                    redirect('pks');
                    // }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Nominal PKS melebihi sisa anggaran RBB (' . $total . ')</div>');
                    redirect('pks');
                }
            }
        } else {
            redirect('pks');
        }
    }


    public function edit($no_pks)
    {
        $title['title'] = 'Edit PKS';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $termin = $this->Termin_model;
            $data_termin = $termin->getRow($no_pks);
            if ($data_termin) {
                if ($data_termin['STATUS'] == 'PAID') {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> PKS tidak dapat diedit karena terdapat invoice yang telah dibayar.</div>');
                    redirect('pks');
                }
            }
            $no_pks = str_replace('_', '/', $no_pks);
            $data['pks'] = $this->Pks_model->getById($no_pks);
            // $data['no_rbb'] = $this->RBB_model->getKode();
            $data['vendor'] = $this->Vendor_model->getAll();
            $data['jenis'] = $this->JProject_model->getAll();

            $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
            $this->form_validation->set_rules('kode_project', 'Kode_project', 'required|trim');
            $this->form_validation->set_rules('nama_project', 'Nama_project', 'required|trim');
            $this->form_validation->set_rules('tgl_pks', 'Tgl_pks', 'required|trim');
            $this->form_validation->set_rules('nama_vendor', 'Nama_vendor', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header.php', $title);
                $this->load->view('templates/navbar.php', $data);
                $this->load->view('pks/edit', $data);
                $this->load->view('templates/footer.php');
            } else {

                $jenis = $this->input->post('jenis');
                $kode_project = $this->input->post('kode_project');
                $nama_project = $this->input->post('nama_project');
                $tgl_pks = $this->input->post('tgl_pks');
                $nama_vendor = $this->input->post('nama_vendor');

                $prevdata = $this->Pks_model->getById($no_pks);
                // var_dump($prevdata["NAMA_VENDOR"]);
                // var_dump($nama_vendor);
                // die;
                if ($prevdata["NAMA_VENDOR"] != $nama_vendor) {
                    $this->Vendor_model->updateStatusAdd();
                    $this->Vendor_model->updateStatusDelEd($prevdata['NAMA_VENDOR']);
                }

                if ($prevdata["JENIS"] != $jenis) {
                    $this->JProject_model->updateStatusAdd();
                    $this->JProject_model->updateStatusDelEd($prevdata['JENIS']);
                }

                $this->db->set('jenis', $jenis);
                $this->db->set('kode_project', $kode_project);
                $this->db->set('nama_project', $nama_project);
                $this->db->set('tgl_pks', $tgl_pks);
                $this->db->set('nama_vendor', $nama_vendor);
                $this->db->where('no_pks', $no_pks);
                $this->db->update('pks');


                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $data['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'pks';
                $data_log['KODE_DATA'] = $no_pks;
                $data_log['ACTIVITY'] = 'edit';
                $log->save($data_log);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
                redirect('pks/index');
            }
        } else {
            redirect('pks');
        }
    }

    public function delete($no_pks)
    {
        // $data['pks'] = $this->Pks_model->deleteData($no_pks);
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'IT FINANCE') {
            $termin = $this->Termin_model;
            $no_pks = str_replace('_', '/', $no_pks);
            $data_termin = $termin->getRow($no_pks);


            if ($data_termin) {
                if ($data_termin['STATUS'] == 'UNPAID') {
                    // HAPUS TERMIN
                    $hapus_termin = $termin->getAll($no_pks);
                    foreach ($hapus_termin as $row) {
                        $termin->delete($row->KODE_TERMIN);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> PKS tidak dapat dihapus karena terdapat invoice yang telah dibayar.</div>');
                    redirect('pks');
                }
            }
            $pks = $this->Pks_model;

            // TAMBAH ANGGARAN RBB
            $data_pks = $pks->getById($no_pks);
            $rbb = $this->RBB_model;
            $data_rbb = $rbb->getById($data_pks['KODE_RBB']);
            $total = $data_rbb->SISA_ANGGARAN + $data_pks['NOMINAL_PKS'];
            $this->db->set('SISA_ANGGARAN', $total);
            $this->db->where('KODE_RBB', $data_pks['KODE_RBB']);
            $this->db->update('rbb');

            // TAMBAH MUTASI RBB
            $data_mutasi['KODE_RBB'] = $data_pks['KODE_RBB'];
            $data_mutasi['NOMINAL'] = $data_pks['NOMINAL_PKS'];
            $data_mutasi['NO_PKS'] = $no_pks;
            $mutasi = $this->MutasiRBB_model;
            $mutasi->save_pks($data_mutasi);

            // ADD LOG
            $log = $this->Log_model;
            $data_log['USER'] = $data['user']['NAMA'];
            $data_log['TABLE_NAME'] = 'pks';
            $data_log['KODE_DATA'] = $no_pks;
            $data_log['ACTIVITY'] = 'delete';
            $log->save($data_log);

            // HAPUS PKS
            $prevdata = $this->Pks_model->getById($no_pks);

            $this->Vendor_model->updateStatusDel($prevdata["NAMA_VENDOR"]);
            $this->JProject_model->updateStatusDel($prevdata["JENIS"]);

            $pks->deleteData($no_pks);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus.</div>');
            redirect('pks');
        } else {
            redirect('pks');
        }
    }

    public function search()
    { //Auto complete search
        if (isset($_GET['term'])) {
            $res = $this->Pks_model->seeThisPKS($_GET['term']);
            if (count($res) > 0) {
                foreach ($res as $reskey)
                    $varch[] = $reskey->NO_PKS;
                echo json_encode($varch);
            }
        }
    }

}
