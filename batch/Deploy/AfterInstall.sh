#!/bin/bash

php artisan clear:cache
#aws s3 cp [送りたいファイル名] s3://[バケット名]/

npm run build
