<?php
$hinlun1='12';
$mininlun1='17';

$output = shell_exec('crontab -r');
$output = shell_exec('crontab -l');
file_put_contents('/tmp/crontab.txt', $mininlun1 . ' ' . $hinlun1 . ' * * 1 /bin/sh /tmp/launch.sh'.PHP_EOL);
file_put_contents('/tmp/crontab.txt', $mininlun1 . ' ' . $hinlun1 . ' * * 1 /bin/sh /tmp/launch2.sh'.PHP_EOL, FILE_APPEND);
file_put_contents('/tmp/crontab.txt', $mininlun1 . ' ' . $hinlun1 . ' * * 1 /bin/sh /tmp/launch3.sh'.PHP_EOL, FILE_APPEND);
echo exec('crontab /tmp/crontab.txt');
echo $mininlun1 . ' ' . $hinlun1;
?>