#!/bin/bash

nginx

# Reload nginx every 10 days
while true;do
    sleep 10d;
    service nginx reload
done