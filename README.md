# WWM Laravel Admin

This admin package provides a qucik start to Laravel projects its using <b>Laravel 6.* LTS version</b>.

This package formerly known as <b>Laflux platform</b> its built on Laravel 5.3 , this can be considered as upgrade to the Laflux platform as well, but not all the packages just admin module only. 

This package provide a permission manager as well  for FREE.

## Features

* Admin Module with separate Auth Guard so you can manage front and back end session separately.

* Access controll logic is included

* User Management

* Groups/Roles Management

* Basic Site Profile and Meta data details


### Prerequisites

PHP and Laravel Knowledge

### Installing

1.) Download the zip and extract it to a directory or Clone/Fork the repository to a directory.

2.) Create a databse and give the credentials in the .env file existing in the root directory.

3.) Run the following commands from the terminal in the root directory of the project.



Migrations and Seeders initializations
```
composer install
php artisan migrate
php artisan db:seed
composer dumpautoload -o
```
### Permissions

Uploading profile and site logo you may need to set write permission for 
 `public/packages/extensionsvalley/dashboard/images/` folder


### Login Credentials

`yourdomain.com/admin` or `localhost/folder/public/admin`

admin@wwm.com, Password : 123456.

Once you login top right corner click on the name choose Access permission -> select the Super admin and set all permission.
Yep done :)

### Deployment

You can deploy this laravel admin template anywhere.

### Built With

* [LARAVEL](https://laravel.com/) - The web framework used
* [COMPOSER](https://getcomposer.org/) - Dependency Management

## Author

[Jobin Jose](https://github.com/Jobinjose01)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details





