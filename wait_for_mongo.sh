#!/bin/bash

sleep 10
php artisan queue:work --sleep=3 --tries=3