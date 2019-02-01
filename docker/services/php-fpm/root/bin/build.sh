#!/bin/bash

# Install dependencies in admin
composer install -d /var/www/admin/symfony

# Install dependencies in api
composer install -d /var/www/api/symfony