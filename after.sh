#!/bin/sh

mysql -u homestead -e "CREATE USER 'user'@'travel' IDENTIFIED BY 'travel';"
mysql -u homestead -e "GRANT ALL PRIVILEGES ON travel.* TO 'travel'@'localhost';"
mysql -u homestead -e "FLUSH PRIVILEGES;"
