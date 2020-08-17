<?php defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    private $_table = "pembayaran";

    public $INVOICE;
    public $KODE_TERMIN;
    public $TGL_INVOICE;
    public $INPUT_DATE;

    public function rules()
    {
        return [
            [
                'field' => 'INVOICE',
                'label' => 'INVOICE',
                'rules' => 'required|is_unique[pembayaran.INVOICE]'
            ],

            [
                'field' => 'KODE_TERMIN',
                'label' => 'KODE_TERMIN',
                'rules' => 'required'
            ],

            [
                'field' => 'TGL_INVOICE',
                'label' => 'TGL_INVOICE',
                'rules' => 'required'
            ]

        ];
    }

    public function getAll()
    {
        return $this->db->query('SELECT pembayaran.INVOICE, termin_pks.NO_PKS, pembayaran.TGL_INVOICE, termin_pks.TERMIN, termin_pks.NOMINAL, pks.NOMINAL_PKS
        FROM termin_pks, pembayaran, pks
        WHERE termin_pks.KODE_TERMIN = pembayaran.KODE_TERMIN AND termin_pks.NO_PKS = pks.NO_PKS
        ORDER BY pks.TGL_PKS, termin_pks.TERMIN')->result();
    }

    public function save()
    {
        //$last_termin = $this->Invoice_model->checktermin($NOPKS);
        // if($last_termin >0 ){
        //    $nominalbayar = $this->Invoice_model->termin_val($NOPKS, $last_termin);
        // $last_budget = $this->Invoice_model->budget_remain($NOPKS);
        // $termin= $this->load->model("Termin_model");

        $post = $this->input->post();
        $this->INVOICE = $post["INVOICE"];
        $this->KODE_TERMIN = $post["KODE_TERMIN"];
        $this->TGL_INVOICE = $post["TGL_INVOICE"];
        $this->INPUT_DATE =  date("Y-m-d h:i:s");

        // $termin->paid($post["KODE_TERMIN"]);


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
        return $this->db->update($this->_table, $this, array('INVOICE' => $post['INVOICE']));
    }

    public function delete($INVOICE)
    {
        return $this->db->delete($this->_table, array("INVOICE" => $INVOICE));
    }

    public function checktermin($NOPKS)
    { // return sisa termin
        $status_unpaid = "UNPAID";
        $unpaid_stats = array("NO_PKS" => $NOPKS, "STATUS" => $status_unpaid);
        $this->db->select("TERMIN");
        $this->db->where($unpaid_stats);
        $this->db->order_by("TERMIN", 'asc');
        $this->db->limit(1);
        $checktermin = $this->db->get('termin');
        //jika tidak ada termin yang belum dibayar
        if (!empty($checktermin->num_row())) { //
            return $checktermin; //termin yang belum di bayar
        } else {
            return 0; //termin 0
        }
    }

    public function seeThisTermin($nopks)
    {
        $this->db->from('termin_pks');
        $this->db->like('NO_PKS', $nopks, 'after');
        $this->db->where('STATUS', "UNPAID");
        $this->db->order_by('NO_PKS');
        $this->db->limit(4);
        return $this->db->get()->result();
    }
}
