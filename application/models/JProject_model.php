<?php defined('BASEPATH') or exit('No direct script access allowed');

class JProject_model extends CI_Model
{
    private $_table = "j_project";

    public $jenis;

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
        $this->jenis = $post["jenis"];
        return $this->db->insert($this->_table, $this);
    }

    public function getById($jenis_project)
    {
        return $this->db->get_where($this->_table, ["jenis" => $jenis_project])->row();
    }

    public function delete($jenis_project)
    {
        return $this->db->delete($this->_table, array("jenis" => $jenis_project));
    }
}
