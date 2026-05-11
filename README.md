# supervision-app

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## 💡 - Start
You can run
```bash
php -S localhost:1800 -t public
```

## 🎼 - Composer
Run this below to install dependencies
```bash
composer install
```

## 🐋 - Docker
Or you can run these commands:
```bash
docker build -t supervision-project .
docker run -d -p 1800:80 --name supervision-project supervision-project
```
After that, open `http://localhost:1800` in your browser.

## 💾 - Datas
Run this to create and add datas to database.sqlite
```bash
php storage/scripts/Seeder.php
```

That's it! Now go build something cool.

## 🔧 - Tools
https://elmah.io/tools/base64-image-encoder/<br>
http://compteur-de-caracteres.com/<br>
https://www.imgonline.com.ua/eng/compress-image.php<br>