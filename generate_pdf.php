<?php
require_once 'vendor/setasign/fpdf/fpdf.php'; // Update this line if FPDF is in the root directory
require_once 'classes/Database.php';
require_once 'classes/User.php';


// Create database connection
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Fetch all users
$stmt = $user->readAll();
$userCount = $stmt->rowCount();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'User List', 0, 1, 'C');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'User ID', 1);
$pdf->Cell(60, 10, 'Username', 1);
$pdf->Cell(60, 10, 'Full Name', 1);
$pdf->Cell(60, 10, 'Email', 1);
$pdf->Ln();

// Table content
$pdf->SetFont('Arial', '', 12);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(30, 10, htmlspecialchars($row['USER_ID']), 1);
    $pdf->Cell(60, 10, htmlspecialchars($row['USERNAME']), 1);
    $pdf->Cell(60, 10, htmlspecialchars($row['FULL_NAME']), 1);
    $pdf->Cell(60, 10, htmlspecialchars($row['EMAIL']), 1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('D', 'user_list.pdf'); // 'D' for download
exit();
?>
