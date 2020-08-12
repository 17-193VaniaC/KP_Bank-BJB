<?php defined('BASEPATH') or exit('No direct script access allowed');

class Log_model extends CI_Model
{
    private $_table = "log";

    public $id;
    public $USER;
    public $TGL_LOG;
    public $TABLE_NAME;
    public $KODE_DATA;
    public $ACTIVITY;

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save($data)
    {
        $this->USER = $data["USER"];
        $this->TGL_LOG = date("Y-m-d h:i:s");
        $this->TABLE_NAME = $data["TABLE_NAME"];
        $this->KODE_DATA = $data["KODE_DATA"];
        $this->ACTIVITY = $data["ACTIVITY"];

        $this->db->insert($this->_table, $this);
    }
}
