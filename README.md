Автозагрузчик модулей Bitrix Framework
======================================

Как известно при разработке на Bitrix Framework программист должен сам заботиться о подключении необходимых модулей с помощью метода `CModule::IncludeModule`. Причем подключать модули необходимо везде, где происходит обращение к api этих модулей. Более подробно эта проблема изложена в статье [Автоматическое подключение модулей в битриксе](http://pushin.pro/blog/avtomaticheskoye-podklyucheniye-moduley-v-bitrikse). Автозагрузчик берет на себя выполнение этой задачи и, тем самым, избавляет разработчика от лишней рутины.

Установка
---------

### Composer

Рекомендуется устанавливать с помощью [Composer](http://getcomposer.org/)
```json
{
    "require": {
        "pushin/bx-module-autoloader": "1.0.*"
    }
}
```

Более подробную информацию по установке можно найти на [packagist.org](https://packagist.org/packages/pushin/bx-module-autoloader)

Использование
-------------
```php
$mapper = new StaticHardcodedMapper();
$loader = new ModuleAutoloader($mapper);
$loader->register();
```
