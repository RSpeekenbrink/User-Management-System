#!/usr/bin/env bash

# Updating packages
apt-get update
apt-get install -y software-properties-common python-software-properties git curl
add-apt-repository -y ppa:ondrej/php
apt-get update

# ---------------------------------------
#          Apache/PHP Setup
# ---------------------------------------
apt-get install -y apache2 php7.2 php7.2-cli php7.2-common
apt-get install -y php7.2-mysql php7.2-bcmath php7.2-bz2 php7.2-curl php7.2-intl php7.2-json php7.2-mbstring php7.2-opcache php7.2-soap php7.2-sqlite3 php7.2-xml php7.2-xsl php7.2-zip libapache2-mod-php7.2

echo "<VirtualHost *:80>
    DocumentRoot /var/www/public
    AllowEncodedSlashes On
    <Directory /var/www/public>
        Options +Indexes +FollowSymLinks
        DirectoryIndex index.php index.html
        Order allow,deny
        Allow from all
        AllowOverride All
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

a2enmod rewrite
phpenmod pdo_mysql

service apache2 restart

if [ -e /usr/local/bin/composer ]; then
    /usr/local/bin/composer self-update
else
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

# Reset home directory of vagrant user
if ! grep -q "cd /var/www" /home/ubuntu/.profile; then
    echo "cd /var/www" >> /home/ubuntu/.profile
fi
echo "** [PHP] Run the following command to install dependencies, if you have not already:"
echo "    vagrant ssh -c 'composer install'"
echo "** [PHP] Visit http://localhost:8080 in your browser to view the application **"

# ---------------------------------------
#          MySQL Setup
# ---------------------------------------

# Setting MySQL root user password root/root
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

# Installing packages
apt-get install -y mysql-server mysql-client

# Allow External Connections on your MySQL Service
sudo sed -i -e 's/bind-addres/#bind-address/g' /etc/mysql/my.cnf
sudo sed -i -e 's/bind-addres/#bind-address/g' /etc/mysql/mysql.cnf
sudo sed -i -e 's/skip-external-locking/#skip-external-locking/g' /etc/mysql/my.cnf
mysql -u root -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root'; FLUSH privileges;"
sudo service mysql restart

# create fresh database
mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS ums;"
mysql -u root -proot ums < "/var/www/database.sql"
