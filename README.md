# User Management System
A User Management System Made in PHP Without use of any frameworks. This was made to test knowledge on base PHP and to understand PHP deeper. This project exists out of a small MVC framework (self build) using the [Front Controller Design Pattern](https://en.wikipedia.org/wiki/Front_controller).

## Requirements
In order to run this system you need to have [Composer](https://getcomposer.org/) and a [MySQL database](https://www.mysql.com/) installed aswell as a running PHP environment with the [PDO mysql php extension](https://www.php.net/manual/en/book.pdo.php) running PHP 7.2+.

## Installation

First install the dependencies and generate the autoloader by executing

```
composer install
```

in the application's root directory. Then import the database.sql file into your database and configure your database credentials in `config.php`. Once that is setup you can start the application by pointing your PHP environment to the application's public folder.

## About

This project was made to challenge myself on base knowledge of PHP and is in no way intended to be used on a production environment. First of all the way password resetting was chosen is not a secure way to do it but it didn't require to set up a mail server and opened up some new challenges. The Router is not 100% perfect too, it's missing some features aswell as checking/providing CSRF tokens against Cross Site Request Forgeries. I will try however to update and improve this project over time making it a lightweight ums without any dependencies but still open for extension.

Using no frameworks was done intentionally to test myself on PHP knowledge and perform all the 'heavy tasks' manually. 

The dependencies that are delivered are just for debugging/testing purposes and are not required for a 'production' environment.

The autoloader got generated via composer. I can make one myself but this is just a way easier solution also for if more debug/testing packages may be added.

## Usage

You can register as new user and then login. When no security question has been set you will be asked to set one. You can always change your data/security question by clicking on your name after logging in. The remember token will be set when checked on login and will be valid for 7 days (set by cookie lifetime). On logout the remember token will be removed. To get into the 'admin dashboard' you will have to make yourself admin by changing admin to 1 in the database.

## Testing

After installing the composer dev requirements the application can be tested by executing the following command from the project root directory:

```
vendor/bin/phpunit
```

## TODO

- Global error catching (without whoops, just show a 500 page)
- CSRF Token Implementation
- Make it possible for admins to assign other admins via the dashboard
- JSON Responses
- Make Error Bags to return errors to views easier
- Make URL variables ('/edit/{var}')
- Parse Request Variables into Variable Bags for easier access
- Make Validation class for easier Validation of Variables
- New Features? (I can go on forever, Really)

## Screenshots

![Screenshot of Login](/docs/screenshot_1.png)

![Screenshot of Login](/docs/screenshot_2.png)

![Screenshot of Login](/docs/screenshot_3.png)