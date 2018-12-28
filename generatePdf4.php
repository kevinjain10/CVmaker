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
$pdf->AddFont('Arial1','B','Arial_Bold.php');
$pdf->AddFont('Arial2','I','Arial_Italic.php');
$pdf->AddFont('Arial3','BI','Arial_BoldItalic.php');
$pdf->AddFont('Arial','','Arial.php');
$pdf->AddFont('Calibri1','I','Calibri_Italic.php');
$pdf->AddFont('Calibri2','BI','Calibri_BoldItalic.php');

$pdf->SetXY(30,15);
$pdf->SetFont('Arial1','B',28);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(58,11,$_POST['fname'],0,1,"L");

$pdf->Ln(5);
$pdf->SetX(30);

$pdf->SetFont('Arial1','B',9);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(58,8,'PERSONAL PROFILE',0,1,"L");

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(30);
$pdf->MultiCell(100,5, $_POST["pro"]);

$pdf->Ln(5);
$pdf->SetX(30);
$pdf->SetFont('Arial1','B',9);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(58,8,'CAREER HISTORY',0,1,"L");

$pdf->SetFont('Arial3','BI',9);
$pdf->SetTextColor(0,0,0);
$pdf->SetX(30);
$pdf->Cell(58,8,$_POST["j1"]."      ".$_POST["c1"]."      ".$_POST["d1"],0,1,"L");
$pdf->SetX(30);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(100,5, $_POST["p1"]);


$pdf->SetX(30);
$pdf->SetFont('Arial3','BI',9);
$pdf->Cell(58,8,'Duties',0,1,"L");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$column_width = $pdf->w-10;

$test1 = array();
$test1['bullet'] = chr(149);
$test1['margin'] = ' ';
$test1['indent'] = 0;
$test1['spacer'] = 0;
$test1['text'] = array();
$x1=sizeof($_POST['boxes4']);

for ($i=0; $i<$x1; $i++)
{
    $test1['text'][$i] = $_POST['boxes4'][$i];
}
$pdf->SetX(30);
$pdf->MultiCellBltArray($column_width-$pdf->x,4, $test1);

//$pdf->Ln(3);

$pdf->SetX(30);
$pdf->SetFont('Arial3','BI',9);
$pdf->Cell(58,8,'Managerial Skills',0,1,"L");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$column_width = $pdf->w-10;

$pdf->SetTextColor(0,0,0);
$test2 = array();
$test2['bullet'] = chr(149);
$test2['margin'] = ' ';
$test2['indent'] = 0;
$test2['spacer'] = 0;
$test2['text'] = array();
$x2=sizeof($_POST['boxes5']);

for ($i=0; $i<$x2; $i++)
{
    $test2['text'][$i] = $_POST['boxes5'][$i];
}
$pdf->SetX(30);
$pdf->MultiCellBltArray($column_width-$pdf->x,4, $test2);

$pdf->Ln(5);
$pdf->SetX(30);
$pdf->SetFont('Arial1','B',9);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(58,8,'ACADEMIC QUALIFICATIONS',0,1,"L");
$pdf->Ln(3);

$pdf->SetX(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial1','B',9);
$pdf->Cell(30,3,$_POST["u1"],0,1);
$pdf->SetFont('Arial','',9);
$pdf->SetX(30);
$pdf->Cell(30,3,$_POST["c11"]."      ".$_POST["d111"],0,1);
$pdf->Ln(5);

$pdf->SetX(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial1','B',9);
$pdf->Cell(30,3,$_POST["u2"],0,1);
$pdf->SetFont('Arial','',9);
$pdf->SetX(30);
$pdf->Cell(30,3,$_POST["c12"]."      ".$_POST["d112"],0,1);
$pdf->Ln(5);

$pdf->SetX(30);
$pdf->SetFont('Arial1','B',9);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(25,8,'REFERENCES',0,0,"L");
$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(58,8,'Avaliable on request.',0,0,"L");

$pdf->Ln(3);
$pdf->SetFillColor(224,224,224);
$pdf->Rect(150,35, 50,155,'F');

$pdf->SetFont('Calibri2','BI',11);
$pdf->SetXY(150,35);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(50,10,"AREAS OF EXPERTISE",0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri1','I',10);
$column_width = $pdf->w-10;

//$pdf->SetFillColor(0,10,0);
$pdf->SetTextColor(0,0,0);
$test3 = array();
$test3['bullet'] = ' ';
$test3['margin'] = ' ';
$test3['indent'] = 0;
$test3['spacer'] = 0;
$test3['text'] = array();
$x3=sizeof($_POST['boxes1']);

for ($i=0; $i<$x3; $i++)
{
    $test3['text'][$i] = $_POST['boxes1'][$i];
}
$pdf->SetX(150);
$pdf->MultiCellBltArray($column_width-$pdf->x,6, $test3);
$pdf->Ln(5);

$pdf->SetFont('Calibri2','BI',11);
$pdf->SetX(150);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(50,10,"PROFESSIONAL SKILLS",0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri1','I',10);
$column_width = $pdf->w-10;

//$pdf->SetFillColor(0,10,0);
$pdf->SetTextColor(0,0,0);
$test4 = array();
$test4['bullet'] = ' ';
$test4['margin'] = ' ';
$test4['indent'] = 0;
$test4['spacer'] = 0;
$test4['text'] = array();
$x4=sizeof($_POST['boxes2']);

for ($i=0; $i<$x4; $i++)
{
    $test4['text'][$i] = $_POST['boxes2'][$i];
}
$pdf->SetX(150);
$pdf->MultiCellBltArray($column_width-$pdf->x,6, $test4);
$pdf->Ln(5);

$pdf->SetFont('Calibri2','BI',11);
$pdf->SetX(150);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(50,10,"PERSONAL SKILLS",0,1,"C");

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri1','I',10);
$column_width = $pdf->w-10;

//$pdf->SetFillColor(0,10,0);
$pdf->SetTextColor(0,0,0);
$test5 = array();
$test5['bullet'] = ' ';
$test5['margin'] = ' ';
$test5['indent'] = 0;
$test5['spacer'] = 0;
$test5['text'] = array();
$x5=sizeof($_POST['boxes3']);

for ($i=0; $i<$x5; $i++)
{
    $test5['text'][$i] = $_POST['boxes3'][$i];
}
$pdf->SetX(150);
$pdf->MultiCellBltArray($column_width-$pdf->x,6, $test5);
$pdf->Ln(5);

$pdf->SetFont('Calibri2','BI',11);
$pdf->SetX(150);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(50,10,"CONTACT DETAILS",0,1,"C");

$pdf->SetX(150);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri1','I',10);
$pdf->MultiCell(50,5, $_POST["add"]);
$pdf->SetX(127);
$pdf->Cell(0,5,"T :".$_POST["mno"],0,1,"C");
$pdf->SetX(131);
$pdf->Cell(0,5,"E :".$_POST["email"],0,1,"C");

$q=$pdf->GetY();


$pdf->Output();
?>  