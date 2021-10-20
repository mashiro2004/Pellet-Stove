<?php
$num = file_get_contents('http://172.24.131.52/php/num.php');
if ($num < 50) {
    echo 'Sotto i 50:';
	echo $num;
} else {
    echo 'Sopra i 50:' ;
	echo $num;
}


?>
