<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once('PHPExcel.php');

class Excel extends PHPExcel{
	public function __construct(){
		parent::__construct();
	}

	function action(){
		$this->load->model("excel_");
		$this->load->library('excel');
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);
		$table_columns = array("Kode RBB", "Program Kerja",	"Anggaran",	'GL', 'Nama Rekening',	"Mutasi RBB", "Sisa Anggaran",	"Nomor PKS",	"Jenis Project", "Kode Project", "Nama Project", "Tanggal PKS", "Nominal PKS",	"Nama Vendor", "Mutasi PKS", "Sisa Anggaran", "Kode Invoice",	"Tahap",	'Nominal',	"Tanggal Invoice");
		$column = 0;
		foreach ($table as $field) {
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field)
			$column++;
		}
	}
}

?>