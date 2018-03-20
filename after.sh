#!/bin/sh

mysql -u homestead -e "CREATE USER 'travel'@'localhost' IDENTIFIED BY 'travel';"
mysql -u homestead -e "GRANT ALL PRIVILEGES ON travel.* TO 'travel'@'localhost';"
mysql -u homestead -e "FLUSH PRIVILEGES;"

cd training
composer install
php bin/console doctrine:schema:update --force
yarn install --no-bin-links
./node_modules/@symfony/webpack-encore/bin/encore.js dev