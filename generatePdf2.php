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
$pdf->AddFont('Cambria1','B','Cambria_Bold.php');
$pdf->AddFont('Cambria2','','Cambria.php');
$pdf->SetFont('Cambria1','B',20);
// $pdf->SetFont('Cambria2','',20);

//$pdf->Cell(80);


 $pdf->SetFillColor(70,130,180);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell(190,10,$_POST["fname"],0,1,'L',1);
 $pdf->SetFont('Cambria2','',11);
 $pdf->Cell(190,5,$_POST["add"],0,1,'L',1);
 $pdf->Cell(190,5,"Mobile :".$_POST["mno"],0,1,'L',1);
 $pdf->Cell(190,5,"Email :".$_POST["email"],0,1,'L',1);

$pdf->Ln(5);

$pdf->SetFont('Cambria1','B',14);
$pdf->SetFillColor(70,130,180);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190,10,"Objective :      ".$_POST["obj"],0,1,'L',1);

$pdf->Ln(5);

$pdf->SetFont('Cambria1','B',14);
$pdf->SetFillColor(176,196,222);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,10,"Education",0,0,'L',1);

$pdf->Ln(10);

$pdf->SetFont('Cambria1','B',11);
    $pdf->Cell(10,10,$_POST["n1"],0,1);
    $pdf->Ln(-5);
    $pdf->SetFont('Cambria2','',11);
    $pdf->Cell(10,10,"10th Percentage: ".$_POST["n2"],0,1);
    $pdf->Ln(-2);
    $pdf->SetFont('Cambria1','B',11);
    $pdf->Cell(10,10,$_POST["n3"],0,1);
    $pdf->Ln(-5);
    $pdf->SetFont('Cambria2','',11);
    $pdf->Cell(10,10,"12th Percentage: ".$_POST["n4"],0,1);
    $pdf->Ln(-2);
    $pdf->SetFont('Cambria1','B',11);
    $pdf->Cell(10,10,$_POST["n5"],0,1);
    $pdf->Ln(-5);
    $pdf->SetFont('Cambria2','',11);
    $pdf->Cell(10,10,"CPI :".$_POST["n6"],0,1);
    $pdf->Ln(2);

$pdf->SetFont('Cambria1','B',14);
$pdf->SetFillColor(176,196,222);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,10,"Volunteer Work and Internships",0,0,'L',1);

$pdf->Ln(13);

$pdf->SetFont('Cambria2','',11);
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
$pdf->SetX(10);
$pdf->MultiCellBltArray($column_width-$pdf->x, 6, $test1);
$pdf->Ln(2);

$pdf->SetFont('Cambria1','B',14);
$pdf->SetFillColor(176,196,222);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,10,"Academic Achievements and Accolades",0,0,'L',1);

$pdf->Ln(13);

$pdf->SetFont('Cambria2','',11);
$column_width = $pdf->w-30;

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
$pdf->SetX(10);
$pdf->MultiCellBltArray($column_width-$pdf->x, 6, $test2);
$pdf->Ln(2);

$pdf->SetFont('Cambria1','B',14);
$pdf->SetFillColor(176,196,222);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,10,"Activities and Interests",0,0,'L',1);

$pdf->Ln(13);

$pdf->SetFont('Cambria2','',11);
$column_width = $pdf->w-30;

$test3 = array();
$test3['bullet'] = chr(149);
$test3['margin'] = ' ';
$test3['indent'] = 0;
$test3['spacer'] = 0;
$test3['text'] = array();
$x3=sizeof($_POST['boxes3']);

for ($i=0; $i<$x3; $i++)
{
    $test3['text'][$i] = $_POST['boxes3'][$i];
}
$pdf->SetX(10);
$pdf->MultiCellBltArray($column_width-$pdf->x, 6, $test3);
$pdf->Ln(2);


$pdf->Output();
?>