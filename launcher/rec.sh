#!/bin/sh
cd /var/www/launcher/
./php_root
sleep .5
cd /var/www/html/img/ 
python3 crop.py stato.jpg 250 363 300 160
tesseract out.txt -l eng --oem 1 --psm 13