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

    public function getPagination($that = null, $limit, $start)
    {
        $response = array();
        if (!empty($that) || $that == '0') {
            $this->db->select('*');
            $this->db->like('jenis', $that, 'both');
            $this->db->order_by('jenis', 'asc');
            return $this->db->get('j_project', $limit, $start)->result();
        }
        // Select record
        $this->db->select('*');
        $this->db->order_by('jenis', 'asc');
        $response = $this->db->get('j_project', $limit, $start)->result();
        return $response;
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

    public function getById($jenis_project)
    {
        return $this->db->get_where($this->_table, ["KODE_JENISPROJECT" => $jenis_project])->row();
    }

    public function getByNama($jenis_project)
    {
        $hasil = $this->db->get_where($this->_table, ["jenis" => $jenis_project])->row();
        return $hasil->KODE_JENISPROJECT;
    }

    public function delete($jenis_project)
    {
        return $this->db->delete($this->_table, array("KODE_JENISPROJECT" => $jenis_project));
    }

    public function updateStatusDel($jenis_project)
    {
        $post = $this->input->post();
        $this->db->select('STATUS');
        $r = $this->db->get_where('j_project', ['KODE_JENISPROJECT' => $jenis_project])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN - 1;
        $this->db->set('STATUS', $RN);
        $this->db->where("KODE_JENISPROJECT", $jenis_project);
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

    public function updateStatusDelEd($prevId)
    {
        $this->db->select('STATUS');
        $r = $this->db->get_where('j_project', ['KODE_JENISPROJECT' => $prevId])->result();
        $RN = $r[0]->STATUS;
        $RN = $RN - 1;
        $this->db->set('STATUS', $RN);;
        $this->db->where("KODE_JENISPROJECT", $prevId);
        return $this->db->update('j_project');
    }
    public function countquery($name = null)
    {
        if (!empty($name) || $name == '0') {
            $this->db->select('count(j_project.KODE_JENISPROJECT) as n_row');
            $this->db->like('j_project.jenis', $name, 'both');
            return $this->db->get('j_project')->result();
        }
        $this->db->select('count(j_project.KODE_JENISPROJECT) as n_row');
        return $this->db->get('j_project')->result();
    }
}
