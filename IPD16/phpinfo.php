<?php
error_reporting(0);
//comments
/** 
     * *This comments
     *  Span multiple lines
     */
// phpinfo();
$x = 0; //$x!=$X
$x = true;
echo 'hello world <br>';
echo "$x<br>";

print 'hello world <br>';
print $x . '<br>';

echo 'hello  world<br>' . $x . '<br>';
echo 'hello  world<br>', $x;

echo $name = "zl" . "Wang"; //echo $name=""
$name .= "Student";
echo $naeme;
$speed = "60 mph";
$speed_in_kph = (int)$speed * 1.6; //if $speed = "speed is 60 kpm", casting will give 0
echo $speed_in_kph;
$g = 'F';

echo "hello ($g=='F'? 'Madame':'Sir')"; //cannot work this way
echo "hello " . ($g == 'F' ? 'Madame' : 'Sir');
echo $_SERVER;

?>; 