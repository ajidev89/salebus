<?php
require("fpdf/fpdf.php");
include('../config/sessions.php');
include('../config/dbconn.php');
$sql = "SELECT * FROM storeinfo";
$result = mysqli_query($conn,$sql);
$storeInfo = mysqli_fetch_assoc($result);
$storeName = $storeInfo['storeName'];
$storeAddress = $storeInfo['storeAddress'];
$storeEmail = $storeInfo['email'];
$storePhone = $storeInfo['phone'];
$logo = '../'.$storeInfo['logo'];
$sumprices = 0;
if (isset($_GET['id'])) {
   	$id = mysqli_real_escape_string($conn, $_GET['id']);
   	$username = mysqli_real_escape_string($conn,$username);

   //make sql
   	$sql = "SELECT * FROM sp_transaction WHERE id = $id ";
   	$result = mysqli_query($conn,$sql);
   	$transaction = mysqli_fetch_assoc($result);
   	if (empty($transaction)) {
   	 header("Location: ../404.php");
    echo "$nopro";
   	}else{
    $transactionDate =  date('F j, Y g:i A',strtotime($transaction['transtime']));
    $transactionid = $transaction['invoiceid'];
    $transactionName = $transaction['customerName'];
    $transactionPhone = $transaction['customerPhone'];
    $totalprice = number_format($transaction['prices']);
    $products = json_decode($transaction['products'],true);
    $a = "₦";


//A4 width:219mm


$pdf = new FPDF('P','mm',array(70,90));
$pdf->AddPage();
class PDF extends FPDF
{
    function Footer(){
        //Got to 1.5
        $this-> SetY(-15);
        $pdf->Setfont('Roboto',"",5,'C');
        $pdf->cell(17,5,"",0,1,);
        $pdf->cell(0,3,"Built by Renov Services",0,1,'C');
        $pdf->cell(0,3,"Vist our website https://renovservices.net/",0,1,'C');
        $pdf-> output();

    }
}
$pdf->AddFont('Roboto','','Roboto-Regular.php');
$pdf->Setfont('Roboto','',6);
$pdf->cell(0,3,"",0,1,'C',$pdf->Image($logo,10,10,10));
$pdf->cell(0,3,"$storeName",0,1,'C');
$pdf->cell(0,3,"$storeAddress",0,1,'C');
$pdf->cell(0,3,"$storeEmail, $storePhone",0,1,'C');
$pdf->cell(0,4,"",0,1,'C');
$pdf->cell(0,3,"Date: $transactionDate",0,1,);
$pdf->cell(0,3,"Invoice: 0$transactionid",0,0,);

$pdf->Setfont('Roboto',"",6);
$pdf->cell(130,3,"",0,1,);

$pdf->Setfont('Roboto',"",6);
$pdf->cell(25,3,"Customer ID: $transactionName",0,0,);
$pdf->cell(0,3,"Seller ID: $username",0,1,);
$pdf->cell(60,3,"Phone: $transactionPhone",0,1,);

$pdf->cell(130,3,"",0,1,);

$pdf->Setfont('Roboto',"",6);
$pdf->cell(10,4,"Quantity",1,0,'C');
$pdf->cell(32,4,"Description",1,0,'C');
$pdf->cell(10,4,"Amount",1,1,'C');
foreach ($products as $product){
$sumprices = $sumprices + intval($product['price']);
//$newproducts = $newproducts. "<br>".$product ;
$pdf->Setfont('Roboto',"",6);
$pdf->cell(10,5,$product['productQty'],1,0,'C');
$pdf->cell(32,5,$product['productName'],1,0,'C');
$pdf->cell(10,5, number_format($product['price']),1,1,'C');
}

$pdf->Setfont('Roboto',"",6);
$pdf->cell(10,5,"-",1,0,'C');
$pdf->cell(32,5,"Discount",1,0,'C');
$discount = intval($sumprices) * (intval($transaction['discount'])/100);
$pdf->cell(10,5,"- $discount",1,1,'C');

$pdf->Setfont('Roboto',"",6);
$pdf->cell(10,5,"",0,0,);
$pdf->cell(32,5,"Total",1,0,'C');
$pdf->cell(10,5,"$totalprice",1,1,'C');

$pdf-> output();
//$pdf-> output('D','invoice-'.$transactionid.'.pdf');
}
}else{
	header('Location: transaction.php');
}

?>
