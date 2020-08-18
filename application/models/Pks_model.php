<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pks_model extends CI_Model
{

    public function getAll($that = null)
    {
        $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->join('vendor', 'vendor.KODE_VENDOR = pks.nama_vendor');
            $this->db->join('j_project', 'j_project.KODE_JENISPROJECT = pks.jenis');
            $this->db->where("NO_PKS", $that);
            return $this->db->get('pks')->result();
        }
        // Select record
        $this->db->select('*');
        $this->db->join('vendor', 'vendor.KODE_VENDOR = pks.nama_vendor');
        $this->db->join('j_project', 'j_project.KODE_JENISPROJECT = pks.jenis');
        $q = $this->db->get('pks');

        $response = $q->result();
        return $response;
    }

    public function getPagination($limit, $start)
    {
        $response = array();

        $this->db->select('*');
        $this->db->join('vendor', 'vendor.KODE_VENDOR = pks.nama_vendor');
        $this->db->join('j_project', 'j_project.KODE_JENISPROJECT = pks.jenis');
        $q = $this->db->get('pks', $limit, $start);

        $response = $q->result();
        return $response;
    }

    public function showData()
    {
        $this->db->select('*');
        $this->db->join('vendor', 'vendor.KODE_VENDOR = pks.nama_vendor');
        $this->db->join('j_project', 'j_project.KODE_JENISPROJECT = pks.jenis');

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
    }

    public function getVendor($nopks)
    {
        $this->db->select('VENDOR');
        $this->db->where("NO_PKS", $nopks);
        return $this->db->get()->result();
    }

    public function getJP($nopks)
    {
        $this->db->select('JENIS_PROJECT');
        $this->db->where("NO_PKS", $nopks);
        return $this->db->get()->result();
    }

    // public function countPKSthi
}
