<?php
$prov = array('Ontaria', 'Quebec', 'Nova Scotia', 'New Brunswick', 'Manitoba', 'British Columbia', 'Prince Edward Island', 'Saskatchewan', 'Alberta', 'Newfoundland and Labrador');

for ($i = 0; $i < count($prov); $i++) {
    echo $prov[$i] . '<br>';
}
echo '<br>';
foreach ($prov as $each) {
    echo $each . ', ';
}
echo '<br><br>';
print_r($prov);
echo 'br';
// printf("this is a good array %s",$prov); //! cannot format the whole array
//result: //* this is a good array Array;

echo implode(', ', $prov) . '<br><br>';

$capital = array('Toronto', 'Quebec', 'Halifax', 'Frederiction', 'Winnipeg', 'Vitoria', 'Charlotte town', 'Regina', 'Edmonton', "St. John's");

for ($i = 0; $i < count($prov); $i++) {
    $canada[$prov[$i]] = $capital[$i];
} //!functional scope, not block scope
echo '<pre>';
print_r($canada);
echo '</pre>';
echo '<br><br>' . $i . '<br><br>'; //!$i=10
foreach ($canada as $p => $c) {
    echo "$p's capital is: $c, <br>";
};

$geo=array_combine($prov,$capital);
echo '<pre>uisng one function: <br>';
print_r($geo);
echo '</pre>';
?>
<!-- ; used for auto-format, other wise ?> will be deleted--> 