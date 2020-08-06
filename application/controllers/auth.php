<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header');
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            //Validasi sukses  
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $post = $this->input->post();

        $user = $this->db->get_where('user', ['USERNAME' => $username])->row();
        if ($user) {
            $betul= password_verify($post['password'], $user->PASSWORD);
            echo $betul;
            if ($betul){
                echo 'Berhasil';
            }
            else {
                echo "betul ga?";
                echo $betul;
             
                echo 'Tidak berhasil';
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email is not registered! </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password 1 dont match',
            'min_length' => 'Password minimum 6 characters'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header');
            $this->load->view('auth/register');
            $this->load->view('templates/footer');
        } else {
            $PASS=$this->input->post('password1');
            $PASS=password_hash($PASS, PASSWORD_DEFAULT);
            
            $data = [
                'ROLE' => $this->input->post('role'),
                'NAMA' => $this->input->post('nama'),
                'USERNAME' => $this->input->post('username'),
                'PASSWORD'=> $PASS
            ];
            echo $data['PASSWORD'];
            // var_dump(password_verify($this->input->post('password1'), password_hash($this->input->post('password1'), PASSWORD_DEFAULT)));
            // die;
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Account has been created.</div>');
            redirect('register');
        }
    }
}
