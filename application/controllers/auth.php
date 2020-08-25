<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Log_model");
        $this->load->model("User_model");
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        } 
        else {
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
        } 
        else {
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
        $title['title'] = 'Registrasi Akun';
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
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.EMAIL]', [
                'is_unique' => 'This email has already registered!'
            ]);
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
                'matches' => 'Password tidak sesuai',
                'min_length' => 'Password terdiri dari minimal 6 karakter'
            ]); //trim agar jika menyisakan spasi di depan atau dibelakang akan dihapus agar tidak tersimpan di db  
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $title);
                $this->load->view('templates/navbar', $dataa);
                $this->load->view('auth/register');
                $this->load->view('templates/footer');
            } 
            else {
                $data = [
                    'ROLE' => $this->input->post('role'),
                    'NAMA' => $this->input->post('nama', true),
                    'USERNAME' => htmlspecialchars($this->input->post('username', true)),
                    'EMAIL' => htmlspecialchars($this->input->post('email', true)),
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

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Akun berhasil dibuat. </div>');
                redirect('seeAllUser');
            }
        } 
        elseif ($dataa['user']['ROLE'] == 'GROUP HEAD') {
            redirect('dashboard');
        } 
        else {
            redirect('login');
        }
    }

    public function seeAllUser()
    {
        $title['title'] = 'Daftar Akun';
        $data['list'] = $this->User_model->getAll();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('auth/index', $data);
        $this->load->view('templates/footer.php');
    }

    // public function edit($username)
    // {
    //     $title['title'] = 'Edit Akun';
    //     $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
    //     if ($data['user']['ROLE'] == 'IT FINANCE') {
    //         $data['akun'] = $this->User_model->getByUsername($username);

    //         $this->form_validation->set_rules('role', 'Role', 'required|trim');
    //         $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    //         if ($this->input->post('password1') && $this->input->post('password1')) {
    //             $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[6]|matches[password2]', [
    //                 'matches' => 'Password tidak sesuai',
    //                 'min_length' => 'Password terdiri dari minimal 6 karakter'
    //             ]);
    //         }
    //         if ($this->form_validation->run() == false) {
    //             $this->load->view('templates/header.php', $title);
    //             $this->load->view('templates/navbar.php', $data);
    //             $this->load->view('auth/edit', $data);
    //             $this->load->view('templates/footer.php');
    //         } else {
    //             $this->User_model->update();

    //             // ADD LOG
    //             $log = $this->Log_model;
    //             $data_log['USER'] = $data['user']['NAMA'];
    //             $data_log['TABLE_NAME'] = 'user';
    //             $data_log['KODE_DATA'] = $this->input->post('username');
    //             $data_log['ACTIVITY'] = 'edit';
    //             $log->save($data_log);

    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah</div>');
    //             redirect('auth/list');
    //         }
    //     } else {
    //         redirect('list');
    //     }
    // }

    public function delete($username)
    {
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['USERNAME'] == $username) {
            // $this->User_model->delete($username);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda tidak bisa menghapus akun yang anda gunakan saat ini</div>');
            redirect('seeAllUser');
        } else if ($data['user']['ROLE'] == 'IT FINANCE') {
            $this->User_model->delete($username);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data berhasil dihapus.</div>');
            redirect('seeAllUser');
        } else {
            redirect('seeAllUser');
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

    // 1. Unutk menampilkan form email untuk ganti password
    public function forgot()
    {
        $title['title'] = 'Lupa Password';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header.php', $title);
            $this->load->view('auth/forgot');
            $this->load->view('templates/footer.php');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                // token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => date("Y-m-d h:i:s")
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Email terkirim! Silahkan periksa email untuk mengubah password</div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar</div>');
                redirect('login');
            }
        }
    }

    // 3. untuk mengecek apakah email dan token yang diakses user dari email benar
    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Token salah</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Email tidak terdaftar</div>');
            redirect('login');
        }
    }

    // 2. untuk mengirim email
    public function _sendEmail($token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'finance.bankbjb@gmail.com',
            'smtp_pass' => 'bjblantai3',
            'smtp_port' => '465',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        $this->email->from('finance.bankbjb@gmail.com', 'Finance Bank BJB');
        $this->email->to($this->input->post('email'));

        $this->email->subject('Reset Password');
        // $this->email->message('Click link berikut untuk mengubah password : <a href="' . base_url() . 'auth/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Ubah Password</a>');
        $this->email->message('
        
        <!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>HTML Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
        <tr>
            <td align="center" bgcolor="#767c91"
                style="padding: 40px 0 30px 0; font-family: sans-serif; color: white; font-weight: bold; font-size: 25px;">
                Reset Password
            </td>
        </tr>
        <tr>
            <td bgcolor="#f7f7f7" style="padding: 40px 30px 40px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td 
                            style="letter-spacing: .5px; color: #3f4b81; font-family: Arial, Helvetica, sans-serif, sans-serif; font-size: 14px; font-weight: bold;">
                            Hai! <br> Baru-baru ini terdapat permintaan untuk mengubah password anda. Silakan klik tombol di bawah untuk mengubah password 
                        </td>
                    </tr>
                    <hr>
                    <tr>
                        <td align="center">
                        <br>
                            <a href="' . base_url() . 'auth/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"><button style="background-color: blue;
                            border: none;
                            color: white;
                            padding: 15px 32px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 14px;">Ubah Password</button></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
        
        
        
        
        
        
        ');
        // $this->email->message('Click link berikut untuk mengubah password : <a href="">Ubah Password</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    // 4. menyimpan password baru
    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('login');
        }
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak sesuai',
            'min_length' => 'Password terdiri dari minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', []);

        if ($this->form_validation->run() == false) {
            $title['title'] = 'Ubah Password';
            $this->load->view('templates/header.php', $title);
            $this->load->view('auth/ubah');
            $this->load->view('templates/footer.php');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_BCRYPT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('PASSWORD', $password);
            $this->db->where('EMAIL', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ubah password berhasil!</div>');
            redirect('login');
        }
    }
}
