Тестовые задания
============================

1. Первое задание заключалось в экспресс-оценки одного из web-русурсов (здесь это не размещается)

2. Написать код, который выполнит следующие действия.

 При первом нажатии на Button, первая ячейка окрашивается в красный цвет. При последующих нажатиях добавляется еще одна строка в которой окрашивается в красный цвет вторая ячейка, третья, и так далее пока не будет всего 5 строк и красной диагонали. Так же в каждой нечетной строке в окрашенной ячейке меняем «*» на «+».
 При шестом нажатии на Button должна появиться надпись поверх таблицы «Test Complete». Если нажать на надпись она плавно исчезнет.

3.Напишите функцию определения n-го числа Фибоначчи, где в качестве параметра передается n/ Использовать PHP

4. Работа с базой данных

Имеются текстовые файлы с данными. В первой строчке каждого файла – названия полей. Разделительный символ - табуляция.
Список файлов и их структура следующие:

•	agency_network.txt – группа агентств
•	agency_network_id – уникальный идентификатор сети агентств
•	agency_network_name – название сети агентств

agency.txt

•	agency_id – уникальный идентификатор агентства
•	agency_ network _id – уникальный идентификатор агентства из agency_ network
•	agency_name – название агентства

billing.txt

•	agency_id – идентификатор агентства из agency
•	user_id – произвольный код абонента
•	date – дата, когда была сделана запись
•	amount – количество пришедших денег

Необходимо сделать следующее:

• Спроектировать структуру бузы данных для хранения информации из текстовых файлов.
• Создать скрипт загрузки в эту базу данных из файлов.
• Сделать сводный отчет указанного далее вида, для данных за выбранный период. Для агентств, по которым за указанный период нет никаких данных, так же должна выводиться строка отчета с нулевой суммой.

5. Нужно сделать редактор таблицы (желательно billing из предыдущего задания), которая хранится в БД. 

В редакторе должна быть возможность:

•	Добавить новую запись;
•	Удалить запись;
•	Отредактировать запись без перезагрузки страницы (Ajax);

Открывается окно внутри страницы с возможностью отредактировать запись.

---------------------------------------------------------------------------------------------

SQL файл импорта БД находится в корне с именем "sql_import_db.txt"

Переход на исполнение задания 2 и 3 располагается в интерфейсе основного задания 4.