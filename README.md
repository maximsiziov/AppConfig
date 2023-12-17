API для запроса конфига мобильного приложения.

Ожидается get запрос по адресу /config 
C обязательными параметрами:
appVersion и platform

Также доступны необязательные параметры: 
assetsVersion и definitionsVersion


Для того чтобы развернуть проект нужно зайти в директорию проекта и запустить комманду
docker-compose up -d --build
Дождаться завершения работы контейнера appconfig-composer чтобы он собрал  все необходимые библиотеки для проекта
Запустить комманду 
docker-compose exec php bash
И уже из контейнера запустить
php bin/console doctrine:migrations:migrate
