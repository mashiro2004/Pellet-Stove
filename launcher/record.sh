#!/bin/sh
cd /var/www/launcher/
./php_root
sleep .5
python3 /var/www/launcher/crop.py /var/www/html/img/stato.jpg 250 360 300 155
tesseract /var/www/html/img/statocr.jpg /var/www/html/img/out.txt -l eng --oem 1 --psm 8
while read line; do onoff=$line; done < /var/www/html/img/out.txt.txt

if [ "$onoff" = "of" ]; then
    echo "10" > /var/www/html/php/num.php
else
    echo "100" > /var/www/html/php/num.php
fi
