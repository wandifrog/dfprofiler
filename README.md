# Dead Frontier Profiler
The Dead Frontier Profiler is a web application to display Dead Frontier profiles in a nice way. It reads the data from the game servers and displays several things such as profiles, clan info, records, weapons data, etc.

This software is Open Source under the MIT license.

## Tech
This software uses a bunch of other popular and amazing Open Source projects:

* [Phalcon PHP](https://phalconphp.com/en/)
* [Bootstrap](https://getbootstrap.com/docs/3.3/)
* [Yarn](https://yarnpkg.com/en/)
* [Node.js](https://nodejs.org/)
* [jQuery](https://jquery.com/)
* [Sass](http://sass-lang.com/)
* [Composer](https://getcomposer.org/)
* [Gulp](https://gulpjs.com/)

# Requirements
Here's the list of packages you need to have installed in your server. These are also links to the sites where you can find the installation instructions.

* [Apache 2.4](https://httpd.apache.org/download.cgi) (with mod_rewrite)
* [PHP](https://secure.php.net/downloads.php) (with PHP-CLI and MySQL support)
* [MySQL](https://dev.mysql.com/doc/refman/5.7/en/installing.html) or [MariaDB](https://downloads.mariadb.org/)
* [Phalcon PHP Framework](https://phalconphp.com/en/download/linux)
* [Node.js](https://nodejs.org/en/download/)
* [Composer](https://getcomposer.org/download/)
* [Redis](https://redis.io/download)

After we have these packages installed run the following commands from the document root:
```sh
$ npm install -g gulp yarn
$ composer install
$ yarn install
$ yarn build
```
This should download all the other packages needed by the software itself. The last command will build the assets for you.

## Installation
### Database
Create an empty MySQL database.

Example:
```sql
CREATE DATABASE mydatabase;
CREATE USER 'myuser'@'localhost' IDENTIFIED BY 'mypassword';
GRANT ALL PRIVILEGES ON mydatabase.* TO 'myuser'@'localhost';
FLUSH PRIVILEGES;
```
Now we need to tell the software how to connect to our database. Go to `/app/config` and make a copy of `config.default.php` and name it `config.php`. Under `'database'`, set your connection parameters.

Example:
```php
'database' => [
    'adapter'     => 'Mysql',
    'host'        => 'localhost',
    'username'    => 'myuser',
    'password'    => 'mypassword',
    'dbname'      => 'mydatabase',
    'charset'     => 'utf8',
],
```
Then run the database migration, this will create the required database tables for you:
```sh
php phalcon run-migration
```
Read the [official documentation](https://docs.phalconphp.com/en/3.2/db-migrations) about Phalcon PHP migrations.

### Apache
At the time the software only supports the Apache HTTP Server, however it is possible to run it in a different one such as Nginx or Lighttpd.

Make sure you edit this out to fit your particular configuration/environment:
```apache
<VirtualHost *:80>
  ServerAdmin your@email.com
  ServerName www.domain.com
  ServerAlias domain.com

  DocumentRoot /path/to/dfprofiler/public

  <Directory /path/to/dfprofiler/public>
    Options -Indexes +FollowSymLinks
    AllowOverride All
    Require all granted
    DirectoryIndex index.php
  </Directory>

  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
And please note that the `DocumentRoot` must point to `/public/` where the `index.php` file is.

Also, make sure the `/app/cache` folder is writable by the server. This is required for Volt (the templating system) to be able to work.

### Cron Jobs
These are tasks that run at specific times. Install them by running:
```sh
crontab -e
```
Then enter the following lines:
```sh
0 */2 * * * /usr/bin/php /path/to/df/profiler/app/cli.php drlp update profiles >/dev/null 2>&1
0 5 * * 1 /usr/bin/php /path/to/df/profiler/app/cli.php drlp duskwinner ts >/dev/null 2>&1
0 5 * * 1 /usr/bin/php /path/to/df/profiler/app/cli.php drlp duskwinner tpk >/dev/null 2>&1
```
* The first line updated all the profiles. Runs every 2 hours.
* Second one takes the records of the weekly TS winner. Runs weekly.
* The third one does the same as the second one but for the TPK winner.

Make sure you edit the paths to PHP and to the DF Profiler. These tasks are what makes the software run in autopilot mode, so get it right.

## Customization
The source for the SCSS and Javascript is located inside the `/src/` folder.

### Config
Right now, there's only one piece of config you might want to change. It's the
event EXP bonuses. For this, open `app/config/config.php` and look for:
```php
'site' => [
  'event_bonus' => 0,
],
```
This bonus usually changes when there are events for example.

### Yarn commands
The software uses Yarn and Gulp to automate certain tasks, this is the complete list of Yarn commands:

* `yarn build`: Builds all the sources.
* `yarn build-styles`: Build only the styles.
* `yarn build-scripts`: Builds only the javascript.
* `yarn clean-assets`: Removed all compiled files. Useful for troubleshooting.
* `yarn cache-clean`: Deletes all the Volt cache files.
* `yarn watch`: Watches for changes and compiles the styles and javascript.

## Support
The support is provided through this site, just post a bug report and I'll do my best to help you out. DO NOT post questions about how to modify the software to fit your requirements (adding new features for example), you will be ignored.

## Final notes
This is only the source code of the original DRLP Profiler. The database is not included, if you absolutely need the database make sure you contact me at ionize@drlp.net and I will provide you with a copy of it. It has already more than 75,000 registered profiles in it. Do not ask me to release this to the public.
