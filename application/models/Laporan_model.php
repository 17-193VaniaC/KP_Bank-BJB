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
        $res= $this->db->get('rbb')->result_array();
        foreach ($res as $a=>$val):
            // $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
            // $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
            $r = $this->db->get_where('pks', 'pks.KODE_RBB', $val['KODE_RBB'])->result_array();
            var_dump($r);
            
            die;
            $res[$a]['pks']= $r;
            foreach ($r as $b=>$val) :
                $this->db->join('termin', 'termin.KODE_TERMIN', 'pembayaran.KODE_TERMIN');
                $this->db->where('termin.NO_PKS', $val["NO_PKS"]);
                $s = $this->db->get('pembayaran')->result_array();
                $res[$a][$b]['invs'] = $s;
            endforeach;
        endforeach;
        return $res;
    }

}




