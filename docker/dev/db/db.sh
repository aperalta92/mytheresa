#!/usr/bin/env bash

mysql --user=root --password=root <<-EOSQL
    CREATE DATABASE IF NOT EXISTS mytheresa;
    GRANT ALL PRIVILEGES ON \`mytheresa%\`.* TO 'root'@'%';
EOSQL
