#!/bin/bash

# Install dependencies and run backend assset compiler
echo Installing admin dependencies
npm i --prefix /var/www/admin/symfony

echo Building admin dependencies
npm run build --prefix /var/www/admin/symfony/ &> /var/log/admin-symfony-watch.log

# Install dependencies and run api assset compiler
echo Installing frontend dependencies
npm i --prefix /var/www/frontend/vue

echo Building frontend dependencies
npm run build --prefix /var/www/frontend/vue &> /var/log/frontend-vue-watch.log