<?php
require("fpdf/fpdf.php");
include('../config/sessions.php');
include('../config/dbconn.php');

if (isset($_GET['startdate']) || isset($_GET['enddate']) ) {
   	$startdate = mysqli_real_escape_string($conn, $_GET['startdate']);
    $enddate = mysqli_real_escape_string($conn, $_GET['enddate']); 
    $sql = "SELECT * FROM storeinfo";
    $result = mysqli_query($conn,$sql);
    $storeInfo = mysqli_fetch_assoc($result);
    $storeName = $storeInfo['storeName'];
    $storeAddress = $storeInfo['storeAddress'];
    $storeEmail = $storeInfo['email'];
    $storePhone = $storeInfo['phone'];
    //make sql
   	$sql = "SELECT * FROM sp_transaction WHERE CAST(transtime as DATE) >= '$startdate' AND CAST(transtime as DATE) <= '$enddate' ";
   	$result = mysqli_query($conn,$sql);
   	$transactions = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //print_r($transactions);

//A4 width:219mm
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->AddFont('Roboto','','Roboto-Regular.php');
$pdf->Setfont('Roboto','',10);
$pdf->cell(0,5,"$storeName",0,1,'C');
$pdf->cell(0,5,"$storeAddress",0,1,'C');
$pdf->cell(0,5,"$storeEmail, $storePhone",0,1,'C');


$pdf->Setfont('Roboto',"",6);
$pdf->cell(0,5,"Transaction Report from ".date('F j, Y',strtotime($startdate))." to ".date('F j, Y',strtotime($enddate)),0,1,'C');
$pdf->cell(130,3,"",0,1,);

$pdf->Setfont('Roboto',"",10);
$pdf->cell(10,10,"S/N",1,0,'C');
$pdf->cell(30,10,"Customer Name",1,0,'C');
$pdf->cell(30,10,"Phone Number",1,0,'C');
$pdf->cell(30,10,"Amount(NGN)",1,0,'C');
$pdf->cell(60,10,"Product bought",1,0,'C');
$pdf->cell(30,10,"Seller ID",1,1,'C');

if (empty($transactions)) {
    $pdf->cell(0,8,"No transactions made",1,1,'C');
}else{

foreach ($transactions as $key => $transaction){
$pdf->Setfont('Roboto',"",10);
$pdf->cell(10,8,$key+1 ,1,0,'C');
$pdf->cell(30,8,$transaction['customerName'],1,0,'C');
$pdf->cell(30,8,$transaction['customerPhone'],1,0,'C');
$pdf->cell(30,8,number_format($transaction['prices']),1,0,'C');
$products = json_decode($transaction['products'],true);
$cellpr = "";
foreach($products as $product){
    $cellpr = $cellpr.$product['productName'].",";
}
$pdf->cell(60,8,$cellpr,1,0,'C');

$pdf->cell(30,8,$transaction['userid'],1,1,'C');
}
}
$pdf->Setfont('Roboto',"",10);
$pdf->cell(10,10,"S/N",1,0,'C');
$pdf->cell(30,10,"Customer Name",1,0,'C');
$pdf->cell(30,10,"Phone Number",1,0,'C');
$pdf->cell(30,10,"Amount(NGN)",1,0,'C');
$pdf->cell(60,10,"Product bought",1,0,'C');
$pdf->cell(30,10,"Seller ID",1,1,'C');


$pdf-> output();

}else{
	header('Location: transaction.php');
}

?>
<head>
<link href="../img/favicon.ico" rel="icon">
</head>