Laravel Install Utils
=====================

more on this later...

```php
Artisan::resolve('Tlr\Install\EnvironmentCommand');
```

then run artisan `install:env` to put your hostname into `bootstrap/start.php`'s `local` environment.
at the moment, it's just a string replace on the default 'your-machine-name'. more advanced stuff to come.
