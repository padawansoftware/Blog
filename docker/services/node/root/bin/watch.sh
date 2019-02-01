#!/bin/bash

# Run npm watcher
npm run watch --prefix /var/www/admin/symfony/ &> /var/log/admin-symfony-watch.log &
npm run watch --prefix /var/www/frontend/vue &> /var/log/frontend-vue-watch.log &

tail -f /dev/null