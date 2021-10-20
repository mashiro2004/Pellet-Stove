<?php
//$file = "/var/www/html/php/sett/file";
//$lines = file( $file ); 
//echo $lines[9];

$file = file('/var/www/html/php/sett/file');
$lines = array_map(function ($value) { return rtrim($value, PHP_EOL); }, $file);
$lines[3] = '4';
$lines = array_values($lines);
$content = implode(PHP_EOL, $lines);
file_put_contents('/var/www/html/php/sett/file', $content);
?>