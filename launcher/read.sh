#!/bin/bash  
while read line; do onoff=$line; done < /var/www/html/img/out.txt.txt

if [ "$onoff" = "of" ]; then
    echo "10" > /var/www/html/php/num.php
else
    echo "100"
fi
