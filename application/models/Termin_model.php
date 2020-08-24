<?php defined('BASEPATH') or exit('No direct script access allowed');

class Termin_model extends CI_Model
{
    private $_table = "termin_pks";

    public $NO_PKS;
    public $KODE_TERMIN;
    public $TERMIN;
    public $TGL_TERMIN;
    public $NOMINAL;
    public $STATUS;
    public $KATEGORI;
    public $GL;

    public function rules() //for adding new termin
    {
        return [
            [
                'field' => 'GL',
                'label' => 'GL',
                'rules' => 'required'
            ],
            [
                'field' => 'KATEGORI',
                'label' => 'Kategori',
                'rules' => 'required'
            ],
            [
                'field' => 'TGL_TERMIN',
                'label' => 'Tanggal Termin',
                'rules' => 'required'
            ],
            [
                'field' => 'NOMINAL',
                'label' => 'Nominal',
                'rules' => 'required'
            ]
        ];
    }



    public function getAll($termin)
    {
        $response = array();
        if (!empty($id)) {
            $this->db->select('*');
            $this->db->where('NO_PKS', $id);
            $this->db->order_by('INPUT_DATE', 'desc');
            $q = $this->db->get('termin_pks');
            $response = $q->result();
            return $response;
        }
        $this->db->select('*');
        $this->db->from('termin_pks');
        $this->db->order_by('NO_PKS, TERMIN', 'desc');
        $termin = $this->db->get()->result();
        return $termin;
    }

    public function getPagination($that = null, $limit, $start)
    {
     $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->like('NO_PKS', $that, 'both');
            $this->db->order_by('INPUT_DATE', 'desc');
            return $this->db->get('termin_pks', $limit, $start)->result();

        }
        $this->db->order_by('INPUT_DATE', 'desc');
        $response = $this->db->get('termin_pks', $limit, $start)->result();
        return $response;
    }
    public function getRow($no_pks)
    {
        $this->db->select('*');
        $this->db->where('NO_PKS', $no_pks);
        $this->db->order_by('TERMIN', 'asc');
        return $this->db->get('termin_pks')->row_array();
    }

    public function save($nopks)
    {
        $post = $this->input->post();
        $this->NO_PKS = $nopks;
        $this->KODE_TERMIN = uniqid();
        $this->NOMINAL = $post["NOMINAL"];
        $this->TERMIN = $post["TERMIN"];
        $this->TGL_TERMIN = $post["TGL_TERMIN"];
        $this->STATUS = "UNPAID";
        $this->KATEGORI = $post["KATEGORI"];
        $this->GL = $post["GL"];
        $this->db->insert($this->_table, $this);
        return $this->KODE_TERMIN;
    }

    public function getById($KODETERMIN)
    {
        return $this->db->get_where($this->_table, ["KODE_TERMIN" => $KODETERMIN])->row();
    }
    public function getByIdPKS($NOPKS)
    {
        return $this->db->get_where($this->_table, ["NO_PKS" => $NOPKS])->result();
    }

    public function update($kode_termin)
    {
        $post = $this->input->post();


        $this->db->set('NOMINAL', $post["NOMINAL"]);
        $this->db->set('TGL_TERMIN', $post["TGL_TERMIN"]);
        $this->db->set('KATEGORI', $post["KATEGORI"]);
        $this->db->set('GL', $post["GL"]);

        $this->db->where('KODE_TERMIN', $kode_termin);
        $this->db->update($this->_table);



        // $this->NOMINAL = $post["NOMINAL"];
        // $this->TGL_TERMIN = $post["TGL_TERMIN"];
        // return $this->db->update($this->_table, $this, array('KODE_TERMIN' => $kode_termin));
    }

    public function delete($KODETERMIN)
    {
        return $this->db->delete($this->_table, array("KODE_TERMIN" => $KODETERMIN));
    }

    public function seeThisTermin($nopks)
    {
        // $this->db->from('termin_pks');
        $this->db->where('STATUS', "UNPAID");
        $this->db->like('NO_PKS', $nopks, 'both');
        $this->db->order_by('NO_PKS', 'asc');
        $this->db->group_by('NO_PKS');
        $this->db->limit(5);
        $hupla = $this->db->get('termin_pks')->result();
        return $hupla;
    }
    public function paid($kodetermin)
    {
        $this->db->where('KODE_TERMIN', $kodetermin);
        $this->db->update('termin_pks', array('STATUS' => "PAID"));
    }


    public function sisaAnggaran($kodetermin)
    {
        return $this->db->get_where('termin_pks', ['KODE_TERMIN' => $kodetermin])->row_array();

    }

    public function hasntBeenPaid($nopks)
    {   
        $this->db->where('NO_PKS', $nopks);
        $this->db->where('STATUS', 'UNPAID');
        return $this->db->get('termin_pks')->result();
    }

    public function countTermin($nopks)
    {   
        $this->db->where('NO_PKS', $nopks);
        return count($this->db->get('termin_pks')->result());
    }

    public function seeThisTermin2($nopks)
    {
        $database = mysqli_connect('localhost', 'root', '', 'bankbjb');
        $query = mysqli_query($database, "select * from termin_pks where NO_PKS='$nopks' AND STATUS='UNPAID' order by TERMIN limit 1");
        $sql = mysqli_fetch_array($query);
        return $sql;
    }
    public function paidDate($notermin)
    {
        $this->db->from('invoice');
        $this->db->like('NO_PKS', $nopks, 'after');
        $this->db->where('STATUS', "UNPAID");
        $this->db->order_by('NO_PKS');
        $this->db->limit(4);
        return $this->db->get()->result();
    }
    public function getGL($k){
        $this->db->where('KELOMPOK =',$k);
        return $this->db->get('gl')->result();
        // var_dump($this->db->get('gl')->result());
        // die;
    }
    public function getRemainingBudget($pks){
        $this->db->select("sum(termin_pks.NOMINAL) as anggaranpakai");
        $this->db->where('NO_PKS =',$pks);
        return $this->db->get('termin_pks')->result();
    }

    public function getNominal($kodetermin)
    {
        $query = $this->db->query('SELECT termin_pks.NOMINAL FROM termin_pks WHERE termin_pks.KODE_TERMIN ="' . $kodetermin . '"');
        return $query->row();
    }
    public function countquery($name = null){
        if (!empty($name)) {
            $this->db->select('count(termin_pks.NO_PKS) as n_row');
            $this->db->like('termin_pks.NO_PKS', $name, 'both');
            return $this->db->get('termin_pks')->result();
        }
        $this->db->select('count(termin_pks.NO_PKS) as n_row');
        return $this->db->get('termin_pks')->result();
    }
}
