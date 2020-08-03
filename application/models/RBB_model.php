<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RBB_model extends CI_Model
{
    private $_table = "rbb";

    public $KODE_RBB;
    public $PROGRAM_KERJA;
    public $ANGGARAN;
    public $GL;
    public $NAMA_REK;
    public $SISA_ANGGARAN;

    public function rules()//belum di setting
    {
        return[
            ['field' => 'm_name', 
            'label' => 'm_name', 
            'rules' => 'required'],

            ['field' => 'price', 
            'label' => 'price', 
            'rules' => 'required']
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
        $this->SISA_ANGGARAN = $post["SISA_ANGGARAN"];
        return $this->db->insert($this->_table, $this);
        }
    
    public function getThis($KODERBB)
    {
        return $this->db->get_where($this->_table, ["KODE_RBB" => $KODERBB])->row();
    }
    public function edit()
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
        $this->_deleteImage($KODERBB);
        
        return $this->db->delete($this->_table, array("KODERBB" =>$KODERBB));
    }

}

?>