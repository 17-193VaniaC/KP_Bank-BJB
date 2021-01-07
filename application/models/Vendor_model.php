<?php defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends CI_Model
{
    private $_table = "vendor";

    private $KODE_VENDOR;
    private $nama_vendor;

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

    public function getPagination($that = null, $limit, $start)
    {
        $response = array();
        if (!empty($that) || $that == '0') {
            $this->db->select('*');
            $this->db->like('nama_vendor', $that, 'both');
            $this->db->order_by('nama_vendor', 'asc');
            return $this->db->get('vendor', $limit, $start)->result();
        }
        // Select record
        $this->db->select('*');
        $this->db->order_by('nama_vendor', 'asc');
        return $this->db->get('vendor', $limit, $start)->result();
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

    public function getByNama($kodev)
    {
        $hasil = $this->db->get_where($this->_table, ["NAMA_VENDOR" => $kodev])->row();
        return $hasil->KODE_VENDOR;
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

    public function countquery($name = null)
    {
        if (!empty($name) || $name == '0') {
            $this->db->select('count(vendor.KODE_VENDOR) as n_row');
            $this->db->like('vendor.nama_vendor', $name, 'both');
            return $this->db->get('vendor')->result();
        }
        $this->db->select('count(vendor.KODE_VENDOR) as n_row');
        return $this->db->get('vendor')->result();
    }
}
