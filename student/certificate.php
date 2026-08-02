<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get student name
$user = mysqli_query($conn,"SELECT * FROM users WHERE id='$user_id'");
$user_data = mysqli_fetch_assoc($user);

// Get total score
$result = mysqli_query($conn,"
SELECT SUM(score) AS total_score
FROM results
WHERE student_id='$user_id'
");

$data = mysqli_fetch_assoc($result);
$total = $data['total_score'];

// Only allow certificate if score >= 80
if($total < 80)
{
    echo "<h2 style='color:red;text-align:center;margin-top:50px;'>
    You need 80+ marks to get certificate
    </h2>";
    exit();
}

require('../lib/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Arial','B',20);
$pdf->Cell(190,20,'Certificate of Achievement',0,1,'C');

// Line break
$pdf->Ln(10);

// Name
$pdf->SetFont('Arial','',16);
$pdf->Cell(190,10,'This is to certify that',0,1,'C');

$pdf->SetFont('Arial','B',18);
$pdf->Cell(190,10,$user_data['name'],0,1,'C');

// Score
$pdf->SetFont('Arial','',16);
$pdf->Cell(190,10,'has successfully completed with score: '.$total,0,1,'C');

// Footer
$pdf->Ln(20);
$pdf->SetFont('Arial','I',12);
$pdf->Cell(190,10,'MathMaster LK Platform',0,1,'C');

$pdf->Output();

?>