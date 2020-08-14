<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    // public function getAll($termin)
    // {   
    //     $response = array();
    //     if(!empty($termin)){
    //     $this->db->select('*');
    //     $this->db->where('NO_PKS', $termin);
    //     $this->db->order_by('TERMIN','asc');
    //     $q = $this->db->get('termin');
    //     $response = $q->result();
    //     return $response;
    //     }
    //     $this->db->select('*');
    //     $this->db->from('termin_pks');
    //     $this->db->order_by('NO_PKS, TERMIN','asc');
    //     $termin =$this->db->get()->result();
    //     return $termin;
    // }    
   
    // public function seeThisTermin($nopks){
    //    // $this->db->from('termin_pks');
    //     $this->db->where('STATUS', "UNPAID");
    //     $this->db->like('NO_PKS', $nopks, 'both');
    //     $this->db->order_by('NO_PKS', 'asc');
    //     $this->db->group_by('NO_PKS');
    //     $this->db->limit(5);
    //     $hupla= $this->db->get('termin_pks')->result();
    //     return $hupla;

    // public function hasBeenPaid($nopks){
    //     $this->db->where('NO_PKS', $nopks);
    //     return $this->db->get('termin_pks')->result();
    // }

    // public function seeThisTermin2($nopks){
    //     $database = mysqli_connect('localhost', 'root', '', 'bankbjb');
    //     $query = mysqli_query($database, "select * from termin_pks where NO_PKS='$nopks' AND STATUS='UNPAID' order by TERMIN limit 1");
    //     $sql = mysqli_fetch_array($query);
    //     return $sql;
    // }
    public function getData(){
        $this->db->select("KODE_RBB, PROGRAM_KERJA, ANGGARAN, GL, NAMA_REK, (ANGGARAN-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN");
        $res= $this->db->get('rbb')->result_array();
        foreach ($res as $a=>$val):
            $this->db->select("j_project.jenis, KODE_PROJECT, NAMA_PROJECT, TGL_PKS, NO_PKS, NOMINAL_PKS, (NOMINAL_PKS-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN, vendor.nama_vendor");
            $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
            $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
            $r = $this->db->get_where('pks', array('pks.KODE_RBB'=>$val["KODE_RBB"]))->result_array();
            foreach ($r as $b=>$val) :
                $this->db->join('pembayaran', 'termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN', 'inner');
                $s = $this->db->get_where('termin_pks', array('termin_pks.NO_PKS'=>$val["NO_PKS"]))->result_array();
                $r[$b]['invs'] = $s;
            endforeach;
            $res[$a]['pks']= $r;
        endforeach;
        // var_dump($res);

        // $res = $this->db->get_where('pks', 'pks.KODE_RBB = 12")->result_array();
        // var_dump($res);

        // die;
        return $res;


    }
    public function getData2(){        
        $res= $this->db->get('rbb')->result_array();
        foreach ($res as $a=>$val):
            $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
            $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
            $r = $this->db->get_where('pks', array('pks.KODE_RBB'=>$val["KODE_RBB"]))->result_array();
            foreach ($r as $b=>$val) :
                $this->db->join('pembayaran', 'termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN', 'inner');
                $s = $this->db->get_where('termin_pks', array('termin_pks.NO_PKS'=>$val["NO_PKS"]))->result_array();
                $r[$b]['invs'] = $s;
            endforeach;
            $res[$a]['pks']= $r;
        endforeach;
        // var_dump($res);

        // $res = $this->db->get_where('pks', 'pks.KODE_RBB = 12")->result_array();
        // var_dump($res);

        // die;
        return $res;


    }

}




