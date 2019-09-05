<!DOCTYPE html>
<html>
    <head>
 <title>Quote Of Today</title>
 </head>
 <body>
    <h1>PHP GD</h1>     
<?php
  /**
   * PHP Version 5
   * 
   * Asdfgsadfgdsfgdsg.
   * 
   * @file 
   * Sugmaballs
   * 
   * @category Tag
   * @package  Tag
   * @author   William Smith <will1996@live.com.au>
   * @license  https://www.webcodesniffer.net/report.php lig
   * @version  CVS:1.11 <Sugma>
   * @link     https://www.webcodesniffer.net/report.php sug
   **/
$dbhost   = "localhost";
$dbuser   = "root";
$dbpass   = "usbw";
$db       = "movies";
$font     = "SourceSansPro-Black.ttf";
$fontSize = 16;
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) 
or die("Connect failed: %s\n" . $conn->error);
$sql = "SELECT TimesSearched, Title FROM movies_table
order by TimesSearched desc
limit 10;";
$result = $conn->query($sql);
// create an array of values for the chart  
// tell us how many columns
$columns      = 10;
// set the height and width of the graph image
$width        = 500;
$height       = 300;
// Set the amount of space between each column
$padding      = 50;
// Get the width of 1 column
$column_width = 45;
// set the graph color variables
$im           = imagecreate($width, $height);
$im2          = imagecreate($width, $height);
$gray         = imagecolorallocate($im, 0xcc, 0xcc, 0xcc);
$gray_lite    = imagecolorallocate($im, 0xee, 0xee, 0xee);
$gray_dark    = imagecolorallocate($im, 0x7f, 0x7f, 0x7f);
$white        = imagecolorallocate($im, 0xff, 0xff, 0xff);
$black        = imagecolorallocate($im, 0, 0, 0);
// set the background color of the graph
imagefill($im, 0, 0, $white);
// Calculate the maximum value we are going to plot
$max_value = 25;
// loop over the array of columns
$itemx     = 0 + $padding / 2;
while ($row = mysqli_fetch_array($result)) {
    $value = $row['TimesSearched'];
    $text  = $row['Title'];
    // set the column hieght for each value
    // now the coords
    $x1 = $itemx - $column_width / 2;
    $x2 = $itemx + $column_width / 2;
    $y1 = $height - $value / $max_value * $height;
    $y2 = $height;
    // write the columns over the background
    imagefilledrectangle($im, $x1, $y1, $x2, $y2, $gray);
    //testing method
    /* echo $x1 .", ". $y1 .", " . $x2. ", " .$y2. "a".$i.":".$maxvalues[$i];
    echo "<br>"; */
    // This gives the columns a little 3d effect
    imageline($im, $x1, $y1, $x1, $y2, $gray_lite);
    imageline($im, $x1, $y2, $x2, $y2, $gray_lite);
    imageline($im, $x2, $y1, $x2, $y2, $gray_dark);
    imagestring($im, 5, $x1 + $column_width / 4, 280, $value, $black);
    imagettftext($im, $fontSize, 90, $x1 + $column_width / 4 + 20, 200, 90, $font, $text);
    $itemx += $padding;
}
imagepng($im, "imageout.png");
imagedestroy($im);
echo "<img src='imageout.png'>";
$conn->close();
?>
</body>
         </html>