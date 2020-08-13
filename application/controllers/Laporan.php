<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model("RBB_model");
        $this->load->model("PKS_model");
        $this->load->model("Invoice_model");
        $this->load->library('form_validation');
    }


   public function index(){
       $title['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $res= $this->db->get('rbb')->result();
        foreach ($data['rbb'] as $a):
            $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
            $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
            $r = $this->db->get_where('pks', 'pks.KODE_RBB', $a->KODE_RBB)->result();
            $res[$a]= $r;
            foreach ($r as $b) :
                $this->db->join('termin', 'termin.KODE_TERMIN', 'pembayaran.KODE_TERMIN');
                $this->db->where('termin.NO_PKS', $b->NO_PKS);
                $s = $this->db->get('pembayaran')->result();
                $res[$a][$b] = $s;
    endforeach;
endforeach;
        $data['table'] = $res;
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('Laporan/laporan', $data);
        $this->load->view('templates/footer.php');
   }
 }