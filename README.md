# River - Application framework for Laravel

## Install;

`composer require rashidul/river:dev-master`

`php artisan migrate`

`php artisan river:seed`

`php artisan river:cache-views`

To publish the assets(css, js files) into the public
directory, run:

`php artisan vendor:publish --tag=river-assets --force`


Run the project: `php artisan serve`

Open admin panel: `localhost:8000/admin/login`

email: admin@gmail.com
password: 1234


### Errors

Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes ==> Fix: https://stackoverflow.com/a/42245921

Base table or view already exists: 105 ==> run `php artisan migrate:fresh`

