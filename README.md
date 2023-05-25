# How-to create project

## Initial system required software (Linux - Ubuntu/Debian Supported Only)

```bash
sudo apt install git  
sudo apt install curl  
sudo apt install gettext  
sudo apt install nginx mysql-server mysql-client mysql-common php7.0 php7.0-fpm redis-server  
sudo apt install php-bcmath php-curl php-mbstring php-mcrypt php-mysqlnd php-xml php-geoip php-redis
sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
sudo apt-get install -y nodejs
sudo npm install -g pnpm
sudo apt install composer
sudo apt install ruby-sass  
```

## Generate wordpress salt

This command is executed in create-project in post installation oprocess by default:

```bash
echo "<?php" > roots/content/wp-salt.php && wget https://api.wordpress.org/secret-key/1.1/salt/ -O - >> roots/content/wp-salt.php  
```

## Database setup

### Create Database

```bash
echo "CREATE DATABASE wlcdatabase;" | mysql -u root -p
```

### Create database user with privileges

```bash
echo "CREATE USER 'wlcdbuser'@'localhost' IDENTIFIED BY 'wlcdbpass';" | mysql -u root -p  
echo "GRANT ALL PRIVILEGES ON *.* TO 'wlcdbuser'@'localhost';" | mysql -u root -p  
echo "FLUSH PRIVILEGES;" | mysql -u root -p  
```

### Import initial database schema

```bash
cat vendor/egamings/wlc_core/db/schema.sql | mysql -u wlcdbuser -pwlcdbpass wlcdatabase
```

## Local environment configuration

Your local domain must be at 3 level: **devlo.some.lan**
roots/siteconfig_local.php  

### Configuring local parameters

```php
$cfg['fundistTidPrefix'] = 'dev-name'; //Unique developer prefix for your project  
$_SERVER['REMOTE_ADDR'] = '8.8.8.8'; // Real world IP - if your location is in private network  
```

### Mail setup

config/backend/4.mail.config.php

```php
$cfg['smtpMailName'] = 'your.real@domain.com';  
$cfg['smtpMailPort'] = '587';  
$cfg['smtpMailHost'] = 'smtp.gmail.com';  
$cfg['smtpMailPass'] = 'your-password';  
$cfg['smtpMailFrom'] = 'WLC Demo Project';  
$cfg['smtpSecurity'] = 'tls';  
```

## Development

### Private repository setup

Set npm authentication for @egamings private repo  

```bash
npm config set registry https://binrepo.egamings.com/repository/ npm-public/
npm config set always-auth true
npm adduser
```

N.B. login/pass provided during project creation by egamings team

### NPM components

To install dependencies

```bash
npm install
```

To update dependencies

```bash
rm -rf package-lock.json node_modules
npm install
```

### Gulp tasks

Development task - build all dependencies and watch for file changes:

```bash
npm run dev
```

Production task - build all dependencies in production mode:

```bash
npm run dist
```

Create translations files for available languages:

```bash
npm run gulp messages
```

Update project configs:

```bash
npm run gulp update:configs
```

### Rename in package.json ang composer.json

Specify the correct values for the following items:
package.json:

- name
- title
- description

composer.json:

- name
- description

### WLC Development - Essentials

Create project structure:

- node_modules - *libraries downloaded from npm*
- vendor - *backend libraries*
- wlc-engine - *symlink to ./node_modules/@egamings/wlc-engine/*
- config
  - backend
  - frontend
- src
  - custom - *custom components folder*
  - app-styles - *scss styles*
  - languages - *translations*
- roots
  - content - *WordPress folder*
  - favicon - *favicon files*
  - plugins - *wlc_core custom handler*
  - static - *html/images/etc... static content*

After composer components install link needed dependency directly:
wlc_core:

```bash
cd vendor/egamings && rm -Rf wlc_core && ln -s ../../../wlc_core
```

Create development branch for wlc-engine or wlc_core and run gulp task

```bash
npm run dev
```

This task will monitor all changes in npm/composer dependencies and creates symbolic links automatically for wlc-engine.

N.B. if you use mounted partition - run this task directly on server due network highload on inotify process (file changes montioring).
