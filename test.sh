#!/bin/sh
echo "Running unit tests"
docker exec mytheresa php artisan test tests/Unit/src/

