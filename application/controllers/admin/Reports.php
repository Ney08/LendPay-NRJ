<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('coins_m');
        $this->load->model('reports_m');
        $this->load->library('session');
        $this->load->helper('url');
        $this->session->userdata('loggedin') == TRUE || redirect('user/login');
        
    }

    public function index(){
        // Default method for the Reports controller
        $data['coins'] = $this->coins_m->get();
        $data['subview'] = 'admin/reports/index';
        $this->load->view('admin/_main_layout', $data);
    }

    public function ajax_getCredits($coin_id){
        $data['credits'] = $this->reports_m->get_reportLoan($coin_id);

        echo json_encode($data);
    }

    public function dates(){
        $data['coins'] = $this->coins_m->get();
        $data['subview'] = 'admin/reports/dates';
        $this->load->view('admin/_main_layout', $data);
    }

    public function dates_pdf($coin_id, $start_d, $end_d){
    require_once APPPATH.'third_party/fpdf183/html_table.php';

    $reportCoin = $this->reports_m->get_reportCoin($coin_id);

    $pdf = new PDF();
    $pdf->AddPage('P','A4',0);
    $pdf->SetFont('Arial','B',13);
    $pdf->Ln(7);
    $pdf->Cell(0,0,'Reporte de prestamos por rango de fechas',0,1,'C');

    $pdf->Ln(8);
    
    $pdf->SetFont('Arial','',10);
    $html = '<table border="0">
    <tr>
    <td width="110" height="30"><b>Fecha inicial:</b></td><td width="400" height="30">'.$start_d.'</td><td width="110" height="30"><b>Tipo moneda:</b></td><td width="55" height="30">'.$reportCoin->name.'('.$reportCoin->short_name.')</td>
    </tr>
    <tr>
    <td width="110" height="30"><b>Fecha final:</b></td><td width="400" height="30">'.$end_d.'</td><td width="110" height="30"></td><td width="55" height="30"></td>
    </tr>
    </table>';

    $pdf->WriteHTML($html);

    // $reportsDates = $this->reports_m->get_reportDates(1,'2021-03-07','2021-05-13');
    // print_r($reportsDates);
    $reportsDates = $this->reports_m->get_reportDates($coin_id,$start_d,$end_d);

    $pdf->Ln(7);
    $pdf->SetFont('Arial','',10);
    $html1 = '';
    $html1 .= '<table border="1">
    <tr>
    <td width="80" height="30"><b>N'.utf8_decode("°").'Prest.</b></td><td width="100" height="30"><b>Fecha prest.</b></td><td width="120" height="30"><b>Monto prest.</b></td><td width="65" height="30"><b>Int. %</b></td><td width="65" height="30"><b>N'.utf8_decode("°").'cuot.</b></td><td width="90" height="30"><b>Modalidad</b></td><td width="100" height="30"><b>Total con Int.</b></td><td width="79" height="30"><b>Estado</b></td>
    </tr>';
    $sum_m = 0; $sum_mi = 0;
    foreach ($reportsDates as $rd) {
      $sum_m = $sum_m + $rd->credit_amount;
      $sum_mi = $sum_mi + $rd->total_int;
      $html1 .= '
    <tr>
    <td width="80" height="30">'.$rd->id.'</td><td width="100" height="30">'.$rd->date.'</td><td width="120" height="30">'.$rd->credit_amount.'</td><td width="65" height="30">'.$rd->interest_amount.'</td><td width="65" height="30">'.$rd->num_fee.'</td><td width="90" height="30">'.$rd->payment_m.'</td><td width="100" height="30">'.$rd->total_int.'</td><td width="79" height="30">'.($rd->status ? "Pendiente" : "Cancelado").'</td>
    </tr>';
    }

    $html1 .= '
    <tr>
    <td width="80" height="30"><b>Total</b></td><td width="100" height="30">-----</td><td width="120" height="30"><b>'.number_format($sum_m, 2).'</b></td><td width="65" height="30">-----</td><td width="65" height="30">-----</td><td width="90" height="30">-----</td><td width="100" height="30"><b>'.number_format($sum_mi, 2).'</b></td><td width="79" height="30">-----</td>
    </tr>';
    $html1 .= '</table>';

    $pdf->WriteHTML($html1);

    $pdf->Output('reporteFechas.pdf' , 'I');
  }
    

    public function clients(){
        $data['clients'] = $this->reports_m->get_reportCsts();
        $data['subview'] = 'admin/reports/clients';
        $this->load->view('admin/_main_layout', $data);
    }

    public function client_pdf($client_id)
  {
    require_once APPPATH.'third_party/fpdf183/html_table.php';

    $reportCst = $this->reports_m->get_reportLC($client_id);
    //print_r($reportCst[0]->client_name);

    $pdf = new PDF();
    $pdf->AddPage('P','A4',0);
    $pdf->SetFont('Arial','B',13);
    $pdf->Ln(7);
    $pdf->Cell(0,0,'Reporte de prestamos por cliente - '.$reportCst[0]->client_name,0,1,'C');

    $pdf->Ln(8);
  
    $pdf->SetFont('Arial','',10);

    foreach ($reportCst as $rc) {

    $html = '<table border="0">
    <tr>
    <td width="120" height="30"><b>Monto credito:</b></td><td width="400" height="30">'.$rc->credit_amount.'</td><td width="120" height="30"><b>Numero Credito:</b></td><td width="55" height="30">'.$rc->id.'</td>
    </tr>
    <tr>
    <td width="120" height="30"><b>Interes credito:</b></td><td width="400" height="30">'.$rc->interest_amount.' %</td><td width="120" height="30"><b>Forma pago:</b></td><td width="55" height="30">'.$rc->payment_m.'</td>
    </tr>
    <tr>
    <td width="120" height="30"><b>Nro cuotas:</b></td><td width="400" height="30">'.$rc->num_fee.'</td><td width="120" height="30"><b>Fecha credito:</b></td><td width="55" height="30">'.$rc->date.'</td>
    </tr>
    <tr>
    <td width="120" height="30"><b>Monto cuota:</b></td><td width="400" height="30">'.$rc->fee_amount.'</td><td width="120" height="30"><b>Estado credito:</b></td><td width="55" height="30">'.($rc->status ? "Pendiente" : "Cancelado").'</td>
    </tr>
    <tr>
    <td width="120" height="30"><b>Tipo moneda:</b></td><td width="400" height="30">'.$rc->name.'('.$rc->short_name.')</td><td width="120" height="30"><b></b></td><td width="55" height="30"></td>
    </tr>
    </table>';

    $pdf->WriteHTML($html);

    $pdf->Ln(7);
    $pdf->SetFont('Arial','',10);

    $html1 = '';
    $html1 .=                 '<table border="1">
                    <tr>
                    <td width="120" height="30"><b>Nro Cuota</b></td><td width="120" height="30"><b>Fecha pago</b></td><td width="120" height="30"><b>Total pagar</b></td><td width="120" height="30"><b>Estado</b></td>
                    </tr>';

    $loanItems = $this->reports_m->get_reportLI($rc->id);
    foreach ($loanItems as $li) {
      $html1 .= '
                    <tr>
                    <td width="120" height="30">'.$li->num_quota.'</td><td width="120" height="30">'.$li->date.'</td><td width="120" height="30">'.($li->status ? $li->fee_amount : "0.00").'</td><td width="120" height="30">'.($li->status ? "Pendiente" : "Cancelado").'</td>
                    </tr>';
    }

    $html1 .= '</table>';

    $pdf->WriteHTML($html1);

    $pdf->Ln(7);

    }

    $pdf->Output('reporte_global_cliente.pdf', 'I');
  }


  public function general_summary_pdf()
  {
    require_once APPPATH.'third_party/fpdf183/html_table.php';

    $coin_id = $this->input->get('coin_type');
    if (!$coin_id) {
      show_error('Tipo de moneda no especificado.', 400);
    }

    $coin = $this->coins_m->get($coin_id);
    if (!$coin) {
      show_error('Moneda no encontrada.', 404);
    }

    $summary = $this->reports_m->get_reportLoan($coin_id);

    $pdf = new PDF();
    $pdf->AddPage('P', 'A4', 0);
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Ln(7);
    $pdf->Cell(0, 0, 'Resumen de Prestamos - ' . $coin->name . ' (' . strtoupper($coin->short_name) . ')', 0, 1, 'C');
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 10);

    $html = '<table border="0">
    <tr>
    <td width="120" height="30"><b>Tipo de moneda:</b></td><td width="400" height="30">'.$coin->name.' ('.strtoupper($coin->short_name).')</td>
    </tr>
    </table>';

    $pdf->WriteHTML($html);
    $pdf->Ln(7);

    $html1 = '<table border="1">
    <tr>
    <td width="200" height="30"><b>Descripcion Total </b></td><td width="200" height="30"><b>Cantidad</b></td>
    </tr>
    <tr>
    <td width="200" height="30">Credito</td><td width="200" height="30">'.(!empty($summary[0]->sum_credit) ? $summary[0]->sum_credit : 0).'</td>
    </tr>
    <tr>
    <td width="200" height="30">Credito Interes</td><td width="200" height="30">'.(!empty($summary[1]->cr_interest) ? $summary[1]->cr_interest : 0).'</td>
    </tr>
    <tr>
    <td width="200" height="30">Credito cancelado interes</td><td width="200" height="30">'.(!empty($summary[2]->cr_interestPaid) ? $summary[2]->cr_interestPaid : 0).'</td>
    </tr>
    <tr>
    <td width="200" height="30">Credito x cobrar interes</td><td width="200" height="30">'.(!empty($summary[3]->cr_interestPay) ? $summary[3]->cr_interestPay : 0).'</td>
    </tr>
    </table>';

    $pdf->WriteHTML($html1);
    $pdf->Ln(10);

    $pdf->Output('resumen_prestamos_' . strtolower($coin->short_name) . '.pdf', 'I');
  }
}