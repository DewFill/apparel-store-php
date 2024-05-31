wait_until_mysql_healthy = while [ "`docker inspect -f {{.State.Health.Status}} database`" != "healthy" ]; do     sleep 2; done
create_admin:
	$(wait_until_mysql_healthy)
	docker exec -it site php docker/first_install/create_admin.php
filler_data:
	$(wait_until_mysql_healthy)
	docker exec -it site php docker/first_install/filler_data.php
up:
	docker compose -f compose.yml up -d --build
down:
	docker compose down
clear:
	docker compose down -v --remove-orphans
	docker compose rm -vsf
