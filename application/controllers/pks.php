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
        $this->load->model('MutasiRBB_model');
        $this->load->model('Pks_model');
        $this->load->model('Vendor_model');
        $this->load->model('JProject_model');
        $this->load->model('Termin_model');
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
        $dataa['jenis'] = $this->JProject_model->getAll();

        $this->form_validation->set_rules('no_pks', 'No_pks', 'required|trim|is_unique[pks.no_pks]');
        $this->form_validation->set_rules('kode_rbb', 'Kode_rbb', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|trim');
        $this->form_validation->set_rules('kode_project', 'Kode_project', 'required|trim');
        $this->form_validation->set_rules('nama_project', 'Nama_project', 'required|trim');
        $this->form_validation->set_rules('tgl_pks', 'Tgl_pks', 'required|trim');
        $this->form_validation->set_rules('nominal_pks', 'Nominal_pks', 'required|trim');
        $this->form_validation->set_rules('nama_vendor', 'Nama_vendor', 'required|trim');
        $this->form_validation->set_rules('termin', 'Termin', 'trim|less_than_equal_to[12]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $dataa);
            $this->load->view('pks/create', $dataa);
            $this->load->view('templates/footer.php');
        } else {
            $rbb = $this->RBB_model;
            $data_rbb = $rbb->getById($this->input->post('kode_rbb'));

            $total = $data_rbb->SISA_ANGGARAN - $this->input->post('nominal_pks');

            if ($total > 0) {
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
                //OLAH DATA
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

                $n_termin = $this->input->post('termin');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your program has been created.</div>');
                if (empty($n_termin)) { //termin lebih dari satu, diarahkan ke halaman termin
                    redirect('pks/index');
                } else {
                    redirect('Termin/add/' . $data['no_pks'] . "/" . $n_termin . "/1");
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Nominal PKS melebihi sisa anggaran RBB (' . $total . ')</div>');
                redirect('pks');
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
            $this->load->view('templates/header.php', $title);
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
            $this->db->set('sisa_anggaran', $nominal_pks);
            $this->db->set('nama_vendor', $nama_vendor);
            $this->db->where('no_pks', $no_pks);
            $this->db->update('pks');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your program has been edited.</div>');
            redirect('pks/index');
        }
    }

    public function delete($no_pks)
    {
        // $data['pks'] = $this->Pks_model->deleteData($no_pks);
        $termin = $this->Termin_model;
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
        //TAMBAH N PENGGUNA VENDOR DAN JENIS PROJECT
        //DAPAT kode vendornya dan kode jenisnya]
        //load model
        $this->load->model("Vendor_model");
        $this->load->model("JProject_model");
        //ubah status
        $this->Vendor_model->updateStatusDel();
        $this->JProject_model->updateStatusDel();
        
        // HAPUS PKS
        $pks->deleteData($no_pks);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your data has been deleted.</div>');
        redirect('pks');
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
