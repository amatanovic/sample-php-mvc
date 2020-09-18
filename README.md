# Social Network MVC app

* Place the following line in /etc/hosts
```
127.0.0.1 social-network.loc
```
* Login to docker container as root
```
./hooli console -root
```
* Create file social-academy.loc.conf in /etc/apache2/sites-available/
* Place this content in it and save it:

```
<VirtualHost *:80>
    ServerName  social-network.loc
    Serveralias www.social-network.loc
    DocumentRoot /var/www/mvc/pub
    <Directory "/var/www/mvc/pub/">
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
    <FilesMatch \.php$>
		SetHandler "proxy:unix:/run/php/php-fpm.sock|fcgi://social-network.loc/"
	</FilesMatch>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
* Execute the following command
```
a2ensite social-academy.loc.conf
```
* Exit docker container and execute
```
./hooli stop && ./hooli start
```
* Open [social-network.loc](http://social-network.loc) in browser
