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

    public function rules()
    {
        return[
            ['field' => 'INVOICE', 
            'label' => 'INVOICE', 
            'rules' => 'required|is_unique[pembayaran.INVOICE]'],

            ['field' => 'NO_PKS',
            'label' => 'NO_PKS', 
            'rules' => 'required'],

            ['field' => 'TGL_INVOICE', 
            'label' => 'TGL_INVOICE', 
            'rules' => 'required'],

            ['field' => 'NOMINAL_BAYAR', 
            'label' => 'SISA_ANGGARAN_PKS', 
            'rules' => 'required']

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save()
    {   //jika ada invoice dari pks ini sebelumnya
        if(){

        }

        $this->db->select('NOMINAL_PKS');
        $this->db->from('pks');
        $this->db->where('NO_PKS', $post['NO_PKS']);
        $last_budget = $this->db->get();

        $post = $this->input->post();
        $this->INVOICE = $post["INVOICE"];
        $this->NO_PKS = $post["NO_PKS"];
        $this->TGL_INVOICE = $post["TGL_INVOICE"];
        $this->TERMIN = $post["TERMIN"];
        $this->NOMINAL_BAYAR = $post["NOMINAL_BAYAR"];


        $this->SISA_ANGGARAN_PKS = $last_budget

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

    public function checkbudget($NO_PKS){// return sisa budget
        $termin_bayar = $this->db->get_where('pks', array('NO_PKS'=>$NO_PKS))
        //if pks invoice is exist
        if($termin_bayar->num_row()>0){
            //check the last budget
            $this->db->select('SISA_ANGGARAN_PKS');
            $this->db->from('pembayaran');
            $this->db->where('NO_PKS', $NO_PKS);
            $this->db->order_by('INPUT_DATE');
            $budget_remain=$this->db->get();
            return $budget_remain; //sisa budget di invoice terakhir
        }
        else{
            $this->db->select('NOMINAL_PKS');
            $this->db->from('pks')
            $this->db->where('NO_PKS', $NO_PKS);
            $budget_pks=$this->db->get();
            return $budget_remain;//anggaran pks
        }
    }
        

}

?>