<?php
 // convert from Farenheit to Celsius
// (32°F − 32) × 5/9 = 0°C
/* 
function far2cel($far)
{
    return number_format((($far - 32) * 5 / 9), 2);
}
*/

// convert from Celsius to Farenheit
// cel*9/5+32

/* 
function cel2far($cel)
{
    return number_format(($cel * 9 / 5 + 32), 2);
}

function get_rand_tem()
{
    return mt_rand(-4000, 4000) / 100; //return random floats
} 
*/

require 'includes/functions.php';
// require ('includes/functions.php');

$temp1 = get_rand_tem();
$temp2 = get_rand_tem();
$temp3 = get_rand_tem();


?>
<h1>F to C</h1>
<?php echo $temp1 ?>f is <?php echo far2cel($temp1) ?>c<br>
<?php echo $temp2 ?>f is <?php echo far2cel($temp2) ?>c<br>
<?php echo $temp3 ?>f is <?php echo far2cel($temp3) ?>c<br>

<h1>C to F</h1>
<?= $temp1 ?>c is <?= cel2far($temp1) ?>f<br>
<?= $temp2 ?>c is <?= cel2far($temp2) ?>f<br>
<?= $temp3 ?>c is <?= cel2far($temp3) ?>f<br> 