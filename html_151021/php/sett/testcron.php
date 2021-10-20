<?php
shell_exec('crontab -l > /var/www/html/php/sett/file');
shell_exec('echo "\n" >> /var/www/html/php/sett/file');
$file = file('/var/www/html/php/sett/file');
$lines = array_map(function ($value) { return rtrim($value, PHP_EOL); }, $file);
$lines[1] = '#12 12 * * * /bin/sh /tmp/launch2.sh';
$lines[2] = '#12 12 * * * /bin/sh /tmp/launch3.sh';
$lines = array_values($lines);
$content = implode(PHP_EOL, $lines);
file_put_contents('/var/www/html/php/sett/file', $content);
echo exec('crontab /var/www/html/php/sett/file');
#shell_exec('rm -rf /tmp/file');

?>


