Laravel Install Utils
=====================

Some artisan commands to do some common installation tasks
A better readme to come...

```php
Artisan::resolve('Tlr\Install\EnvironmentCommand');
```

then run artisan `install:env` to put your hostname into `bootstrap/start.php`'s `local` environment.
at the moment, it's just a string replace on the default 'your-machine-name'. more advanced stuff to come.
