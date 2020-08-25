<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

    public $ROLE;
    public $NAMA;
    public $USERNAME;
    public $PASSWORD;

    public function rules()
    {
        return [
            [
                'field' => 'ROLE',
                'label' => 'ROLE',
                'rules' => 'required'
            ],

            [
                'field' => 'USERNAME',
                'label' => 'USERNAME',
                'rules' => 'required'
            ],

            [
                'field' => 'PASSWORD',
                'label' => 'PASSWORD',
                'rules' => 'required'
            ]
        ];
    }

    public function index()
    {
        $data["user"] = $this->User_model->getAll();
        $this->load->view("login", $data);
    }

    public function getByUsername($usernm)
    {
        return $this->db->get_where($this->_table, ["USERNAME" => $usernm])->row();
    }
    public function login($usernm, $pswrd)
    {
    }
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->VENDOR = $post["VENDOR"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->USERNAME = $post["username"];
        $this->NAMA = $post["nama"];
        $this->ROLE = $post["role"];
        if ($post["password1"]) {
            $this->PASSWORD = $post["password1"];
        }
        $this->db->update($this->_table, $this, array('USERNAME' => $post['username']));
    }

    public function delete($username)
    {
        $this->db->delete('user', array('USERNAME' => $username));
    }
}
