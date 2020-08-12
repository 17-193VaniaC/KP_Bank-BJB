<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pks_model extends CI_Model
{

    public function getAll($that = null)
    {
        $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->where('NO_PKS', $that);
            $q = $this->db->get('pks');
            $response = $q->result();
            return $response;
        }
        // Select record
        $this->db->select('*');
        $q = $this->db->get('pks');
        $response = $q->result();
        return $response;
    }

    public function getByRBB($kode_rbb)
    {
        $this->db->select('*');
        $q = $this->db->get_where('pks', ['KODE_RBB' => $kode_rbb]);
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

    public function seeThisPKS($nopks)
    {
        $this->db->like('NO_PKS', $nopks, 'after');
        $this->db->order_by('INPUT_DATE');
        $this->db->limit(4);
        return $this->db->get('pks')->result();
        // $temp = $this->db->get('pks')->result();
        // var_dump($temp);
        // die;
    }
}
