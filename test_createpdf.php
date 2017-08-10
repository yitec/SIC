 <?              
     require('includes/fpdf.php');
     $pdf=new FPDF(); 
     $pdf->AddPage(); 
     $pdf->SetFont('Arial','B',16); 
     $pdf->Cell(80); 
     $pdf->Cell(40,10,"Informacion de la casa:",0,0,'C'); 
     $pdf->Ln(20); 
     $pdf->Output("C:\AppServ\www\SIC\calidad\archivos\ControlCalidad\informe.pdf",F); 
     //con Output puedes especificar en donde quieres que se almacene 
     //tu pdf 
?>