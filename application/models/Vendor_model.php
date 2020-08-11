<?php defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
    private $_table = "vendor";

    public $nama_vendor;

    public function rules()
    {
        return [
            [
                'field' => 'naman vendor',
                'label' => 'nama_vendor',
                'rules' => 'trim|required|is_unique[vendor.nama_vendor]'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    public function update($vendor = null)
    {
        $post = $this->input->post();
        $this->nama_vendor = $post["nama vendor"];
        $this->db-set("nama_vendor", $post["nama_vendor"]);
        $this->db->where("nama_vendor", $post["nama_vendor_1"]);
        return $this->db->update('vendor');
    }


    public function save()
    {
        $post = $this->input->post();
        $this->nama_vendor = $post["nama_vendor"];
        return $this->db->insert($this->_table, $this);
    }

    public function getById($nama_v)
    {
        return $this->db->get_where($this->_table, ["nama_vendor" => $nama_v])->row();
    }

    public function delete($nama_v)
    {   
        return $this->db->delete($this->_table, array("nama_vendor" => $nama_v));
    }
}
