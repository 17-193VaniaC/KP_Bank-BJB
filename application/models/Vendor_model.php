<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
    private $_table = "vendor";

    public $VENDOR;

    public function rules()
    {
        return[
            ['field' => 'VENDOR', 
            'label' => 'VENDOR', 
            'rules' => 'required|is_unique[vendor.VENDOR]']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->VENDOR = $post["VENDOR"];
        return $this->db->insert($this->_table, $this);
    
    }
    
    public function getById($nama_v)
    {
        return $this->db->get_where($this->_table, ["VENDOR" => $nama_v])->row();
    }

    public function delete($nama_v)
    {  
        return $this->db->delete($this->_table, array("VENDOR" =>$nama_v));
    }

}

?>