<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Log_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        } else {
            redirect('login');
        }
    }

    public function login()
    {
        $title['title'] = 'Login';
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $title);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            //Validasi sukses  
            $this->_login();  //_ untuk menandakan private hanya untuk kelas ini saja  
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['USERNAME' => $username])->row_array();  //baca : select * dari tael user where email == $email  
        if ($user) {
            // jika user aktif 
            if (password_verify($password, $user['PASSWORD'])) {
                $data = [
                    'username' => $user['USERNAME'],
                    'role' => $user['ROLE']
                ];
                $this->session->set_userdata($data);
                if ($user['ROLE'] == 'IT FINANCE') {
                    redirect('dashboard');
                } elseif ($user['ROLE'] == 'GROUP HEAD') {
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> You are can not access with this account! </div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong password</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Account is not registered! </div>');
            redirect('login');
        }
    }

    public function registration()
    {
        $title['title'] = 'Register Account';
        $dataa['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($dataa['user']['ROLE'] == 'IT FINANCE') {
            // if ($this->session->userdata('email')) {
            //     redirect('user');
            // }
            $this->form_validation->set_rules('role', 'Role', 'required|trim');
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.USERNAME]', [
                'is_unique' => 'This username has already registered!'
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
                'matches' => 'password dont match',
                'min_length' => 'Password too short!'
            ]); //trim agar jika menyisakan spasi di depan atau dibelakang akan dihapus agar tidak tersimpan di db  
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $title);
                $this->load->view('templates/navbar', $dataa);
                $this->load->view('auth/register');
                $this->load->view('templates/footer');
            } else {
                $data = [
                    'ROLE' => $this->input->post('role'),
                    'NAMA' => $this->input->post('nama', true),
                    'USERNAME' => htmlspecialchars($this->input->post('username', true)),
                    'PASSWORD' => password_hash($this->input->post('password1'), PASSWORD_BCRYPT)
                ];
                $this->db->insert('user', $data);

                // ADD LOG
                $log = $this->Log_model;
                $data_log['USER'] = $dataa['user']['NAMA'];
                $data_log['TABLE_NAME'] = 'user';
                $data_log['KODE_DATA'] = $this->input->post('username');
                $data_log['ACTIVITY'] = 'register';
                $log->save($data_log);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulation! Your account has been created. Please wait until your account is activated to create your program(s). </div>');
                redirect('welcome');
            }
        } elseif ($dataa['user']['ROLE'] == 'GROUP HEAD') {
            redirect('dashboard');
        } else {
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You have been logout. </div>');
        redirect('dashboard');
    }
    public function blocked()
    {
        $this->load->view('auth/block');
    }
}
