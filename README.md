<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_dynamic_01.svg" alt="Symfony Logo">
</a></p>

1. Создание нового проекта:
`composer create-project symfony/website-skeleton symfony_logs_in_tg_and_castom_requests`

- Запуск встроенного сервера:`php -S localhost:8000 -t public`,
`APP_ENV=dev php -S localhost:8030 -t public public/index.php`

- узнать какой процесс запушен на порту:`sudo lsof -i :8000`

- используя PID остановить процесс:`sudo kill -9 1234`

- создан тестовый роут в файле: config/routes.yaml

- создан тестовый обработчик в файле: src/Controller/TestApiController.php

2. Создана дефолтная консольная команда ExampleCommand.

3. Реализована отправка логов в Телеграм.

4. Создан CustomRequestController.php, для дальнейшего внедрения валидации. Исправлены мелкие ошибки с логами.