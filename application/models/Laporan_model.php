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
    public function getData($that = null)
    {      
        if (!empty($that) || $that=='0') {
            //Dapat semua kode rbb
            // $database = mysqli_connect('localhost', 'root', '', 'bankbjb');
            $query = $this->db->query("
                SELECT * from rbb a 
                INNER JOIN
                pks b on a.KODE_RBB = b.KODE_RBB
                INNER JOIN
                vendor v on v.KODE_VENDOR = b.NAMA_VENDOR
                INNER JOIN
                j_project j on j.KODE_JENISPROJECT = b.JENIS
                INNER JOIN
                termin_pks t on t.NO_PKS = b.NO_PKS
                INNER JOIN 
                pembayaran p on p.KODE_TERMIN = t.KODE_TERMIN
                WHERE
                a.KODE_RBB LIKE '%$that%' OR
                a.NAMA_REK LIKE '%$that%' OR
                a.PROGRAM_KERJA LIKE '%$that%' OR
                a.GL LIKE '%$that%' OR
                b.NAMA_PROJECT LIKE '%$that%' OR
                v.nama_vendor LIKE '%$that%' OR
                j.jenis LIKE '%$that%'
                ORDER by p.TGL_INVOICE

                ");
            $sql = $query->result_array();
            return $sql;

        }

        else{
            // $database = mysqli_connect('localhost', 'root', '', 'bankbjb');
            $query = $this->db->query("
                SELECT * from rbb, pks, termin_pks, pembayaran, vendor, j_project
                WHERE
                rbb.KODE_RBB = pks.KODE_RBB AND
                pks.NO_PKS = termin_pks.NO_PKS AND
                termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN AND
                vendor.KODE_VENDOR = pks.NAMA_VENDOR AND
                j_project.KODE_JENISPROJECT = pks.JENIS
                GROUP BY rbb.KODE_RBB, pks.NO_PKS
                ORDER BY pembayaran.TGL_INVOICE
                limit 15
                ");
            $sql = $query->result_array();
            // var_dump($sql);
            // die;
            return $sql;
        // $this->db->select("KODE_RBB, PROGRAM_KERJA, ANGGARAN, GL, NAMA_REK, (ANGGARAN-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN");
        // $res = $this->db->get('rbb', 1)->result_array();
        // foreach ($res as $a => $val) :
        //     $this->db->select("j_project.jenis, KODE_PROJECT, NAMA_PROJECT, TGL_PKS, NO_PKS, NOMINAL_PKS, (NOMINAL_PKS-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN, vendor.nama_vendor");
        //     $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
        //     $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
        //     $r = $this->db->get_where('pks', array('pks.KODE_RBB' => $val["KODE_RBB"]))->result_array();
        //     foreach ($r as $b => $val) :
        //         $this->db->join('pembayaran', 'termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN', 'inner');
        //         $s = $this->db->get_where('termin_pks', array('termin_pks.NO_PKS' => $val["NO_PKS"]))->result_array();
        //         $r[$b]['invs'] = $s;
        //     endforeach;
        //     $res[$a]['pks'] = $r;
        // endforeach;
        // return $res;
        }


    }
            // foreach ($res as $a => $val) :
            //     $this->db->select("j_project.jenis, KODE_PROJECT, NAMA_PROJECT, TGL_PKS, NO_PKS, NOMINAL_PKS, (NOMINAL_PKS-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN, vendor.nama_vendor");
            //     $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
            //     $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
            //     $r = $this->db->get_where('pks', array('pks.KODE_RBB' => $val["KODE_RBB"]))->result_array();
            //     foreach ($r as $b => $val) :
            //         $this->db->join('pembayaran', 'termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN', 'inner');
            //         $s = $this->db->get_where('termin_pks', array('termin_pks.NO_PKS' => $val["NO_PKS"]))->result_array();
            //         $r[$b]['invs'] = $s;
            //     endforeach;
            //     $res[$a]['pks'] = $r;
            // endforeach;
            
            //kalau ada di pks
            //kalau ada di termin
            


        /////YANG LAMA
        // Select record
    //     $this->db->select("KODE_RBB, PROGRAM_KERJA, ANGGARAN, GL, NAMA_REK, (ANGGARAN-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN");
    //     $res = $this->db->get('rbb', 1)->result_array();
    //     foreach ($res as $a => $val) :
    //         $this->db->select("j_project.jenis, KODE_PROJECT, NAMA_PROJECT, TGL_PKS, NO_PKS, NOMINAL_PKS, (NOMINAL_PKS-SISA_ANGGARAN) as Mutasi, SISA_ANGGARAN, vendor.nama_vendor");
    //         $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
    //         $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
    //         $r = $this->db->get_where('pks', array('pks.KODE_RBB' => $val["KODE_RBB"]))->result_array();
    //         foreach ($r as $b => $val) :
    //             $this->db->join('pembayaran', 'termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN', 'inner');
    //             $s = $this->db->get_where('termin_pks', array('termin_pks.NO_PKS' => $val["NO_PKS"]))->result_array();
    //             $r[$b]['invs'] = $s;
    //         endforeach;
    //         $res[$a]['pks'] = $r;
    //     endforeach;
    //     return $res;
    // }
    public function getData2()
    {
        $res = $this->db->get('rbb')->result_array();
        foreach ($res as $a => $val) :
            $this->db->join('vendor', "vendor.KODE_VENDOR = pks.NAMA_VENDOR");
            $this->db->join('j_project', "j_project.KODE_JENISPROJECT = pks.JENIS");
            $r = $this->db->get_where('pks', array('pks.KODE_RBB' => $val["KODE_RBB"]))->result_array();
            foreach ($r as $b => $val) :
                $this->db->join('pembayaran', 'termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN', 'inner');
                $s = $this->db->get_where('termin_pks', array('termin_pks.NO_PKS' => $val["NO_PKS"]))->result_array();
                $r[$b]['invs'] = $s;
            endforeach;
            $res[$a]['pks'] = $r;
        endforeach;
        // var_dump($res);

        // $res = $this->db->get_where('pks', 'pks.KODE_RBB = 12")->result_array();
        // var_dump($res);

        // die;
        return $res;
    }

    public function getByDate($tgl_awal, $tgl_akhir)
    {
    }
}
