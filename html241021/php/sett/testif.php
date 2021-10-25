<?php



if ($reviniziol1 == '') {
   $lines[1] = '#1 - Lunedi Inizio';
} else {
   $lines[1] = $reviniziol1 . ' * * 1 /bin/sh /tmp/launch.sh';
}

echo $lines[1];
?>