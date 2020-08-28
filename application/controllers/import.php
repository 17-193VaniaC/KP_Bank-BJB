<?php defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RBB_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('import/rbb');
    }

    public function rbb()
    {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            // FIle path
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $allDataInSheet = $spreadsheet->getActiveSheet()->toArray();






            // array count
            // $arrayCount = count($allDataInSheet);
            $flag = 0;
            // $createArray = array('KODE_RBB', 'PROGRAM_KERJA', 'ANGGARAN', 'GL', 'NAMA_REK', 'SISA_ANGGARAN');
            // $makeArray = array('KODE_RBB' => 'Kode RBB', 'PROGRAM_KERJA' => 'Program Kerja', 'ANGGARAN' => 'Anggaran', 'GL' => 'GL', 'NAMA_REK' => 'Nama Rekening', 'SISA_ANGGARAN' => 'Anggaran');
            // $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                // var_dump('faberosaurus');
                if ($flag == 1) {
                    foreach ($dataInSheet as $key => $value) {
                        if ($key == 0) {
                            $data['KODE_RBB'] = $value;
                        } else if ($key == 1) {
                            $data['PROGRAM_KERJA'] = $value;
                        } else if ($key == 2) {
                            $data['ANGGARAN'] = $value;
                        } else if ($key == 3) {
                            $data['GL'] = $value;
                        } else if ($key == 4) {
                            $data['NAMA_REK'] = $value;
                        } else if ($key == 5) {
                            $data['SISA_ANGGARAN'] = $value;
                        }
                    }
                    $this->RBB_model->saveImport($data);
                } else {
                    foreach ($dataInSheet as $key => $value) {
                    }
                    $flag = 1;
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Import Berhasil </div>');
            redirect('rbb');
        }
    }
    //         foreach ($dataInSheet as $key => $value) {

    //             // echo 'galimimus';
    //             // var_dump($value);
    //             // var_dump($key);
    //             // if (in_array(trim($value), $createArray)) {
    //             // echo 'haderosaurus';
    //             // $value = preg_replace('/\s+/', '', $value);
    //             var_dump('value = ');
    //             var_dump($value);
    //             var_dump(' | key = ');
    //             var_dump($key);
    //             $flag = 1;
    //             // die;
    //             // $SheetDataKey[trim($value)] = $key;
    //             // }
    //         }
    //         var_dump('*********************');
    //     }
    //     die;


    //     // var_dump($SheetDataKey);
    //     // var_dump($allDataInSheet);
    //     // die;
    //     $dataDiff = array_diff_key($makeArray, $SheetDataKey);

    //     $kode_rbb = filter_var(trim($allDataInSheet[1][$kode_rbb]), FILTER_SANITIZE_STRING);
    //     var_dump($kode_rbb);
    //     die;
    //     // var_dump(empty($dataDiff));
    //     // die;
    //     if ($dataDiff) {
    //         // var_dump('iguanodon');
    //         // die;
    //         $flag = 1;
    //     }

    //     // match excel sheet column
    //     if ($flag == 1) {
    //         var_dump('jaxerotosaurus');
    //         for ($i = 2; $i <= $arrayCount; $i++) {
    //             echo 'kenterosaurus';
    //             $kode_rbb = $SheetDataKey['Kode RBB'];
    //             $program_kerja = $SheetDataKey['PROGRAM_KERJA'];
    //             $anggaran = $SheetDataKey['ANGGARAN'];
    //             $gl = $SheetDataKey['GL'];
    //             $nama_rekening = $SheetDataKey['NAMA_REK'];
    //             $sisa_anggaran = $SheetDataKey['SISA_ANGGARAN'];

    //             $kode_rbb = filter_var(trim($allDataInSheet[$i][$kode_rbb]), FILTER_SANITIZE_STRING);
    //             $program_kerja = filter_var(trim($allDataInSheet[$i][$program_kerja]), FILTER_SANITIZE_STRING);
    //             $anggaran = filter_var(trim($allDataInSheet[$i][$anggaran]), FILTER_SANITIZE_STRING);
    //             $gl = filter_var(trim($allDataInSheet[$i][$gl]), FILTER_SANITIZE_STRING);
    //             $nama_rekening = filter_var(trim($allDataInSheet[$i][$nama_rekening]), FILTER_SANITIZE_STRING);
    //             $sisa_anggaran = filter_var(trim($allDataInSheet[$i][$sisa_anggaran]), FILTER_SANITIZE_STRING);
    //             $fetchData[] = array('KODE_RBB' => $kode_rbb, 'PROGRAM_KERJA' => $program_kerja, 'ANGGARAN' => $anggaran, 'GL' => $gl, 'NAMA_REK' => $nama_rekening, 'SISA_ANGGARAN' => $sisa_anggaran);
    //         }
    //         var_dump('lambeosaurus');
    //         $data['dataInfo'] = $fetchData;
    //         $this->import_model->setBatchImport($fetchData);
    //         $this->import_model->importData();
    //     } else {
    //         // echo 'format salah';
    //         var_dump('format salah');
    //         die;
    //     }
    //     redirect('dashboard');
    // }
    // $this->form_validation->set_rules('fileURL', 'Upload File', 'callback_checkFileValidation');
    // if ($this->form_validation->run() == false) {
    //     $this->load->view('import/rbb');
    // } else {
    // echo 'ankilosaurus';
    // // Jika file terupload
    // if (!empty($_FILES['fileURL']['name'])) {
    //     echo 'brakiosaurus';
    //     // Get extension
    //     $extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
    //     if ($extension == 'xlsx') {
    //         echo 'compesogenatus';
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     } else {
    //         echo 'deinikus';
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     }
    //     // File path
    //     echo 'elasmosaurus';
    //     $spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
    //     $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    //     // array count
    //     $arrayCount = count($allDataInSheet);
    //     $flag = 0;
    //     $createArray = array('KODE_RBB', 'PROGRAM_KERJA', 'ANGGARAN', 'GL', 'NAMA_REK', 'SISA_ANGGARAN');
    //     $makeArray = array('KODE_RBB' => 'Kode RBB', 'PROGRAM_KERJA' => 'Program Kerja', 'ANGGARAN' => 'Anggaran', 'GL' => 'GL', 'NAMA_REK' => 'Nama Rekening', 'SISA_ANGGARAN' => 'Anggaran');
    //     $SheetDataKey = array();
    //     foreach ($allDataInSheet as $dataInSheet) {
    //         echo 'faberosaurus';
    //         foreach ($dataInSheet as $key => $value) {
    //             echo 'galimimus';
    //             if (in_array(trim($value), $createArray)) {
    //                 echo 'haderosaurus';
    //                 $value = preg_replace('/\s+/', '', $value);
    //                 $SheetDataKey[trim($value)] = $key;
    //             }
    //         }
    //     }

    //     $dataDiff = array_diff_key($makeArray, $SheetDataKey);
    //     if (empty($dataDiff)) {
    //         echo 'iguanodon';
    //         $flag = 1;
    //     }

    //     // match excel sheet column
    //     if ($flag == 1) {
    //         echo 'jaxerotosaurus';
    //         for ($i = 2; $i <= $arrayCount; $i++) {
    //             echo 'kenterosaurus';
    //             $kode_rbb = $SheetDataKey['KODE_RBB'];
    //             $program_kerja = $SheetDataKey['PROGRAM_KERJA'];
    //             $anggaran = $SheetDataKey['ANGGARAN'];
    //             $gl = $SheetDataKey['GL'];
    //             $nama_rekening = $SheetDataKey['NAMA_REK'];
    //             $sisa_anggaran = $SheetDataKey['SISA_ANGGARAN'];

    //             $kode_rbb = filter_var(trim($allDataInSheet[$i][$kode_rbb]), FILTER_SANITIZE_STRING);
    //             $program_kerja = filter_var(trim($allDataInSheet[$i][$program_kerja]), FILTER_SANITIZE_STRING);
    //             $anggaran = filter_var(trim($allDataInSheet[$i][$anggaran]), FILTER_SANITIZE_STRING);
    //             $gl = filter_var(trim($allDataInSheet[$i][$gl]), FILTER_SANITIZE_STRING);
    //             $nama_rekening = filter_var(trim($allDataInSheet[$i][$nama_rekening]), FILTER_SANITIZE_STRING);
    //             $sisa_anggaran = filter_var(trim($allDataInSheet[$i][$sisa_anggaran]), FILTER_SANITIZE_STRING);
    //             $fetchData[] = array('KODE_RBB' => $kode_rbb, 'PROGRAM_KERJA' => $program_kerja, 'ANGGARAN' => $anggaran, 'GL' => $gl, 'NAMA_REK' => $nama_rekening, 'SISA_ANGGARAN' => $sisa_anggaran);
    //         }
    //         echo 'lambeosaurus';
    //         $data['dataInfo'] = $fetchData;
    //         $this->import_model->setBatchImport($fetchData);
    //         $this->import_model->importData();
    //     } else {
    //         echo 'format salah';
    //     }
    //     redirect('dashboard');
    // }
    // }
    // }
}
