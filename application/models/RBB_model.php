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
                'label' => 'Kode RBB',
                'rules' => 'required|is_unique[rbb.KODE_RBB]'
            ],

            [
                'field' => 'PROGRAM_KERJA',
                'label' => 'Progran Kerja',
                'rules' => 'required'
            ],

            [
                'field' => 'ANGGARAN',
                'label' => 'Nominal Anggaran',
                'rules' => 'required'
            ],

            [
                'field' => 'GL',
                'label' => 'GL',
                'rules' => 'required'
            ],

            [
                'field' => 'NAMA_REK',
                'label' => 'Nama Rekening',
                'rules' => 'required'
            ]
        ];
    }

    public function rules2()
    {
        return [
            [
                'field' => 'PROGRAM_KERJA',
                'label' => 'Program Kerja',
                'rules' => 'required'
            ],

            [
                'field' => 'GL',
                'label' => 'GL',
                'rules' => 'required'
            ],

            [
                'field' => 'NAMA_REK',
                'label' => 'Nama Rekening',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll($that = null)
    {
        $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->like('KODE_RBB', $that, 'both');
            $this->db->order_by('INPUT_DATE', 'desc');
            return $this->db->get('rbb')->result();
        }
        $this->db->order_by('INPUT_DATE', 'desc');
        $response = $this->db->get('rbb')->result();
        return $response;
    }

    public function getPagination($that = null, $limit, $start)
    {
        $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->like('KODE_RBB', $that, 'both');
            $this->db->order_by('INPUT_DATE', 'desc');
            return $this->db->get('rbb', $limit, $start)->result();
        }
        $this->db->order_by('INPUT_DATE', 'desc');
        $response = $this->db->get('rbb', $limit, $start)->result();
        return $response;
    }

    public function saveImport($data)
    {
        $this->KODE_RBB = $data["KODE_RBB"];
        $this->PROGRAM_KERJA = $data["PROGRAM_KERJA"];
        $this->ANGGARAN = $data["ANGGARAN"];
        $this->GL = $data["GL"];
        $this->NAMA_REK = $data["NAMA_REK"];
        $this->SISA_ANGGARAN = $data["ANGGARAN"];
        $this->INPUT_DATE = date("Y-m-d h:i:s");

        return $this->db->insert($this->_table, $this);
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
        $this->GL = $post["GL"];
        $this->NAMA_REK = $post["NAMA_REK"];

        return $this->db->update($this->_table, $this, array('KODE_RBB' => $post['KODE_RBB']));
    }

    public function delete($KODERBB)
    {

        return $this->db->delete($this->_table, array("KODE_RBB" => $KODERBB));
    }

    public function sisa_subtr($KODERBB, $nominal)
    {
        $rbb = $this->db->get_where($this->_table, ["KODE_RBB" => $KODERBB])->row();
        $total = $rbb->SISA_ANGGARAN - $nominal;
        $this->db->set('SISA_ANGGARAN', $total);
        $this->db->where('KODE_RBB', $KODERBB);
        $this->db->update('rbb');
    }

    function getKode()
    {
        $response = array();
        $this->db->select('KODE_RBB');
        $q = $this->db->get('rbb');
        $response = $q->result();

        return $response;
    }

    public function isExist()
    {
        $post = $this->input->post();
        $rbbdata = $this->getById($post["KODE_RBB"]);
        if (count($rbbdata) < 1) { 
            return False;
        }
        return true;
    }

    public function UpdateAnggaranRBB()
    {
        $post = $this->input->post();
        $rbb = $this->getById($post["KODE_RBB"]);
        $used = $rbb[0]->ANGGARAN - $rbb[0]->SISA_ANGGARAN;
        if ($post["NOMINAL"] < $used) { 
            return false;
        }
        $new_left = $post["NOMINAL"] - $used;
        $this->db->set("ANGGARAN", $post["NOMINAL"], False);
        $this->db->set("SISA_ANGGARAN", $new_left, False);
        $this->db->where('KODE_RBB', $post['KODE_RBB']);
        $this->db->update('rbb');
        return true;
    }
    
    public function countquery($name = null)
    {
        if (!empty($name)) {
            $this->db->select('count(rbb.KODE_RBB) as n_row');
            $this->db->like('rbb.KODE_RBB', $name, 'both');
            return $this->db->get('rbb')->result();
        }
        $this->db->select('count(rbb.KODE_RBB) as n_row');
        return $this->db->get('rbb')->result();
    }
}
