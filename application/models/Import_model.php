<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Import_model extends CI_Model
{
    private $_batchImport;

    public function setBatchImport($batchImport)
    {
        echo 'megalosaurus';
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData()
    {
        echo 'nodosaurus';
        $data = $this->_batchImport;
        $this->db->insert_batch('rbb', $data);
    }
    // get employee list
    public function employeeList()
    {
        $this->db->select(array('e.id', 'e.first_name', 'e.last_name', 'e.email', 'e.dob', 'e.contact_no'));
        $this->db->from('rbb as e');
        $query = $this->db->get();
        return $query->result_array();
    }
}
