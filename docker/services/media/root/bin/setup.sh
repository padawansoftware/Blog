#!/bin/bash

read -i 'no' -p "This will remove all content under /var/www, are you sure? (yes/NO) " input
if [ ${input:-'no'} = 'yes' ]; then
    rm -R /var/www/*
    chown www-data:www-data -R /var/www

    echo "DONE"
fi