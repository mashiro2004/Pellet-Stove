#!/bin/bash
sed -i -e :a -e '/^\n*$/{$d;N;ba' -e '}' /var/www/html/php/sett/file
