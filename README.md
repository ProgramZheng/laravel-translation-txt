# laravel-translation-txt
This package provides artisan commands to export language files from and to txt.
## install
Install the package through Composer.
```shell
$ composer require programzheng/laravel-translation-txt
```
If you're not using Laravel >=5.5, add the ServiceProvider to the providers array in config/app.php
```php
ProgramZheng\\LaravelTranslationTxt\\TranslationTxtServiceProvider
```
## usage
The package currently provides one commands:
### Export
```shell
php artisan translationtxt:export en,jp......
```
You have to pass the locale as arguments.
