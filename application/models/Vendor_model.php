<?php defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
    private $_table = "vendor";

    public $KODE_VENDOR;
    public $nama_vendor;

    public function rules()
    {
        return [
            [
                'field' => 'nama_vendor',
                'label' => 'Nama Vendor',
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
        $this->KODE_VENDOR = $post["KODE_VENDOR"];
        $this->nama_vendor = $post["nama_vendor"];
        $this->db->set("nama_vendor", $post["nama_vendor"]);
        $this->db->where("KODE_VENDOR", $post["KODE_VENDOR"]);
        $this->db->update('vendor');
        return $this->KODE_VENDOR;
    }


    public function save()
    {
        $post = $this->input->post();
        $this->KODE_VENDOR = uniqid();
        $this->nama_vendor = $post["nama_vendor"];
        $this->db->insert($this->_table, $this);
        return $this->KODE_VENDOR;
    }

    public function getById($kodev)
    {
        return $this->db->get_where($this->_table, ["KODE_VENDOR" => $kodev])->row();
    }

    public function delete($kodev)
    {
        return $this->db->delete($this->_table, array("KODE_VENDOR" => $kodev));
    }

    public function updateStatusDel($vendor)
    {
        $this->db->select('STATUS');
        $r = $this->db->get_where('vendor', ['KODE_VENDOR' => $vendor])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN - 1;
        $this->db->set('STATUS', $RN);
        $this->db->where("KODE_VENDOR",  $vendor);
        return $this->db->update('vendor');
    }

    public function updateStatusAdd()
    {
        $post = $this->input->post();
        $this->db->select('STATUS');
        $r = $this->db->get_where('vendor', ['KODE_VENDOR' => $post["nama_vendor"]])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN + 1;
        $this->db->set('STATUS', $RN);
        $this->db->where("KODE_VENDOR",  $post["nama_vendor"]);
        return $this->db->update('vendor');
    }
    public function updateStatusDelEd($prevId)
    {
        $this->db->select('STATUS');
        $r = $this->db->get_where('vendor', ['KODE_VENDOR' => $prevId])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN - 1;
        $this->db->set('STATUS', $RN);
        $this->db->where("KODE_VENDOR", $prevId);
        return $this->db->update('vendor');
    }
}
