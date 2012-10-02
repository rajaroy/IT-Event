<html>    
<head>    
<basefont face=arial>    
</head>    
   
<body>    
<h3>Pie Chart Generator</h3>    
<table cellspacing="5" cellpadding="5">    
<form action="pie.php" method=POST>    
<tr>    
<td>Enter numeric values (pie segments), separated by commas</td> </tr> <tr> <td><input type=text name=data></td> </tr> <tr> <td><input name="submit" type=submit value="Generate PDF Pie Chart"></td> </tr> </form> </table>    
   
</body>    
</html>

<?php    
// raw data    
$data = $_POST['data'];    
$slices = explode(",", $data);    
   
// initialize some variables    
$sum = 0;    
$degrees = Array();    
$diameter = 200;    
$radius = $diameter/2;    
   
// set up colours array for pie slices (rgb, as percentages of intensity) // add more to these if you like $colours = array(    
 array(0,0,0),      
 array(0,0,1),      
 array(0,1,0),      
 array(1,0,0),    
 array(0,1,1),      
 array(1,1,0),      
 array(1,0,1),      
);    
   
// calculate sum of slices    
$sum = array_sum($slices);    
   
// convert each slice into corresponding percentage of 360-degree circle for ($y=0; $y<sizeof($slices); $y++) {    
 $degrees[$y] = ($slices[$y]/$sum) * 360;    
}    
   
// start building the PDF document    
// create handle for new PDF document    
$pdf = pdf_new();    
   
// open a file    
pdf_open_file($pdf, "chart.pdf");    
   
// start a new page (A4)    
pdf_begin_page($pdf, 500, 500);    
   
// set a stroke colour    
pdf_setcolor($pdf, "stroke", "rgb", 1, 1, 0);    
   
// draw baseline    
pdf_moveto($pdf, 250, 250);    
pdf_lineto($pdf, 350, 250);    
pdf_stroke($pdf);    
   
for ($z=0; $z<sizeof($slices); $z++)    
{    
 // set a fill colour    
 pdf_setcolor($pdf, "fill", "rgb", $colours[$z][0], $colours[$z][1], $colours[$z][2]);    
   
 // calculate coordinate of end-point of each arc by obtaining    
 // length of segment and adding radius    
 // remember that cos() and sin() return value in radians    
 // and have to be converted back to degrees!    
 $end_x = round(250 + ($radius * cos($last_angle*pi()/180)));    
 $end_y = round(250 + ($radius * sin($last_angle*pi()/180)));    
   
 // demarcate slice with line    
 pdf_moveto($pdf, 250, 250);    
 pdf_lineto($pdf, $end_x, $end_y);    
   
 // calculate and draw arc corresponding to each slice    
 pdf_arc($pdf, 250, 250, $radius, $last_angle, ($last_angle+$degrees[$z]));    
   
 // store last angle    
 $last_angle = $last_angle+$degrees[$z];    
   
 // fill slice with colour    
 pdf_fill_stroke($pdf);    
}    
   
// redraw the circle outline    
pdf_circle($pdf, 250, 250, 100);    
pdf_stroke($pdf);    
   
// end page    
pdf_end_page($pdf);    
   
// close and save file    
pdf_close($pdf);    
   
?>