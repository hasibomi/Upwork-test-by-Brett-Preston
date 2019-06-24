## Installation

To install this project, some prerequisites are needed:

- [Composer](https://getcomposer.org/)
- PHP >= 7.1.3
- [Bower](https://bower.io/)

Clone the repo, make a .env file inside the project folder and modify DB credentials. After that run the following commands:

- composer install
- bower install
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve
