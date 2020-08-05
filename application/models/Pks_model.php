<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pks_model extends CI_Model
{

    public function getAll()
    {
        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get('pks');
        $response = $q->result();

        return $response;
    }

    public function getById($no_pks)
    {
        $this->db->select('*');
        $q = $this->db->get_where('pks', ['NO_PKS' => $no_pks]);
        $response = $q->row_array();

        return $response;
    }

    function deleteData($no_pks)
    {
        $this->db->delete('pks', array('No_PKS' => $no_pks));
    }

    public function seeThisPKS($nopks){
        $this->db->select('*');
        $this->db->from('pks');
        if(!empty($no_pks)){
            $this->db->like('NO_PKS',$nopks);
        }
        $this->db->order_by('INPUT_DATE');
        return $this->db->get();

    }
}
