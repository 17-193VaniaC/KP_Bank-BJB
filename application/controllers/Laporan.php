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
        $res = $this->Laporan_model->getData();
        $data['table'] = $res;
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
        $res = $this->Laporan_model->getData();
        $data['table'] = $res;
        $this->load->view('Laporan/laporan_pdf', $data);
    }

    public function export()
    {
        // require_once __DIR__ . '/vendor/autoload.php';

        $res = $this->Laporan_model->getData();
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
}
