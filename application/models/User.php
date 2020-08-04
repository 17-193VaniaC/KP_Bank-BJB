<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

    public $ROLE;
    public $KODE_USER;
    public $USERNAME;
    public $PASSWORD;

    public function rules()
    {
        return[
            ['field' => 'ROLE', 
            'label' => 'ROLE', 
            'rules' => 'required'],
            
            ['field' => 'USERNAME', 
            'label' => 'USERNAME', 
            'rules' => 'required'],
            
            ['field' => 'PASSWORD', 
            'label' => 'PASSWORD', 
            'rules' => 'required']
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
    public function login($usernm, $pswrd){



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
    

}

?>