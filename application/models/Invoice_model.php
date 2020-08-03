<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    private $_table = "pembayaran";

    public $INVOICE;
    public $NO_PKS;
    public $TGL_INVOICE;
    public $TERMIN;
    public $NOMINAL_BAYAR;
    public $SISA_ANGGARAN_PKS;

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
        $this->INVOICE = $post["INVOICE"];
        $this->NO_PKS = $post["NO_PKS"];
        $this->TGL_INVOICE = $post["TGL_INVOICE"];
        $this->TERMIN = $post["TERMIN"];
        $this->NOMINAL_BAYAR = $post["NOMINAL_BAYAR"];
        $this->SISA_ANGGARAN_PKS = $post["SISA_ANGGARAN_PKS"];
        return $this->db->insert($this->_table, $this);
        }
    
    public function getThis($INVOICE)
    {
        return $this->db->get_where($this->_table, ["INVOICE" => $INVOICE])->row();
    }
    public function edit()
    {
        $post = $this->input->post();
        $this->INVOICE = $post["INVOICE"];
        $this->NO_PKS = $post["NO_PKS"];
        $this->TGL_INVOICE = $post["TGL_INVOICE"];
        $this->TERMIN = $post["TERMIN"];
        $this->NOMINAL_BAYAR = $post["NOMINAL_BAYAR"];
        $this->SISA_ANGGARAN_PKS = $post["SISA_ANGGARAN_PKS"];
        return $this->db->update($this->_table, $this, array('INVOICE' => $post['INVOICE']));
    }

    public function delete($INVOICE)
    {
        $this->_deleteImage($INVOICE);
        
        return $this->db->delete($this->_table, array("INVOICE" =>$INVOICE));
    }

}

?>