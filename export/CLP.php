<?php
include_once "../database.php";
include_once "../fungsi.php";
include_once "fpdf16/fpdf.php";
$id_process = $_REQUEST['id_process'];

// Object database class
$db_object = new database();

$sql_que = "SELECT
            conf.*, log.start_date, log.end_date
            FROM
             confidence conf, process_log log
            WHERE conf.id_process = '$id_process' "
            . " AND conf.id_process = log.id "
            . " AND conf.lolos=1 "
            . " ORDER BY conf.from_itemset DESC";

$db_query = $db_object->db_query($sql_que) or die("Query gagal");

// Variable for iteration
$i = 0;
// Fetching data from database query
while ($data = $db_object->db_fetch_array($db_query)) {
    $confidence = $data['confidence'];
    $package = '';
    if ($confidence >= 75) {
        $package = 'A';
    } elseif ($confidence >= 50) {
        $package = 'B';
    } else {
        $package = 'C';
    }
    $cell[$i][0] = price_format($confidence);
    $cell[$i][1] = "Jika membeli " . $data['kombinasi1'] . ", maka juga akan membeli " . $data['kombinasi2'];
    $cell[$i][2] = $package;
    $i++;
}

// Starting PDF output settings
class PDF extends FPDF {

    // Header page settings
    function Header() {
        // Font settings for Header
        $this->SetFont('Times', 'B', 14); // Font type: Times New Roman, Bold, size 14
        // Background color for Header
        $this->SetFillColor(255, 255, 255);
        // Text color
        $this->SetTextColor(0, 0, 0);
    }
}

// Page settings P = Portrait
$pdf = new PDF('L', 'cm', 'A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 12);
// Ln() = to move to the next line
$pdf->Cell(28, 1, 'Laporan Hasil Analisa Mart Baiturrahman', 'LRTB', 0, 'C');
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(1, 1, 'No.', 'LRTB', 0, 'C');
$pdf->Cell(20, 1, 'Rule', 'LRTB', 0, 'C');
$pdf->Cell(3, 1, 'Confidence', 'LRTB', 0, 'C');
$pdf->Cell(4, 1, 'Paket', 'LRTB', 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times', "", 10);
for ($j = 0; $j < $i; $j++) {
    // Displaying data from database query results
    $pdf->Cell(1, 1, $j + 1, 'LBTR', 0, 'C');
    $pdf->Cell(20, 1, $cell[$j][1], 'LBTR', 0, 'L');
    $pdf->Cell(3, 1, $cell[$j][0], 'LBTR', 0, 'C');
    $pdf->Cell(4, 1, $cell[$j][2], 'LBTR', 0, 'C');
    $pdf->Ln();
}

// Displaying output as a PDF page
$pdf->Output();
?>