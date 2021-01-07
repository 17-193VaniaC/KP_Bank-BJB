<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestUnit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->controller('welcome');
	}

	public function index()
	{
		echo "Using Unit Test Library";
	}
	public function test()
    {
        $result = $this->execute('welcome');
        $this->unit->run($result, isRedirect() , "redirect test");
    }

    public function test2()
    {
        $result = $this->controller(\App\Controllers\Welcome::class)
                       ->execute('welcome');
        echo $this->unit->report();

        // $this->assertTrue($result->isRedirect());
	}}