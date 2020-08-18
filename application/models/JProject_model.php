<?php defined('BASEPATH') or exit('No direct script access allowed');

class JProject_model extends CI_Model
{
    private $_table = "j_project";

    public $KODE_JENISPROJECT;
    public $jenis;
    public $STATUS;

    public function rules()
    {
        return [
            [
                'field' => 'jenis',
                'label' => 'jenis',
                'rules' => 'trim|required|is_unique[j_project.jenis]'
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
        $this->KODE_JENISPROJECT = uniqid();
        $this->jenis = $post["jenis"];
        $this->STATUS = 0;
        $this->db->insert($this->_table, $this);
        return $this->KODE_JENISPROJECT;
    }
<<<<<<< HEAD
    public function update($jenis = null)
    {
        $post = $this->input->post();
        $this->KODE_JENISPROJECT = $post["KODE_JENISPROJECT"];
        $this->jenis = $post["jenis"];
        $this->db->set("jenis", $post["jenis"]);
        $this->db->where("KODE_JENISPROJECT", $post["KODE_JENISPROJECT"]);
        $this->db->update('j_project');
        return $this->KODE_JENISPROJECT;
    }
=======
>>>>>>> parent of 078636e... JProject updated

    public function getById($jenis_project)
    {
        return $this->db->get_where($this->_table, ["KODE_JENISPROJECT" => $jenis_project])->row();
    }

    public function delete($jenis_project)
    {
        return $this->db->delete($this->_table, array("KODE_JENISPROJECT" => $jenis_project));
    }

    public function updateStatusDel()
    {
        $post = $this->input->post();
        $this->db->select('STATUS');
        $r = $this->db->get_where('j_project', ['KODE_JENISPROJECT' => $post["jenis"]])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN - 1;
        $this->db->set('STATUS', $RN);
        $this->db->where("KODE_JENISPROJECT", $post["jenis"]);
        return $this->db->update('j_project');
    }

    public function updateStatusAdd()
    {
        $post = $this->input->post();
        $this->db->select('STATUS');
        $r = $this->db->get_where('j_project', ['KODE_JENISPROJECT' => $post["jenis"]])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN + 1;
        $this->db->set('STATUS', $RN);;
        $this->db->where("KODE_JENISPROJECT", $post["jenis"]);
        return $this->db->update('j_project');
    }
}
