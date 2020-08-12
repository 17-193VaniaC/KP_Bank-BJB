<?php defined('BASEPATH') or exit('No direct script access allowed');

class MutasiRBB_model extends CI_Model
{
    private $_table = "mutasi_rbb";

    public $KODE_MUTASI;
    public $KODE_RBB;
    public $NOMINAL;
    public $KETERANGAN;
    public $TGL_MUTASI;

    public function rules()
    {
        return [
            [
                'field' => 'KODE_RBB',
                'label' => 'KODE_RBB',
                'rules' => 'required'
            ],

            [
                'field' => 'KETERANGAN',
                'label' => 'KETERANGAN',
                'rules' => 'required'
            ],

            [
                'field' => 'NOMINAL',
                'label' => 'NOMINAL',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->KODE_RBB = $post["KODE_RBB"];
        $this->KODE_MUTASI = uniqid();
        $this->NOMINAL = $post["NOMINAL"];
        $this->TGL_MUTASI = date('Y-m-d');
        $this->KETERANGAN = $post["KETERANGAN"];
        return $this->db->insert($this->_table, $this);
    }

    public function save_pks($data)
    {
        $this->KODE_RBB = $data["KODE_RBB"];
        $this->KODE_MUTASI = uniqid();
        $this->NOMINAL = $data["NOMINAL"];
        $this->TGL_MUTASI = date('Y-m-d');
        $this->KETERANGAN = $data["NO_PKS"];
        return $this->db->insert($this->_table, $this);
    }

    public function getById($KODERBB)
    {
        return $this->db->get_where($this->_table, ["KODE_RBB" => $KODERBB])->row();
    }
}
