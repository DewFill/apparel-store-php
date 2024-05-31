## Установка

```shell
make up create_admin
```
```up``` - Поднимает контейнер

```create_admin``` - Создает учетную запись с логином и паролем из файла [.env](.env) с правами администратора

### Установка с тестовыми данными
Можно так же добавить флаг ```filler_data```

```shell
make up create_admin filler_data
```
```filler_data``` - Заполняет БД тестовыми данными

## Остановка
Остановить все контейнеры, но не потерять данные
```shell
make down
```

## Удаление
Удалить все контейнеры, диски и сети
```shell
make clear
```