<?php

function fetch_data() {

	$output = "";
	$con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
	mysql_select_db ( "epiz_28028131_tirurinfo" , $con );
	$noshop= "No shop";
	$result = mysql_query ( "SELECT * FROM shoptable where shopcategory!='".$noshop."'" );

	while ( $row = mysql_fetch_array ( $result ) ) {
		$output .= '<tr>  
									<td width="5%">'.$row["shop_id"].'</td>  
									<td width="23%">'.$row["shopname"].'</td>  
									<td width="25%">'.$row["shopcategory"].'</td>  
									<td width="25%">'.$row["location"].'</td>  
									<td width="22%">'.$row["mobile"].'</td>  
								</tr>  
		'; 
	}
	return $output;  
}

// Pdf creation
if(isset($_POST["create_pdf"]))  
{  
		require_once('tcpdf/tcpdf.php');  
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage(); 

		$content = '';  
		$content .= '  
			<h1 style="color: red;text-align: center;">TIRUR SHOP DETAILS</h1>
		<table border="1" cellspacing="0" cellpadding="5">  
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="23%">Shop name</th>
				<th width="25%">Shop category</th>
				<th width="25%">Location</th>
				<th width="22%">Phone number</th>
			</tr>
		</thead>
		';  
		$content .= fetch_data();  
		$content .= '</table>';  
		$obj_pdf->writeHTML($content);  
		$obj_pdf->Output('sample.pdf', 'I');  
}

?>