<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_model extends CI_Model
{

    function getData()
    {
        $response = array();

        // Select record
        $this->db->select('nama_vendor');
        $q = $this->db->get('vendor');
        $response = $q->result();

        return $response;
    }
}
