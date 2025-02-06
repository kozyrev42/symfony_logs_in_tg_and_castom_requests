<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_dynamic_01.svg" alt="Symfony Logo">
</a></p>

1. Создание нового проекта:
`composer create-project symfony/website-skeleton symfony_logs_in_tg_and_castom_requests`

- Запуск встроенного сервера:`php -S localhost:8000 -t public`

- узнать какой процесс запушен на порту:`sudo lsof -i :8000`

- используя PID остановить процесс:`sudo kill -9 1234`

- создан тестовый роут в файле: config/routes.yaml

- создан тестовый обработчик в файле: src/Controller/TestApiController.php