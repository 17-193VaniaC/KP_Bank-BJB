<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test_RBB extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->library('unit_test');
        $this->load->model("RBB_model");
        $this->load->model("vendor");
	}

	public function test_rbb_getall_type()
    {
        $this->unit->run(is_array($this->RBB_model->getAll()), TRUE, "Result type test");
        echo $this->unit->report();
    }

    public function test_rbb_getbyid_type()
    {
    	$datatest = 'aaaaaa';
    	$this->unit->run(gettype($this->RBB_model->getByID($datatest)), 'object', "Result type test get by ID");
        echo $this->unit->report();

    }
}