<?php defined('BASEPATH') or exit('No direct script access allowed');

class MutasiPKS_model extends CI_Model
{
    private $_table = "mutasi_pks";

    public $KODE_MUTASI;
    public $KODE_PKS;
    public $NOMINAL;
    public $TGL_MUTASI;

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save($data)
    {
        $this->KODE_MUTASI = uniqid();
        $this->KODE_PKS = $data->NO_PKS;
        $this->NOMINAL = $data->NOMINAL;
        $this->TGL_MUTASI = date('Y-m-d');
        return $this->db->insert($this->_table, $this);
    }
}
