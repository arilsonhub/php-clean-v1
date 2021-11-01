#!/usr/bin/env bash

cp .env.example .env
composer install
sed -i "s/Listen 80/Listen ${PORT:-4000}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT:-4000}/g" /etc/apache2/sites-enabled/*
apache2-foreground