<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model("Laporan_model");
        $this->load->library('form_validation');
    }


    public function index()
    {
        $title['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if(!empty($this->input->post('Search'))){ 
            // var_dump($this->input->post('searchById'))  ;
            // die;?
            // $this->session->set_flashdata('SearchActive', 'RBB terakhir');
            $res = $this->Laporan_model->getData($this->input->post('searchById'));
            $data['table'] = $res;
            $data['keyword_'] = $this->input->post('searchById');
        
        }
        else{
            $res = $this->Laporan_model->getData();
            // $this->session->set_flashdata('SearchActive', 'RBB terakhir');
            $data['table'] = $res;   
            $data['keyword_'] = '';

        }
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('Laporan/laporan', $data);
        $this->load->view('templates/footer.php');
    }

    public function form_export()
    {
        $title['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view('Laporan/form_laporan', $data);
        $this->load->view('templates/footer.php');
    }

    public function laporan_pdf()
    {
        // $res = $this->Laporan_model->getData();
        if($this->input->post('submit')){

        $res = $this->input->post('keyword');
        $data['table'] = $this->Laporan_model->getData($res);
        // var_dump($res);
        // die;
        }
        else{
        $data['table'] = $this->Laporan_model->getData();
        }
        $this->load->view('Laporan/laporan_pdf', $data);
    }

    public function export()
    {
        // require_once __DIR__ . '/vendor/autoload.php';

        // $res = $this->input->post('table');
        $data['table'] = $res;

        // $this->load->view('Laporan/laporan_pdf', $data);

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);
        $mpdf->SetHTMLFooter('
            <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
                <tr>
                    <td width="33%">{DATE j-m-Y}</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right;">Bank BJB</td>
                </tr>
            </table>');
        // $html = $this->load->view('Laporan/form_laporan', [], true);

        $html = $this->load->view('Laporan/laporan_pdf', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();






        // $tgl_awal = date('Y-m-d', $this->input->post('taggal_awal'));
        // $tgl_akhir = date('Y-m-d', $this->input->post('taggal_akhir'));
        // $laporan = $this->laporan_model->getByDate($tgl_awal, $tgl_akhir);

        // $pdf = new FPDF('l','mm','A4');
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 14);
        // $pdf->Cell(115, 0, "Tanggal " . date('d-m-Y', $this->input->post('tanggal_awal')) . "-" .  date('d-m-Y', $this->input->post('tanggal_awal')), 0, 1, 'L');

        // // header
        // $pdf->Ln(10);
        // $pdf->SetFont('', 'B', 12);
        // $pdf->Cell()
    }

    public function exportAsExcel(){
        $this->load->library('excel');
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        // $table_columns = array("Kode RBB", "Program Kerja", "Anggaran", 'GL', 'Nama Rekening',  "Mutasi RBB", "Sisa Anggaran",  "Nomor PKS",    "Jenis Project", "Kode Project", "Nama Project", "Tanggal PKS", "Nominal PKS",  "Nama Vendor", "Mutasi PKS", "Sisa Anggaran", "Kode Invoice",   "Tahap",    'Nominal',  "Tanggal Invoice");
        $table_columns = array("Kode RBB", "Program Kerja", "Anggaran", 'GL', 'Nama Rekening',  "Nomor PKS",    "Jenis Project", "Kode Project", "Nama Project", "Tanggal PKS", "Nominal PKS",  "Nama Vendor", "Kode Invoice",   "Tahap",    'Nominal',  "Tanggal Invoice");
        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        if($this->input->post('submit')){
        $data_laporan = $this->input->post('keyword');
        $data_laporan = $this->Laporan_model->getData($data_laporan);
        }
        else{
        $data_laporan = $this->Laporan_model->getData();
        var_dump('keyword');
        die;
        }
        $excel_row = 2;

        // foreach ($data_laporan as $row) {
        //     //rbb
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row, $row["KODE_RBB"]);
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row, $row["PROGRAM_KERJA"]);
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row, $row["ANGGARAN"]);
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row, $row["GL"]);
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row, $row["NAMA_REK"]);

        //     $Mutasi_rbb=0;
        //     $Sisa_rbb = $row['ANGGARAN'];
        //     //kalau ada pks
        //     if(!empty($row['pks'])){
        //         foreach ($row['pks'] as $pks) {

        //             $Mutasi_rbb = $Mutasi_rbb+$pks["NOMINAL_PKS"];
        //             $Sisa_rbb = $Sisa_rbb-$pks['NOMINAL_PKS'];
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $Mutasi_rbb);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $Sisa_rbb);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, $pks['NO_PKS']);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row, $pks['jenis']);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row, $pks['KODE_PROJECT']);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row, $pks['NAMA_PROJECT']);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row, $pks['TGL_PKS']);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row, $pks['NOMINAL_PKS']);
        //             $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row, $pks['nama_vendor']);
        //             $Mutasi_pks=0;
        //             $Sisa_pks = $pks["NOMINAL_PKS"];
        //             // kalau ada invoice
        //             if(!empty($pks['invs'])){
        //                 foreach ($pks['invs'] as $invs) {
        //                     $Mutasi_pks = $Mutasi_pks+$pks["NOMINAL_PKS"];
        //                     $Sisa_rpks = $Sisa_pks-$pks['NOMINAL_PKS'];
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row, $Mutasi_pks);
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row, $Sisa_pks);
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(16,$excel_row, $invs['INVOICE']);
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(17,$excel_row, $invs['TERMIN']);
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(18,$excel_row, $invs['NOMINAL']);
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(20,$excel_row, $invs['TGL_INVOICE']);
        //                     $excel_row++;
        //                 }    
        //             }
        //             else{
        //                     $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row, $Sisa_pks);
        //                     $excel_row++;
        //             }

        //         }
        //     }
        //     else{
        //         $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $Sisa_rbb);
        //         $excel_row++;
                
        //     }
        
        // }

        foreach ($data_laporan as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row, $row["KODE_RBB"]);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row, $row["PROGRAM_KERJA"]);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row, $row["ANGGARAN"]);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row, $row["GL"]);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row, $row["NAMA_REK"]);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $row['NO_PKS']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $row['jenis']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, $row['KODE_PROJECT']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row, $row['NAMA_PROJECT']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row, $row['TGL_PKS']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row, $row['NOMINAL_PKS']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row, $row['nama_vendor']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row, $row['INVOICE']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row, $row['TERMIN']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row, $row['NOMINAL']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row, $row['TGL_INVOICE']);
            $excel_row++;

        }
        $object_writter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=Laporan Gabungan.xls');
        $object_writter->save('php://output');
        redirect('laporan');
    }
}
