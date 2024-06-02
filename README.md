## Установка

```shell
make up create_admin filler_data
```
```up``` - Поднимает контейнер

```create_admin``` - Создает учетную запись с логином и паролем из файла [.env](.env) с правами администратора

```filler_data``` - Заполняет БД тестовыми данными

* После установки проект будет запущен на http://localhost (изменить можно в [.env](.env))

### Установка без тестовых данных

```shell
make up create_admin
```

## Остановка
Остановить все контейнеры, но не потерять данные
```shell
make down
```

## Запуск
```shell
make up
```

## Удаление
Удалить все контейнеры, диски и сети
```shell
make clear
```

___
# Notice
For educational purpoces only. This code is not tested and potentially vulnerable. Don't use in production!
