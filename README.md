### Install via Composer
============================

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
git clone https://github.com/YefimovArtem/LinkShortener-yii2.git
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd LinkShortener-yii2
composer install
~~~

GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize the installed application. You only need to do these once for all.

* Create a new database
* Edit the file `config/db.php` with real data, for example:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=***HOST***;dbname=***DB NAME***',
    'username' => '***USER NAME***',
    'password' => '***PASSWORD***',
    'charset' => 'utf8',
];
```
* Apply migrations with console command `yii migrate` or `php yii migrate`. This will create tables needed for the application to work.
* Create a domain and configure it to the folder LinkShortener-yii2/web

Now you can then access the application through the following URL:
~~~
http://YOUR_DOMAIN/
~~~



-------------------------------------

### Установка через Composer
============================
Если у вас еще нет [Composer](http://getcomposer.org/), вы можете установить его следуя инструкциям на [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

После чего установить данное приложение используя вот эти команды:

~~~
git clone https://github.com/YefimovArtem/LinkShortener-yii2.git
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd LinkShortener-yii2
composer install
~~~


Начало работы
---------------

После установки приложения, вам необходимо провести следующие действия для инициализации установленного приложения. Вам необходимо сделать это один раз.

* Создать новую базу данных
* Измените данные файла `Config / db.php` на реальные, например:
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=***HOST***;dbname=***DB NAME***',
    'username' => '***USER NAME***',
    'password' => '***PASSWORD***',
    'charset' => 'utf8',
];
```
* Выполнить миграции в консольной командой `yii migrate` или `php yii migrate`. Это создаст таблицы, необходимые для работы приложения.
* Создать домен и настроить его на папку LinkShortener-yii2/web

Теперь вы можете открыть приложение в своем браузере:
~~~
http://YOUR_DOMAIN/
~~~
