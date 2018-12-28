<?php
require('fpdf.php');

class PDF extends FPDF
{

    function MultiCellBltArray($w, $h, $blt_array, $border=0, $align='J', $fill=false)
    {
        if (!is_array($blt_array))
        {
            die('MultiCellBltArray requires an array with the following keys: bullet, margin, text, indent, spacer');
            exit;
        }
                
        //Save x
        $bak_x = $this->x;
        
        for ($i=0; $i<sizeof($blt_array['text']); $i++)
        {
            //Get bullet width including margin
            $blt_width = $this->GetStringWidth($blt_array['bullet'] . $blt_array['margin'])+$this->cMargin*2;
            
            // SetX
            $this->SetX($bak_x);
            
            //Output indent
            if ($blt_array['indent'] > 0)
                $this->Cell($blt_array['indent']);
            
            //Output bullet
            $this->Cell($blt_width, $h, $blt_array['bullet'] . $blt_array['margin'], 0, '', $fill);
            
            //Output text
            $this->MultiCell($w-$blt_width, $h, $blt_array['text'][$i], $border, $align, $fill);
            
            //Insert a spacer between items if not the last item
            if ($i != sizeof($blt_array['text'])-1)
                $this->Ln($blt_array['spacer']);
            
            //Increment bullet if it's a number
            if (is_numeric($blt_array['bullet']))
                $blt_array['bullet']++;
        }
    
        //Restore x
        $this->x = $bak_x;
    }

// Page header
function Header()
{
    
//     $this->AddFont('GEOTIMEB','B','GEOTIMEB.php');
//     $this->AddFont('Georgia','','Georgia.php');

//     $this->SetFont('GEOTIMEB','B',20);

//     $this->Cell(80);
    
//     $this->Cell(30,1,$_POST["fname"],0,2,'C');
//     $this->Ln(5);
//     $this->SetFont('Georgia','',10);
//     $x=sizeof($_POST['boxes']);
// for ($i=0; $i<$x; $i++)
// {
//     $this->Cell(190,4,$_POST["boxes"][$i],0,2,'C');
// }
//     $this->Cell(190,4,"Mobile No: ".$_POST["mno"],0,2,'C');
//     $this->Cell(190,4,"Email ID: ".$_POST["email"],0,2,'C');

//     $this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('Calibri1','B','Calibri_Bold.php');
$pdf->AddFont('Calibri2','','Calibri.php');
$pdf->SetFont('Calibri1','B',26);
$pdf->SetXY(30,11);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(58,11,"Sales Manager",1,1,"L",1);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri1','B',10);
$pdf->SetXY(95,13);
$pdf->Cell(10,0,$_POST["fname"],0,1);
$pdf->SetXY(95,17);
$pdf->Cell(10,0,$_POST["add"],0,1);
$pdf->SetXY(95,21);
$pdf->Cell(10,0,"M: ".$_POST["mno"],0,1);
$pdf->SetXY(130,21);
$pdf->Cell(10,0,"E: ".$_POST["email"],0,1);

$pdf->SetFont('Calibri2','',10);
$pdf->SetXY(29,28);
$pdf->MultiCell(150,5, $_POST["obj"]);

$pdf->Ln(5);
 
 $pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(37,5,"Sales Achievements",1,1,"L",1);

$pdf->Ln(5);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->SetX(30);
$pdf->Cell(45,0,$_POST["j1"],0,0);
$pdf->Cell(37,0,$_POST["d1"],0,0);
$pdf->Cell(37,0,"Sales Target: ".$_POST["t1"],0,0);
$pdf->Cell(37,0,"Sales Achieved: ".$_POST["a1"],0,1);

$pdf->Ln(5);
$pdf->SetX(30);
$pdf->Cell(45,0,$_POST["j2"],0,0);
$pdf->Cell(37,0,$_POST["d2"],0,0);
$pdf->Cell(37,0,"Sales Target: ".$_POST["t2"],0,0);
$pdf->Cell(37,0,"Sales Achieved: ".$_POST["a2"],0,1);

$pdf->Ln(5);
$pdf->SetX(30);
$pdf->Cell(45,0,$_POST["j3"],0,0);
$pdf->Cell(37,0,$_POST["d3"],0,0);
$pdf->Cell(37,0,"Sales Target: ".$_POST["t3"],0,0);
$pdf->Cell(37,0,"Sales Achieved: ".$_POST["a3"],0,1);

$pdf->Ln(5);

$pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(35,5,"Areas of Expertise",1,1,"L",1);

$pdf->Ln(3);

//$pdf->SetX(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$column_width = $pdf->w-30;

$test1 = array();
$test1['bullet'] = chr(149);
$test1['margin'] = ' ';
$test1['indent'] = 0;
$test1['spacer'] = 0;
$test1['text'] = array();
$x1=sizeof($_POST['boxes1']);

for ($i=0; $i<$x1; $i++)
{
    $test1['text'][$i] = $_POST['boxes1'][$i];
}
$pdf->SetX(30);
$pdf->MultiCellBltArray($column_width-$pdf->x,4, $test1);

$pdf->Ln(3);

$pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(30,5,"Carrier History",1,1,"L",1);

$pdf->Ln(5);
$pdf->SetX(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri1','B',10);
$pdf->Cell(30,0,$_POST["p1"],0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->Cell(30,0,$_POST["j11"]."   ".$_POST["d11"],0,1);
$pdf->Ln(5);

$pdf->SetX(30);
$pdf->SetFont('Calibri1','B',10);
$pdf->Cell(30,0,$_POST["p2"],0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->Cell(30,0,$_POST["j12"]."   ".$_POST["d12"],0,1);
$pdf->Ln(5);

$pdf->SetX(30);
$pdf->SetFont('Calibri1','B',10);
$pdf->Cell(30,0,$_POST["p3"],0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->Cell(30,0,$_POST["j13"]."   ".$_POST["d13"],0,1);
$pdf->Ln(5);

$pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(13,5,"Duties",1,1,"L",1);
$pdf->Ln(3);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$column_width = $pdf->w-30;

$pdf->SetTextColor(0,0,0);
$test3 = array();

$test3['bullet'] = chr(149);
$test3['margin'] = ' ';
$test3['indent'] = 0;
$test3['spacer'] = 0;
$test3['text'] = array();
$x2=sizeof($_POST['boxes3']);

for ($i=0; $i<$x2; $i++)
{
    $test3['text'][$i] = $_POST['boxes3'][$i];
}
$pdf->SetX(30);
$pdf->MultiCellBltArray($column_width-$pdf->x,4, $test3);

$pdf->Ln(3);

$pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(48,5,"Key Skills & Competencies",1,1,"L",1);
$pdf->Ln(3);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$column_width = $pdf->w-30;

$pdf->SetTextColor(0,0,0);
$test2 = array();

$test2['bullet'] = chr(149);
$test2['margin'] = ' ';
$test2['indent'] = 0;
$test2['spacer'] = 0;
$test2['text'] = array();
$x2=sizeof($_POST['boxes2']);

for ($i=0; $i<$x2; $i++)
{
    $test2['text'][$i] = $_POST['boxes2'][$i];
}
$pdf->SetX(30);
$pdf->MultiCellBltArray($column_width-$pdf->x,4, $test2);

$pdf->Ln(3);

$pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(45,5,"Academic Qualifications",1,1,"L",1);
$pdf->Ln(5);

$pdf->SetX(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->Cell(30,0,$_POST["u1"],0,1);
$pdf->SetX(90);
$pdf->Cell(30,0,$_POST["c1"],0,1);
$pdf->SetX(170);
$pdf->Cell(30,0,$_POST["d111"],0,1);
$pdf->Ln(5);

$pdf->SetX(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->Cell(30,0,$_POST["u2"],0,1);
$pdf->SetX(90);
$pdf->Cell(30,0,$_POST["c2"],0,1);
$pdf->SetX(170);
$pdf->Cell(30,0,$_POST["d112"],0,1);
$pdf->Ln(5);

$pdf->SetFont('Calibri2','',12);
 $pdf->SetX(30);
 $pdf->SetFillColor(0,0,0);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(22,5,"References",1,0,"L",1);
$pdf->SetX(60);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri2','',10);
$pdf->Cell(25,5,"Availble on request.",0,1,"L",0);


$pdf->Ln(5);


$pdf->Output();
?>