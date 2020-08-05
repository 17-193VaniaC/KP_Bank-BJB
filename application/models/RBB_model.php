<?php defined('BASEPATH') or exit('No direct script access allowed');

class RBB_model extends CI_Model
{
    private $_table = "rbb";

    public $KODE_RBB;
    public $PROGRAM_KERJA;
    public $ANGGARAN;
    public $GL;
    public $NAMA_REK;
    public $SISA_ANGGARAN;

    public function rules()
    {
        return [
            [
                'field' => 'KODE_RBB',
                'label' => 'KODE_RBB',
                'rules' => 'required|is_unique[rbb.KODE_RBB]'
            ],

            [
                'field' => 'PROGRAM_KERJA',
                'label' => 'PROGRAM_KERJA',
                'rules' => 'required'
            ],

            [
                'field' => 'ANGGARAN',
                'label' => 'ANGGARAN',
                'rules' => 'required'
            ],

            [
                'field' => 'GL',
                'label' => 'GL',
                'rules' => 'required'
            ],

            [
                'field' => 'NAMA_REK',
                'label' => 'NAMA_REK',
                'rules' => 'required'
            ]
        ];
    }

    public function rules2()
    {
        return [
            [
                'field' => 'PROGRAM_KERJA',
                'label' => 'PROGRAM_KERJA',
                'rules' => 'required'
            ],

            [
                'field' => 'ANGGARAN',
                'label' => 'ANGGARAN',
                'rules' => 'required'
            ],

            [
                'field' => 'GL',
                'label' => 'GL',
                'rules' => 'required'
            ],

            [
                'field' => 'NAMA_REK',
                'label' => 'NAMA_REK',
                'rules' => 'required'
            ],

            [
                'field' => 'SISA_ANGGARAN',
                'label' => 'SISA_ANGGARAN',
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
        $this->PROGRAM_KERJA = $post["PROGRAM_KERJA"];
        $this->ANGGARAN = $post["ANGGARAN"];
        $this->GL = $post["GL"];
        $this->NAMA_REK = $post["NAMA_REK"];
        $this->SISA_ANGGARAN = $post["ANGGARAN"];

        return $this->db->insert($this->_table, $this);
    }

    public function getById($KODERBB)
    {
        return $this->db->get_where($this->_table, ["KODE_RBB" => $KODERBB])->row();
    }
    public function update()
    {
        $post = $this->input->post();
        $this->KODE_RBB = $post["KODE_RBB"];
        $this->PROGRAM_KERJA = $post["PROGRAM_KERJA"];
        $this->ANGGARAN = $post["ANGGARAN"];
        $this->GL = $post["GL"];
        $this->NAMA_REK = $post["NAMA_REK"];
        $this->SISA_ANGGARAN = $post["SISA_ANGGARAN"];

        return $this->db->update($this->_table, $this, array('KODE_RBB' => $post['KODE_RBB']));
    }

    public function delete($KODERBB)
    {

        return $this->db->delete($this->_table, array("KODE_RBB" => $KODERBB));
    }

    public function sisa_subtr($KODERBB, $nominal) //untk mengurangi anggaran RBB
    {
        $this->$_table->set('SISA_ANGGARAN', 'SISA_ANGGARAN - $nominal', False);
        $this->$_table->where('KODE_RBB', $KODERBB);
        $this->$_table->update();
    }

    function getKode()
    {
        $response = array();

        // Select record
        $this->db->select('KODE_RBB');
        $q = $this->db->get('rbb');
        $response = $q->result();

        return $response;
    }
}
