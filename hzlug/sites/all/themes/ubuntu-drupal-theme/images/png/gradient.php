<?php
// $Id$
header("Content-type: image/png");

/* 
 * @file Background Gradient Image generator
 *
 * This file create a background gradient image using the gd library. It will return
 * the image directly and save it on the server for the next time. It will not
 * generate the same image twice.
 *
 * I used small portions of code from two web sites:
 * @see http://www.hawkee.com/snippet/5022/
 * @see http://ca.php.net/imagecolorresolve
 *
 * @author David Giard (swe3tdave)
 *
 * @param start Starting Color
 * @param end End Color
 *
 * @return Generated or Cached Image
 *
 * @note
 * Use it as you would a normal image, like this:
 * <img src="gradient.php?start=796646&end=D3CAAA">
 * Or inside a css file:
 * background-image: url(gradient.php?start=796646&end=D3CAAA);
 */

$height = 520;
$width = 1;
$default_background = "background.png";
$default_start_color = '796646';
$default_end_color = 'D3CAAA';
$default_image_path = ''; // Default to script directory

/*
 * Changing those will change how the gradient curve is generated. So you can try
 * changing them and see what appends. Here are the default setting in case you
 * want to change back :
 * 
 * $gradient_start = 65;
 * $gradient_curve = 1.1;
 * $gradient_sum = 800 / $gradient_curve;
 */
$gradient_start = 65;
$gradient_curve = 1.1;
$gradient_sum = 800 / $gradient_curve;

/**************************************************************************************
 * You shoudn't modify anything behond this point, unless you know what you're doing. *
 **************************************************************************************/

$start = $default_start_color;
$end = $default_end_color;
if ($_GET["start"]) {
  $start = $_GET["start"];
}
if ($_GET["end"]) {
  $end = $_GET["end"];
}

function _myexactcolor($png, $r, $g, $b) {
  $mycolor = imagecolorexact($png, $r, $g, $b);
  if ($mycolor == -1){
    $mycolor = imagecolorallocate($png, $r, $g, $b);
  }
  if ($mycolor == -1){
    $mycolor = imagecolorresolve($png, $r, $g, $b);
    #error_log("Damn!  STILL couldn't allocate the color!", 0);
  }
  return $mycolor;
}

function _createnewpng() {
 global $start, $end, $width, $height, $gradient_curve, $gradient_start, $gradient_sum, $default_image_path;

 if (!file_exists($default_image_path . $start . "-" . $end . ".png")) {
  $start_r = hexdec(substr($start, 0, 2));
  $start_g = hexdec(substr($start, 2, 2));
  $start_b = hexdec(substr($start, 4, 2));
  $end_r = hexdec(substr($end, 0, 2));
  $end_g = hexdec(substr($end, 2, 2));
  $end_b = hexdec(substr($end, 4, 2));
  $image = imagecreate($width, $height);

  $gradient_curve = $gradient_curve + ($start_r*(0.5/121));

  for($i=0;$i<250;$i++) {
     $colorset[$i] = _myexactcolor($image, $start_r + ($i*(($end_r-$start_r)/250)), $start_g + ($i*(($end_g-$start_g)/250)), $start_b + ($i*(($end_b-$start_b)/250)));
  }
  for($y=0;$y<$height;$y++) {
    for($x=0;$x<$width;$x++) {

      if ($y<=$gradient_start) {
        imagesetpixel ($image, $x, $y, $colorset[0] );
      }
      else {
        imagesetpixel ($image, $x, $y, $colorset[(int)(((pow($y - $gradient_start, ($gradient_sum / ($y- $gradient_start))) * 250 * pow($height - $gradient_start, 0 - ($gradient_sum / ($y- $gradient_start)))) + (pow($y - $gradient_start, $gradient_curve)* 250 *pow($height - $gradient_start, 0-$gradient_curve)))/2)] );
      }
    }
  }
 
  imagepng($image,$default_image_path . $start . "-" . $end . ".png");
  imagepng($image);
  imagedestroy($image);
 }
 else {
 $h = fopen($default_image_path . $start . "-" . $end . ".png", "r");
 fpassthru($h);
 fclose($h);
 }
}


if ($start != $default_start_color || $end != $default_end_color) {
  _createnewpng();
}
else {
  if (file_exists($default_image_path . $default_background)) {
     $h = fopen($default_image_path . $default_background, "r");
     fpassthru($h);
     fclose($h);
  }
  else {
    _createnewpng();
  }
}

?>