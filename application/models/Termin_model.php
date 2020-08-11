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

    public function rules() //for adding new termin
    {
        return [

            [
                'field' => 'TERMIN',
                'label' => 'TERMIN',
                'rules' => 'required'
            ],
            [
                'field' => 'BULAN',
                'label' => 'BULAN',
                'rules' => 'required'
            ],
            [
                'field' => 'NOMINAL',
                'label' => 'NOMINAL',
                'rules' => 'required'
            ]
        ];
    }



    public function getAll($termin)
    {
        $response = array();
        if (!empty($termin)) {
            $this->db->select('*');
            $this->db->where('NO_PKS', $termin);
            $this->db->order_by('TERMIN', 'asc');
            $q = $this->db->get('termin_pks');
            $response = $q->result();
            return $response;
        }
        $this->db->select('*');
        $this->db->from('termin_pks');
        $this->db->order_by('NO_PKS, TERMIN', 'asc');
        $termin = $this->db->get()->result();
        return $termin;
    }

    public function save($nopks)
    {
        $post = $this->input->post();
        $this->NO_PKS = $nopks;
        $this->KODE_TERMIN = uniqid();
        $this->NOMINAL = $post["NOMINAL"];
        $this->TERMIN = $post["TERMIN"];
        $this->TGL_TERMIN = $post["BULAN"];
        $this->STATUS = "UNPAID";
        return $this->db->insert($this->_table, $this);
    }

    public function getById($KODETERMIN)
    {
        return $this->db->get_where($this->_table, ["KODE_TERMIN" => $KODETERMIN])->row();
    }
    public function getByIdPKS($NOPKS)
    {
        return $this->db->get_where($this->_table, ["NO_PKS" => $NOPKS])->row();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->KODE_TERMIN = $post["KODE_TERMIN"];
        $this->NOMINAL = $post["NOMINAL"];
        $this->TERMIN = $post["TERMIN"];
        $this->TGL_TERMIN = $post["BULAN"];
        $this->STATUS = $post["STATUS"];
        return $this->db->update($this->_table, $this, array('KODE_TERMIN' => $post['KODE_TERMIN']));
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

        // $this->db->select('NO_PKS');
        // $this->db->from('termin_pks');
        // $this->db->where('KODE_TERMIN', $kodetermin);

        // return $this->db->get()->result();
    }


    public function sisaAnggaran($kodetermin)
    {
        return $this->db->get_where('termin_pks', ['KODE_TERMIN' => $kodetermin])->row_array();


        // $this->db->select('NO_PKS');
        // $this->db->where('KODE_TERMIN', $kodetermin);
        // return $this->db->get('termin_pks')->row();
    }

    public function hasBeenPaid($nopks)
    {
        $this->db->where('NO_PKS', $nopks);
        return $this->db->get('termin_pks')->result();
    }

    public function seeThisTermin2($nopks)
    {
        $database = mysqli_connect('localhost', 'root', '', 'bankbjb');
        $query = mysqli_query($database, "select * from termin_pks where NO_PKS='$nopks' AND STATUS='UNPAID' order by TERMIN limit 1");
        $sql = mysqli_fetch_array($query);
        return $sql;
    }
}
