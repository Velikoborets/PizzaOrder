Приложение включает в себя функционал:
- Выбор типа пиццы, размера и соуса через дропдауны.
- Формирование и отображение чека с ценой заказа и описанием выбранных параметров.
- Базовая защита от SQL инъекций.
- Автозагрузка классов с использованием Composer.
- Обработка заказов через AJAX запросы с использованием jQuery.
- Структура бэкенда организована по ООП принципам, включая абстрактный класс для пицц и класс для подсчета суммы заказа.
- Возможность хранения цен в USD в базе данных и отображение клиенту в BYN по актуальному курсу с использованием API НБРБ.

Перед клонированием\скачиванием репозитория и запуском проекта, убедитесь, что у вас установлены:
- PHP 8.0
- MySQL 5.6
- Apache 2.4

Настройка базы данных:
- Импортируйте дамп Б\Д из папки "dumpDB" в phpmyadmin или в др. программу
- В файле "connectiondDB.php" введите Ваши данные для подключения к соответствующей Б\Д
