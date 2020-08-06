<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('username')) {
			redirect('login');
		}
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates/header.php');
		$this->load->view('templates/navbar.php', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer.php');
	}
}
