<?php defined('BASEPATH') or exit('No direct script access allowed');

class Termin_model extends CI_Model
{
    private $_table = "termin_pks";

    public $NO_PKS;
    public $KODE_TERMIN;
    public $TERMIN;
    public $BULAN;
    public $NOMINAL;
    public $STATUS;

    public function rules()//for adding new termin
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



    public function getAll($nopks)
    {   
        $response = array();
        if(!empty($nopks)){
        $this->db->select('*');
        $this->db->where('NO_PKS', $nopks);
        $this->db->order_by('NO_PKS, TERMIN','asc');
        $q = $this->db->get('termin_pks');
        $response = $q->result();
        return $response;
        }
        $this->db->select('*');
        $this->db->from('termin_pks');
        $this->db->order_by('NO_PKS, TERMIN','asc');
        $termin =$this->db->get()->result();
        return $termin;
    }

    public function save($nopks)
    {
        $post = $this->input->post();
        $this->NO_PKS = $nopks;
        $this->KODE_TERMIN = uniqid();
        $this->NOMINAL = $post["NOMINAL"];
        $this->TERMIN = $post["TERMIN"];
        $this->BULAN = $post["BULAN"];
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
        $this->BULAN = $post["BULAN"];
        $this->STATUS = $post["STATUS"];
        return $this->db->update($this->_table, $this, array('KODE_TERMIN' => $post['KODE_TERMIN']));
    }

    public function delete($KODETERMIN)
    {
        return $this->db->delete($this->_table, array("KODE_TERMIN" => $KODETERMIN));
    }
    public function StatPaid($KODETERMIN){
        $this->db->set('STATUS');
        $this->db->where('KODETERMIN', $KODETERMIN);
        $this->db->update('termin_pks');
    }

}
